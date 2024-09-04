<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request) {
        $registerUser = Validator::make($request->all(), [
            'name' => 'required|string|between:3,20',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:6|max:12',

        ]);

        if($registerUser->fails()){
            return response()->json(['error'=>$registerUser->errors()->toJson()]);
        }
        
        $user = User::create(array_merge(
            $registerUser->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'result'=> [
            'message' => 'User successfully registered',
            'user' => $user
            ],
        'error'=>null], 201);

    }

    public function login(Request $request){
        $loginUser = Validator::make($request->all(), [
            'email' => 'required',
            'password' =>'required',
        ]);

        if($loginUser->fails()){
            return response()->json($loginUser->errors(), 422);
        }
        if (! $token = auth()->attempt($loginUser->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);

    }

    
}
