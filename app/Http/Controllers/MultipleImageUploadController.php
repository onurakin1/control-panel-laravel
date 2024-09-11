<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultipleImageUploadController extends Controller
{
    public function store(Request $request)
    {
        // Doğrulama (isteğe bağlı)
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:51200'
        ]);

        // Resimleri kaydet
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = $image->getClientOriginalName();
                $path = $image->storeAs('images', $fileName, 'public');
                $images[] = $path;
            }
        }

        return response()->json([
            'message' => 'Images uploaded successfully',
            'paths' => $images
        ]);
    }
}
