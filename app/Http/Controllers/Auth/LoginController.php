<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (! $token = auth()->attempt($request->only('email','password'))) {
            throw ValidationException::withMessages([
                'invalid' => ['Email dan password tidak sesuai']
            ]);
            return response()->json([
                'status' => 401,
                'message' => 'email or password is wrong'
            ], 401);
        }


        return response()->json([
            'status' => 200,
            'message' => 'User Logged In',
            'data' => [
                // 'user' => auth()->user(),
                'token' => $token
            ]
        ], 200);
    }
}
