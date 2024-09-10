<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MultiSheetImport;
use App\Exports\MultiSheetExport;
use Illuminate\Support\Facades\Log;

class CategoryProductExcelImportController extends Controller
{
    public function export()
    {
        return Excel::download(new MultiSheetExport, 'categories-products.xlsx');
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            Excel::import(new MultiSheetImport, $request->file('file'));
            return response()->json(['data' => 'Categories and Products imported successfully.'], 200);
        } catch (\Exception $ex) {
            Log::error('Import Error: ' . $ex->getMessage()); // Hata mesajını logla
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }
}
