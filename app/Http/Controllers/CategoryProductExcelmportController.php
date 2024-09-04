<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoryProductImport;
use App\Exports\CategoryProductExport;

class CategoryProductExcelmportController extends Controller
{
    public function export()
    {
        return Excel::download(new CategoryProductExport, 'users.xlsx');
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {

            Excel::import(new CategoryProductImport, $request->file('file'));
            return response()->json(['data' => 'Users imported successfully.', 201]);
        } catch (\Exception $ex) {

            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }
}
