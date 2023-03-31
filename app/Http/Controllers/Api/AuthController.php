<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'validation_error' => $validator->errors(),
                ], 422);
            }

            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.'],
                ], 404);
            }

            $token = $user->createToken('my-app-token')->plainTextToken;

            $user['token'] = $token;
            return response()->json([
                'data' => $user,
            ], 200);

        } catch (\Exception$e) {
            return response()->json([
                'server_error' => $e,
            ], 409);
        }
    }
}
