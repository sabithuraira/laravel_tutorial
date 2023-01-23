<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email'  => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6',
            'password_confirmation'  => 'required|string|min:6|same:password',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'    => 'error', 
                'data'      => $validator->errors()
            ]);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'      => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'    => 'success', 
            'data'      => [
                'user'      => $user,
                'access_token'  => $token,
                'token_type'    => 'Bearer',
            ]
        ]);
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message'=> 'Unauthorize'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'message'=> 'Hi '.$user->name.', selamat datang kembali',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ], 401);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message'   => 'Anda berhasil logout',
        ];
    }
}
