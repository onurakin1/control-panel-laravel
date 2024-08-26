<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TemplateSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        // Create the user
        $user = User::create($fields);

        // Create a token for the user
        $token = $user->createToken($request->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'message' => 'The provided credentials are incorrect.'
            ];
        }
    
        $userWithCompany = User::where('users.id', $user->id)
            ->join('tbl_company', 'users.id', '=', 'tbl_company.user_id')
            ->first();
    
        $userWithTemplate = User::where('users.id', $user->id)
            ->join('tbl_template_settings', 'users.id', '=', 'tbl_template_settings.user_id')
            ->first();
    
        $token = $user->createToken($user->name);
    
        return [
            'user' => $user,
            'token' => $token->plainTextToken,
            'company' => $userWithCompany ? $userWithCompany->logo : null, // Buraya virgül eklendi
            'template' => $userWithTemplate ? $userWithTemplate->id : null
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'You are logout.'
        ];
    }
}
