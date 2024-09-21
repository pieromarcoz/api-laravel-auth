<?php

namespace App\Services;

use App\Repositories\Interfaces\UserInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepo;

    public function __construct(UserInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepo->register($data);
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function login(array $data)
    {
        $user = $this->userRepo->login($data);
        return $user->createToken('auth_token')->plainTextToken;
    }
}
