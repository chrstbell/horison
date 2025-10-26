<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuCategory;


class MenuController extends Controller
{
    public function store(Request $request)
    {
        // Handle image upload (optional)
        $imagePath = null;
        if ($request->hasFile('imageUpload')) {
            $file = $request->file('imageUpload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $imagePath = 'images/' . $fileName;
        }

        $from = $request->input('from');

        $priceString = $request->input('price');
        // Remove currency symbols and spaces
        $priceString = preg_replace('/[Rp\s]/', '', $priceString);

        // Handle different decimal formats
        // If it has .00 or ,00 at the end (like 25000.00), treat as thousands separator
        if (preg_match('/\.0{1,2}$/', $priceString)) {
            // Remove .00 or .0 at the end
            $priceString = preg_replace('/\.0{1,2}$/', '', $priceString);
            // Remove remaining dots (thousands separators)
            $priceString = str_replace('.', '', $priceString);
        } else {
            // Normal case: remove dots used as thousands separators
            $priceString = str_replace('.', '', $priceString);
        }

        // Remove commas if used as thousands separators
        $priceString = str_replace(',', '', $priceString);
        $cleanPrice = (float) $priceString;

        Menu::create([
            'name'              => $request->input('name'),
            'description'       => $request->input('description'),
            'price'             => $cleanPrice,
            'category_id'       => $request->input('category_id'),
            'subcategory_id'    => $request->input('subcategory_id'),
            'image_path'        => $imagePath
        ]);


        return redirect()->route('admin.' . $from);
    }

    public function update(Request $request, $id)
    {
        $from = 'dashboard';
        if ($request->input('from')) {
            $from = '.' . $request->input('from');
        }

        $menu = Menu::findOrFail($id);

        // Handle image upload if new image is provided
        if ($request->hasFile('imageUpload')) {
            $file = $request->file('imageUpload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);

            $menu->image_path = 'images/' . $fileName;
        }

        // Update other fields
        $menu->name = $request->input('name');
        $menu->description = $request->input('description');

        // Clean price string before converting to float
        $priceString = $request->input('price');
        // Remove currency symbols and spaces
        $priceString = preg_replace('/[Rp\s]/', '', $priceString);

        // Handle different decimal formats
        // If it has .00 or ,00 at the end (like 25000.00), treat as thousands separator
        if (preg_match('/\.0{1,2}$/', $priceString)) {
            // Remove .00 or .0 at the end
            $priceString = preg_replace('/\.0{1,2}$/', '', $priceString);
            // Remove remaining dots (thousands separators)
            $priceString = str_replace('.', '', $priceString);
        } else {
            // Normal case: remove dots used as thousands separators
            $priceString = str_replace('.', '', $priceString);
        }

        // Remove commas if used as thousands separators
        $priceString = str_replace(',', '', $priceString);
        $menu->price = (float) $priceString;

        $menu->save();

        return redirect()->route('admin' . $from);
    }

    public function updateAvailable(Request $request, $id)
    {
        $from = 'dashboard';
        if ($request->input('from')) {
            $from = '.' . $request->input('from');
        }

        $menu = Menu::findOrFail($id);
        $menu->is_available = !$menu->is_available;

        $menu->save();

        return "Success";
    }

    public function delete(Request $request, $id)
    {
        $from = 'dashboard';
        if ($request->filled('from')) {
            $from = '.' . $request->input('from');
        }

        $menu = Menu::findOrFail($id);

        // Remove image file if it exists
        if ($menu->image_path) {
            $filePath = public_path($menu->image_path);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        $menu->delete();

        return redirect()->route('admin' . $from)
            ->with('success', 'Menu deleted successfully.');
    }

    public function filterMenu($category = null, $subcategory = null)
    {
        $query = MenuCategory::where('category_type', $category);

        if (!empty($subcategory)) {
            $query->where('subcategory_name', $subcategory);
        }

        $menu_data = $query->get();

        // Return only the card HTML, not the whole page
        return view('admin.partials.menu_cards', compact('menu_data'));
    }
}
