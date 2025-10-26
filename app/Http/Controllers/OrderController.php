<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Get all orders with optional filtering
     */
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('room_number')) {
            $query->where('room_number', $request->room_number);
        }

        $orders = $query->orderBy('order_time', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    /**
     * Get a specific order by ID with items
     */
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $orderItems = OrderItem::where('order_id', $id)->get();

        return response()->json([
            'success' => true,
            'data' => [
                'order' => $order,
                'items' => $orderItems
            ]
        ]);
    }

    /**
     * Create a new order
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string',
            'subtotal' => 'required|numeric',
            'tax' => 'required|numeric',
            'total' => 'required|numeric',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric'
        ]);

        DB::beginTransaction();

        try {
            // Create order
            $order = Order::create([
                'room_number' => $request->room_number,
                'user_id' => session('user_id'),
                'order_time' => now(),
                'status' => 'pending',
                'subtotal' => $request->subtotal,
                'tax' => $request->tax,
                'total' => $request->total,
                'customer_note' => $request->customer_note ?? null
            ]);

            // Create order items
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['menu_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'notes' => $item['notes'] ?? null
                ]);
            }

            // Create order history entry
            OrderHistory::create([
                'order_id' => $order->id,
                'status' => 'pending',
                'changed_by' => session('user_id') ?? 1,
                'change_time' => now(),
                'notes' => 'Order created'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        DB::beginTransaction();

        try {
            $order->status = $request->status;

            if ($request->status === 'completed') {
                $order->completed_time = now();
                $order->completed_by = session('user_id') ?? 1;
            }

            $order->save();

            // Add to order history
            OrderHistory::create([
                'order_id' => $order->id,
                'status' => $request->status,
                'changed_by' => session('user_id') ?? 1,
                'change_time' => now(),
                'notes' => $request->notes ?? null
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully',
                'data' => $order
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an order
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        try {
            // OrderItems and OrderHistory will be deleted automatically due to CASCADE
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get order history
     */
    public function history($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $history = OrderHistory::where('order_id', $id)
            ->orderBy('change_time', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }

    /**
     * Get orders for kitchen display
     */
    public function kitchenOrders()
    {
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->whereIn('orders.status', ['pending', 'processing'])
            ->select(
                'orders.id',
                'orders.room_number',
                'orders.order_time',
                'orders.status',
                'orders.customer_note',
                DB::raw('GROUP_CONCAT(CONCAT(order_items.quantity, "x ", menus.name) SEPARATOR ", ") as items')
            )
            ->groupBy('orders.id', 'orders.room_number', 'orders.order_time', 'orders.status', 'orders.customer_note')
            ->orderBy('orders.order_time', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    /**
     * Get order statistics
     */
    public function statistics()
    {
        $today = now()->toDateString();

        $stats = [
            'total_orders_today' => Order::whereDate('order_time', $today)->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'completed_today' => Order::where('status', 'completed')
                ->whereDate('completed_time', $today)
                ->count(),
            'revenue_today' => Order::where('status', 'completed')
                ->whereDate('completed_time', $today)
                ->sum('total')
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}