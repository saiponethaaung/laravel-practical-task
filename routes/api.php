<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::any('/', function () {
    return response()->json([
        'status' => false,
        'code' => 404,
        'msg' => 'Invalid api end point!',
        'data' => [],
    ], 404);
})->where('all', '.+');

Route::any('{any}/{all?}', function () {
    return response()->json([
        'status' => false,
        'code' => 404,
        'msg' => 'Invalid api end point!',
        'data' => [],
    ], 404);
})->where('all', '.+');
