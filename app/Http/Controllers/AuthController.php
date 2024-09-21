<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\StoreRequestUser;
use App\Http\Responses\ApiResponse;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(StoreRequestUser $request)
    {
        try {
            $token = $this->authService->register($request->validated());
            return ApiResponse::success(['token' => $token], 'Usuario registrado correctamente', 201);
        } catch (\Exception $e) {
            return ApiResponse::error('Error al registrar usuario', [$e->getMessage()]);
        }
    }
    public function login(StoreRequestUser $request)
    {
        try {
            $token = $this->authService->login($request->validated());
            return ApiResponse::success(['token' => $token], 'Usuario logueado correctamente', 201);
        } catch (\Exception $e) {
            return ApiResponse::error('Error al loguear usuario', [$e->getMessage()]);
        }
    }
}
