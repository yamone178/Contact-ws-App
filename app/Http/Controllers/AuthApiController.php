<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthApiController extends Controller
{

    public function register(Request $request){
        $request->validate([
            'name'=>'required|min:3',
            'email'=> 'required',
            'password'=> 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ]);

        $user->save();

        if (Auth::attempt($request->only(['email','password']))){
            $token= $request->user()->createToken('phone')->plainTextToken;
            return response([
                'message'=>'contact is created',
                'success'=>true,
                'status'=>200,
                'token'=>$token,
                'auth'=> $user
            ]);
        }

        return response(['message'=> 'Unauthenticated']);

    }

    public function login(Request $request){
        $request->validate([
            'email'=> 'required',
            'password'=> 'required|min:8'
        ]);

        if (Auth::attempt($request->only(['email','password']))){
            $token= $request->user()->createToken('phone')->plainTextToken;
            return response([
                'message'=>'login successful',
                'success'=> true,
                'status'=> 202,
                'token'=>$token,

            ]);
        }

        return response([
            'message'=> 'Unauthenticated',
            'status'=> 401
        ]);

    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return response([
            'message'=> 'logout successful',
            'success'=> 'true'
        ]);
    }

    public function logoutAll(){
        Auth::user()->tokens()->delete();
        return response()->json([
            'message'=> 'logout successful',
            'success'=> true
        ]);
    }

}
