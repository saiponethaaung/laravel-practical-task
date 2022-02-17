<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Http\Requests\V1\RegisterRequest;
use App\Survey\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request)
    {
        $register = $this->service->register($request);
        return response()->json($register, $register['code']);
    }

    public function login(LoginRequest $request)
    {
        $login = $this->service->login($request);
        return response()->json($login, $login['code']);
    }
}
