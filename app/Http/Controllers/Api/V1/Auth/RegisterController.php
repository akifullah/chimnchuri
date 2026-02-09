<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Pest\Support\Str;

class RegisterController extends Controller
{
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
