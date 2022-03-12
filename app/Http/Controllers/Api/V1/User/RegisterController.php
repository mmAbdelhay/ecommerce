<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\DTOs\User\RegisterDTO;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create(RegisterDTO::collection($request))->assignRole(User::USER);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => UserResource::make($user),
        ]);
    }
}
