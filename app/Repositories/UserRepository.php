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

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
