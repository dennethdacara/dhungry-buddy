<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class CustomLoginController extends Controller
{
    public function authenticate(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'These credentials does not match our records.',
                'status'  => 'failed'
            ]);
        }

        if (empty($request->email) || empty($request->password)) {
            return response()->json([
                'message' => 'The email and password field/s are required.',
                'status'  => 'failed'
            ]);
        }
        
        if (!\Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'These credentials does not match our records.',
                'status'  => 'failed'
            ]);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Succesfully logged in!',
                'status'  => 'success'
            ]);
        }

    }
}
