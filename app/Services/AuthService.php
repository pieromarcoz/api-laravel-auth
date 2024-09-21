<?php

namespace App\Services;

use App\Repositories\Interfaces\UserInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        $user = $this->userRepo->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        return $user->createToken('auth_token')->plainTextToken;
    }
}
