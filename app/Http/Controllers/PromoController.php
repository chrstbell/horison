<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;

class PromoController extends Controller
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

        Promo::create([
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
            'image_path'    => $imagePath,
            'tnc'           => $request->input('tnc')
        ]);

        return redirect()->route('admin.' . $from);
    }

    public function update(Request $request, $id)
    {
        $from = 'dashboard';
        if ($request->input('from')) {
            $from = '.' . $request->input('from');
        }

        $promo = Promo::findOrFail($id);

        // Handle image upload if new image is provided
        if ($request->hasFile('imageUpload')) {
            $file = $request->file('imageUpload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);

            $promo->image_path = 'images/' . $fileName;
        }

        // Update other fields
        $promo->name = $request->input('name');
        $promo->description = $request->input('description');
        $promo->tnc = $request->input('tnc');

        $promo->save();

        return redirect()->route('admin' . $from);
    }

    public function delete(Request $request, $id)
    {
        $from = 'dashboard';
        if ($request->filled('from')) {
            $from = '.' . $request->input('from');
        }

        $promo = Promo::findOrFail($id);

        // Remove image file if it exists
        if ($promo->image_path) {
            $filePath = public_path($promo->image_path);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        $promo->delete();

        return redirect()->route('admin' . $from)
            ->with('success', 'Promo deleted successfully.');
    }
}
