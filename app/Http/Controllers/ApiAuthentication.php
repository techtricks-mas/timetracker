<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthentication extends Controller
{
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $user = $request->user();
            $tokenResult = $user->createToken('timetracker');
            return response()->json(['token' => $tokenResult->accessToken], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
