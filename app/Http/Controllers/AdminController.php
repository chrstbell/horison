<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\User;
use App\Models\Promo;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function makanan($subcategory = null)
    {

        $query = MenuCategory::where('category_type', 'makanan');

        if ($subcategory == null) {
            $subcategory = 'Signature Dishes';
        }

        if (!empty($subcategory)) {
            $query->where('subcategory_name', $subcategory);
        }

        $menu_data = $query->get();

        return view('admin.makanan', compact('menu_data'));
    }


    public function minuman($subcategory = null)
    {
        $query = MenuCategory::where('category_type', 'minuman');

        if ($subcategory == null) {
            $subcategory = 'Mocktail';
        }

        if (!empty($subcategory)) {
            $query->where('subcategory_name', $subcategory);
        }

        $menu_data = $query->get();

        return view('admin.minuman', compact('menu_data'));
    }

    public function newMenu($subcategory = null)
    {
        if ($subcategory == null) {
            $subcategory = 'makanan';
        }
        $query = MenuCategory::where('category_type', 'new_menu');

        if (!empty($subcategory)) {
            $query->where('subcategory_name', $subcategory);
        }

        $menu_data = $query->get();

        return view('admin.new_menu', compact('menu_data'));
    }

    public function tambahMenu($category = 'makanan')
    {
        return view('admin.tambah_menu', compact('category'));
    }

    public function editMenu($id = null)
    {
        if ($id == null) {
            redirect(route('admin.dashboard'));
        }

        $menu_data = MenuCategory::findOrFail($id);

        return view('admin.edit_menu', compact('menu_data'));
    }

    public function pengguna()
    {
        // Get all columns, all users
        $user_data = User::all();

        return view('admin.pengguna', compact('user_data'));
    }

    public function promo()
    {
        $promo_data = Promo::all();
        return view('admin.promo', compact('promo_data'));
    }
}
