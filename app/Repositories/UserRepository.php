<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\UserInterface as UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function register(array $data)
    {
        return User::create($data);
    }

    public function login(array $data)
    {
        return User::where('email', $data['email'])->where('password', $data['password'])->first();
    }
}
