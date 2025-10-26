<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\User;
use App\Models\Promo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $promo_data = Promo::all();
        return view('user.index', compact('promo_data'));
    }

    public function store(Request $request)
    {
        // Check if username already exists (including soft deleted)
        $existingUser = User::withTrashed()->where('username', $request->username)->first();

        if ($existingUser) {
            // If user is soft deleted, restore and reset
            if ($existingUser->trashed()) {
                $existingUser->restore();

                // Reset all columns to new values
                $existingUser->update([
                    'password' => $request->password,
                    'role' => $request->role,
                    'room_number' => $request->role === 'user' ? $request->room_number : null,
                    'is_active' => true,
                    'login_expiry' => null,
                    'login_time' => null,
                    // Add any other columns you want to reset
                ]);

                return response()->json([
                    'success' => true,
                    'message' => "Pengguna {$existingUser->username} berhasil ditambahkan!",
                    'user' => $existingUser
                ]);
            }

            // If user exists and is NOT deleted, return error
            return response()->json([
                'success' => false,
                'message' => "Username {$request->username} sudah terdaftar!",
            ], 400);
        }

        if ($request->role === 'user') {
            $user = User::create([
                'username' => $request->username,
                'password' => $request->password,
                'role' => $request->role,
                'room_number' => $request->room_number,
                'is_active' => true,
            ]);
        } else {
            $user = User::create([
                'username' => $request->username,
                'password' => $request->password,
                'role' => $request->role,
                'is_active' => true,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Pengguna {$user->username} berhasil ditambahkan!",
            'user' => $user
        ]);
    }

    // destroy user by id
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "Pengguna tidak ditemukan!",
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => "Pengguna {$user->username} berhasil dihapus!",
        ]);
    }

    public function kategori()
    {

        return view('user.kategori');
    }


    public function kategoriItem($category = null)
    {
        $menu_data = [];
        $categoryMap = [
            'bite-start' => 'Bite & Start',
            'pasta' => 'Pasta & Noodles',
            'rice' => 'Signature Rice',
            'signature' => 'Signature Dishes',
            'soup' => 'Soups & Broths',
            'sandwiches' => 'Burgers & Sandwiches',
            'sweet' => 'Sweet Endings',
            'minuman' => 'minuman',
            'new_menu' => 'New Menu',
            'grilled' => 'Grilled Specialties',
        ];

        if ($category == 'minuman' or $category == 'new_menu') {
            $query = MenuCategory::where('category_type', $category);
            $menu_data = $query->get();
        } else {
            $query = MenuCategory::where('subcategory_name', $categoryMap[$category]);
        }

        $menu_data = $query->get();

        $category_name = $categoryMap[$category] ?? 'Menu';

        return view('user.kategori_item', compact('menu_data', 'category_name'));
    }


    public function menu(Request $request)
    {
        $searchTerm = $request->input('search', '');

        if (!empty($searchTerm)) {
            $menu_data = MenuCategory::where('name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                ->get();
        } else {
            $menu_data = MenuCategory::all();
        }

        return view('user.menu', compact('menu_data', 'searchTerm'));
    }


    public function checkout()
    {
        $roomNumber = session('room_number', 'Kamar 201');
        return view('user.checkout', compact('roomNumber'));
    }

    public function status()
    {
        $userId = session('user_id');

        // Get orders with items for the logged-in user
        $orders = \App\Models\Order::where('user_id', $userId)
            ->orderBy('order_time', 'desc')
            ->get();

        // Get order items for each order
        $ordersWithItems = $orders->map(function ($order) {
            $items = \App\Models\OrderItem::where('order_id', $order->id)
                ->join('menus', 'order_items.menu_id', '=', 'menus.id')
                ->select('order_items.*', 'menus.name as menu_name', 'menus.image_path')
                ->get();

            $order->items = $items;
            $order->item_count = $items->sum('quantity');
            return $order;
        });

        return view('user.status', compact('ordersWithItems'));
    }

    public function receipt($orderId)
    {
        // Get order with items
        $order = \App\Models\Order::find($orderId);

        if (!$order) {
            abort(404, 'Order not found');
        }

        // Get order items with menu details
        $items = \App\Models\OrderItem::where('order_id', $orderId)
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->select('order_items.*', 'menus.name as menu_name')
            ->get();

        // Format data for receipt
        $receiptData = [
            'orderId' => $order->id,
            'room' => $order->room_number,
            'time' => \Carbon\Carbon::parse($order->order_time)->format('d/m/Y H:i'),
            'items' => $items->map(function ($item) {
                return [
                    'name' => $item->menu_name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'notes' => $item->notes
                ];
            }),
            'notes' => $order->customer_note,
            'subtotal' => $order->subtotal,
            'tax' => $order->tax,
            'total' => $order->total,
            'status' => $order->status
        ];

        return view('user.print_receipt', compact('receiptData'));
    }

    public function get_menu_data($category = null, $subcategory = null)
    {
        if ($category) {
            $query = MenuCategory::where('category_type', $category);

            if ($subcategory) {
                $query->where('subcategory_name', $subcategory);
            }

            $data = $query->get();
        } else {
            $data = MenuCategory::all();
        }

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => "Data menu berhasil diambil!",
        ]);
    }

    public function logoutUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan!',
            ], 404);
        }

        // Set login_expiry to null to revoke access
        $user->login_expiry = null;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => "Pengguna {$user->username} berhasil di-logout!",
        ]);
    }

    public function addTimeToAllUsers()
    {
        // Get all users with role 'user' who have active login_expiry
        $users = User::where('role', 'user')
            ->whereNotNull('login_expiry')
            ->where('login_expiry', '>', now())
            ->get();

        $affectedCount = 0;

        foreach ($users as $user) {
            // Add 10 minutes to their login_expiry
            $user->login_time = \Carbon\Carbon::parse($user->login_time)->subMinutes(10);
            $user->login_expiry = \Carbon\Carbon::parse($user->login_expiry)->subMinutes(10);
            $user->save();
            $affectedCount++;
        }

        return response()->json([
            'success' => true,
            'message' => "Berhasil menambah 10 menit untuk {$affectedCount} user aktif!",
            'affected_count' => $affectedCount,
        ]);
    }

    public function resetAllUsers()
    {
        // Get all users with role 'user'
        $users = User::where('role', 'user')->get();

        $affectedCount = 0;

        foreach ($users as $user) {
            // Set login_expiry to null (logout all users)
            $user->login_expiry = null;
            $user->save();
            $affectedCount++;
        }

        return response()->json([
            'success' => true,
            'message' => "Berhasil logout semua user! Total: {$affectedCount} user.",
            'affected_count' => $affectedCount,
        ]);
    }
}
