<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        public UserRepository $userRepository,
    ){}

    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->userRepository->findByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->error('information incorrect', 401);
        }

        return response()->success([
            'token' => $user->signIn(),
            'user' => $user,
        ], 'User registered successfully');
    }

    public function register(RegisterRequest $request):JsonResponse
    {
        $user = $this->userRepository->store($request->validated());

        return response()->success([
            'token' => $user->signUp(),
            'user' => $user,
        ], 'User registered successfully');
    }


}
