<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\DTOs\User\RegisterDTO;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->userRepository->createUser(RegisterDTO::collection($request))->assignRole(User::USER);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => UserResource::make($user),
        ]);
    }
}
