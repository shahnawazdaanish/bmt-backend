<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')
    ->group(function(){
        // public routes
        Route::post('signup', [\App\Http\Controllers\AuthenticationController::class, 'signUp']);
        Route::post('login', [\App\Http\Controllers\AuthenticationController::class, 'login']);
        Route::post('reset', [\App\Http\Controllers\AuthenticationController::class, 'reset']);
        Route::post('reset/{token}', [\App\Http\Controllers\AuthenticationController::class, 'resetConfirm']);
    })

    ->group(function(){
        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::get('previous_history', [\App\Http\Controllers\DummyDataController::class, 'previousHistory']);
            Route::get('generic_interests', [\App\Http\Controllers\DummyDataController::class, 'populateGenericInterests']);

            Route::post('get_recommendations', [\App\Http\Controllers\MLDataController::class, 'getRecommendations']);

            Route::get('logout', [\App\Http\Controllers\AuthenticationController::class, 'logout']);

            Route::get('user/profile', function () {
                // Uses Auth Middleware
            });
        });
    })

    ->group(function() {
        // AI api routes
        Route::prefix('ai')
            ->group(function() {
                Route::get('location/museums', [\App\Http\Controllers\DummyDataController::class, 'museums']);
            })
        ;
    })
;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
