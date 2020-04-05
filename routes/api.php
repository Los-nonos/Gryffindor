<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
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

Route::get('/users', ['middleware' => 'auth.role:admin,zeeper', 'uses' => 'Users\IndexUsersAction@execute', 'as' => 'indexUsers']);

Route::get('/users/{id}',['middleware' => 'auth.role:admin', 'uses' => 'Users\FindByIdUserAction@execute', 'as' => 'usersById']);

Route::post('/users',['middleware' => 'auth.role:admin', 'uses' => 'Users\StoreUserAction@execute', 'as' => 'createUser']);

Route::delete('/users/{id}', ['middleware' => 'auth.role:admin', 'uses' => 'Users\DeleteUserAction@execute', 'as' => 'removeUser']);

Route::put('/users/{id}', ['middleware' => 'auth.role:admin', 'uses' => 'Users\UpdateUserAction@execute', 'as' => 'editUser']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function ($router) {
    Route::post('login', 'AuthAction@login')->name('login');
    Route::post('logout', 'AuthAction@logout')->name('logout');
    Route::post('renew-token', 'AuthAction@refresh')->name('renew-token');
    Route::post('me', 'AuthAction@me')->name('getMe');
});
