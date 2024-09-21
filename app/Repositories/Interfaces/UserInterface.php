<?php

namespace App\Repositories\Interfaces;

interface UserInterface
{
    public function register(array $data);
    public function findByEmail(string $email);
}
