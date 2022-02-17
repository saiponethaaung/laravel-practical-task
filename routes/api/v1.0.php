<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\SurveyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'apiResponse'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/profile', function (Request $request) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'msg' => 'Success',
                'data' => [
                    'info' => $request->user(),
                ],
            ]);
        });
        Route::group(['prefix' => 'survey'], function () {
            Route::get('/', [SurveyController::class, 'getSurveys']);
            Route::post('/', [SurveyController::class, 'createSurvey']);
            Route::group(['prefix' => '{surveyID}'], function () {
                Route::get('/', [SurveyController::class, 'getSurvey']);
                Route::post('answer', [SurveyController::class, 'answerSurvey']);
            });
        });
    });
});
