<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\ImportUsers;

class UserController extends Controller
{

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {

            Excel::import(new ImportUsers, $request->file('file'));
            return response()->json(['data' => 'Users imported successfully.', 201]);
        } catch (\Exception $ex) {

            return response()->json(['data' => 'Some error has occur.', 400]);
        }
    }
}
