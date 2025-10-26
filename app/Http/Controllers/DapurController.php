<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DapurController extends Controller
{
    public function dashboard()
    {
        // Get pending and processing orders for active orders
        $activeOrders = Order::whereIn('status', ['pending', 'processing'])
            ->with(['items.menu'])
            ->orderBy('order_time', 'asc')
            ->get();

        // Get completed orders for history
        $completedOrders = Order::where('status', 'completed')
            ->where('completed_time', '>=', Carbon::now()->subDays(30))
            ->orderBy('completed_time', 'desc')
            ->get();

        // Transform orders to include item details
        $activeOrdersData = $activeOrders->map(function ($order) {
            return [
                'id' => $order->id,
                'room' => $order->room_number,
                'datetime' => \Carbon\Carbon::parse($order->order_time)->format('d/m/Y H:i'),
                'status' => $order->status,
                'total' => $order->total,
                'notes' => $order->customer_note,
                'items' => $order->items->map(function ($item) {
                    return [
                        'name' => $item->menu->name ?? 'Unknown Item',
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'notes' => $item->notes
                    ];
                })
            ];
        });

        $completedOrdersData = $completedOrders->map(function ($order) {
            return [
                'id' => $order->id,
                'room' => $order->room_number,
                'datetime' => \Carbon\Carbon::parse($order->completed_time)->format('d/m/Y H:i'),
                'status' => $order->status,
                'total' => $order->total,
                'notes' => $order->customer_note,
                'items' => $order->items->map(function ($item) {
                    return [
                        'name' => $item->menu->name ?? 'Unknown Item',
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'notes' => $item->notes
                    ];
                })
            ];
        });

        $activeOrderCount = $activeOrders->count();

        return view('dapur.dashboard', compact('activeOrdersData', 'completedOrdersData', 'activeOrderCount'));
    }

    public function orders()
    {
        // This method can be used for AJAX requests
        $orders = Order::whereIn('status', ['pending', 'processing'])
            ->with(['items.menu'])
            ->orderBy('order_time', 'asc')
            ->get();

        return response()->json($orders);
    }

    public function orderDetail($id)
    {
        $order = Order::with(['items.menu'])->findOrFail($id);

        // Transform order data for the view
        $orderData = [
            'id' => $order->id,
            'room' => $order->room_number,
            'datetime' => \Carbon\Carbon::parse($order->order_time)->format('d/m/Y H:i'),
            'status' => $order->status,
            'total' => $order->total,
            'subtotal' => $order->subtotal,
            'tax' => $order->tax,
            'notes' => $order->customer_note,
            'completed_time' => $order->completed_time ? \Carbon\Carbon::parse($order->completed_time)->format('H:i') : null,
            'items' => $order->items->map(function ($item) use ($order) {
                return [
                    'name' => $item->menu->name ?? 'Unknown Item',
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'notes' => $item->notes,
                    'checked' => $order->status === 'completed' // All items are checked if order is completed
                ];
            })
        ];

        // Get active orders for sidebar
        $activeOrders = Order::whereIn('status', ['pending', 'processing'])
            ->orderBy('order_time', 'asc')
            ->get();

        // Get completed orders for history sidebar
        $completedOrders = Order::where('status', 'completed')
            ->where('completed_time', '>=', Carbon::now()->subDays(30))
            ->orderBy('completed_time', 'desc')
            ->get();

        $activeOrdersData = $activeOrders->map(function ($order) {
            return [
                'id' => $order->id,
                'room' => $order->room_number,
                'datetime' => \Carbon\Carbon::parse($order->order_time)->format('d/m/Y H:i'),
                'status' => $order->status
            ];
        });

        $completedOrdersData = $completedOrders->map(function ($order) {
            return [
                'id' => $order->id,
                'room' => $order->room_number,
                'datetime' => \Carbon\Carbon::parse($order->completed_time)->format('d/m/Y H:i'),
                'status' => $order->status
            ];
        });

        $activeOrderCount = $activeOrders->count();

        return view('dapur.detail_pesanan', compact('orderData', 'activeOrdersData', 'completedOrdersData', 'activeOrderCount'));
    }

    public function historyByDate(Request $request)
    {
        $date = $request->query('date'); // expected format: YYYY-MM-DD from <input type="date">

        $query = Order::where('status', 'completed');

        if (!empty($date)) {
            // validate optional format (uncomment if you want strict validation)
            // $request->validate(['date' => 'date_format:Y-m-d']);

            $start = Carbon::parse($date)->startOfDay();
            $end   = Carbon::parse($date)->endOfDay();
            $query->whereBetween('completed_time', [$start, $end]);
        } else {
            $query->where('completed_time', '>=', Carbon::now()->subDays(30));
        }

        $orders = $query->orderBy('completed_time', 'desc')->get();

        $data = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'room' => $order->room_number,
                'datetime' => Carbon::parse($order->completed_time)->format('d/m/Y H:i'),
                'status' => $order->status,
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function activeOrders()
    {
        // Fetch only "pending" and "processing" orders
        $orders = Order::whereIn('status', ['pending', 'processing'])
            ->with(['items.menu'])
            ->orderBy('order_time', 'asc')
            ->get();

        // Transform data for AJAX frontend
        $data = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'room' => $order->room_number,
                'datetime' => Carbon::parse($order->order_time)->format('d/m/Y H:i'),
                'status' => $order->status,
                'total' => $order->total,
                'notes' => $order->customer_note,
                'items' => $order->items->map(function ($item) {
                    return [
                        'name' => $item->menu->name ?? 'Unknown Item',
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'notes' => $item->notes
                    ];
                })
            ];
        });

        // Also include the total count for badge updates
        $count = $orders->count();

        return response()->json([
            'success' => true,
            'count' => $count,
            'data' => $data
        ]);
    }
}
