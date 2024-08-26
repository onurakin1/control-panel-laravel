<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }
    public function show($id)
    {
        $company = User::where('id', $id)
            ->get();

        return response()->json($company);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user);
    }
}
