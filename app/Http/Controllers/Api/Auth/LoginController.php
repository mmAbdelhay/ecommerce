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

    /**
     * @OA\Post(
     *   path="api/v1/login",
     *   tags={"Login"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\RequestBody(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\RequestBody(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   ),
     *)
     **/
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
