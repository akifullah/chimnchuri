<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Pest\Support\Str;

use App\Http\Requests\Api\V1\Auth\AuthRequest;
use App\Services\Api\V1\Auth\TokenService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;


class RegisterController extends Controller
{

    public function auth(AuthRequest $request)
    {

        $data = $request->validated();

        try {

            // GET USER BY EMAIL
            $user = User::where("email", $request->email)->first();
            if (!$user) {
                return response()->json([
                    "success" => false,
                    "message" => "Email or Password is incorrect.",
                ], 400);
            }

            // VERIFYING PASSWORD
            $verifyPassword = Hash::check($request->password, $user->password);

            if (!$verifyPassword) {
                return response()->json([
                    "success" => false,
                    "message" => "Email or Password is incorrect.",
                ], 400);
            }

            // GENERATE ACCESS & REFRESH TOKEN
            // $accessToken = $user->createToken("access_token", ["access"], now()->addMinutes(2))->plainTextToken;
            // $refreshToken = $user->createToken("refresh_token", ["refresh"], now()->addMinutes(5))->plainTextToken;

            $tokens = app(TokenService::class)->createTokens($user);

            // RESPONSE & SET COOKIES
            return response()->json([
                "success" => true,
                "message" => "User loggedin successfully.",
                "data" => $user
            ], 200)->cookie("access_token", $tokens["access_token"], 15, '/', null, true, true, false, 'none')
                ->cookie("refresh_token", $tokens["refresh_token"], 60 * 24 * 7, '/', null, true, true, false, 'none');
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Something went wrong.",
                "errors" => $e->getMessage()
            ], 500);
        }
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        try {
            $user = User::create([
                "name" => strtolower($request->name),
                "email" => strtolower($request->email),
                "password" => $request->password,

            ]);

            if ($user) {
                return response()->json([
                    "success" => true,
                    "message" => "User created successfully.",
                    "data" => $user,
                ], 201);
            }
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Something went wrong.",
                "errors" => $e->getMessage()
            ], 500);
        }
    }
}
