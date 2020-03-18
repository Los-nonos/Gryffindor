<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/users/{id}', 'Users\FindByIdUserAction@execute');

Route::middleware('auth:api')->post('/users', 'Users\StoreUserAction@execute');

Route::middleware('auth:api')->delete('/users/{id}', 'Users\DeleteUserAction@execute');

Route::middleware('auth:api')->put('/users/{id}', 'Users\UpdateUserAction@execute');