<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        public UserRepository $userRepository,
    ){}
    public function login(LoginRequest $request)
    {
        $user = $this->userRepository->findByEmail($request->email);
        dd($user);
    }

    public function register(RegisterRequest $request)
    {

    }


}
