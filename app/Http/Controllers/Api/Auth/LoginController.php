<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\DTOs\LoginDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $requestData = LoginDTO::collection($request);
        $user = $this->userRepository->getUserByEmail($requestData['email']);

        if (!$user || !Hash::check($requestData['password'], $user->password))
            return response()->json(['message' => 'Invalid credentials'], Response::HTTP_FORBIDDEN);

        return response()->json([
            'message' => 'Logged in successfully',
            'user' => UserResource::make($user),
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }
}
