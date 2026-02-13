<?php

namespace App\Http\Controllers\Api\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\AuthRequest;
use App\Mail\ForgetPassword;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use App\Services\Api\V1\Auth\TokenService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use Pest\Support\Str;

class AuthController extends Controller
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

    public function profile(Request $request)
    {
        return $request->user();
    }

    // LOGOUT 
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ])->cookie('access_token', '', -1)
            ->cookie('refresh_token', '', -1);
    }
}
