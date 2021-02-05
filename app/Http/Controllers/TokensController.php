<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class TokensController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
           'email' => 'required|email',
           'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validacion',
                'errors' => $validator->errors()
            ], 422);
        }

        $token = JWTAuth::attempt($credentials);

        if ($token) {
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => User::where('email', $credentials['email'])->get()->first()
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error de credenciales',
                'errors' => $validator->errors()
            ], 401);
        }
    }

    public function refreshToken()
    {
        $token = JWTAuth::getToken();
        try {

            $token = JWTAuth::refresh($token);

            return response()->json([
                'success' => true,
                'token' => $token], 200);
        } catch (TokenExpiredException $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Need to login again! please (expired)!'
            ], 422);
        } catch (TokenBlacklistedException $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Need to login again! please (blacklisted)!'
            ], 422);
        }
    }

    public function logout() {
        $token = JWTAuth::getToken();

        try {
            $token = JWTAuth::invalidate($token);

            return response()->json([
                'success' => true,
                'message' => 'Logout successful'
            ], 200);
        } catch (JWTException $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Failed Logout, please try again!'
            ], 422);
        }
    }
}
