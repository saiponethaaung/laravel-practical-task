<?php

namespace App\Survey\Services;

use Illuminate\Http\Request;

interface UserService
{
    function login(Request $request);

    function register(Request $request);
}
