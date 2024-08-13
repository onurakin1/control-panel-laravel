<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        // Validation
        $request->validate([
            'file' => 'required',
        ]);

        // Dosyayı yükle
        if ($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            return response()->json(['success'=>'File uploaded successfully', 'filePath' => $filePath]);
        }

        return response()->json(['error'=>'File not uploaded'], 400);
    }
    public function show($filename)
    {
        $url = Storage::url("uploads/{$filename}");

        return view('file.show', ['url' => $url]);
    }
}
