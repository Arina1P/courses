<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
//    public function index(): JsonResponse
//    {
//        $resources = User::query()->get();
//
//        return response()->json([
//            'data' => UserResource::collection($resources),
//        ]);
//    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::query()
            ->updateOrCreate([
                'email' => $request->getEmail(),
            ], $request->validated());

        $token = $user->createToken('default');

        return response()->json([
            'resource' => UserResource::make($user),
            'token' => $token->plainTextToken,
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::query()
            ->where('email', $request->input('email'))
            ->first();

        $token = $user->createToken('default');

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    public function logout(): Response
    {
        auth()->user()?->currentAccessToken()->delete();

        return response()->noContent();
    }
}
