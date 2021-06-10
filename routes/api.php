<?php

use Illuminate\Http\Request;
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

Route::get('/', function () {
    return ['message' => "API works !"];
});

/**
 * Auth
 */

// Route::post('/register', 'AuthController@register');
// Route::post('/login', 'AuthController@login');
// Route::middleware('auth:sanctum')->post('/logout', 'AuthController@logout');

/**
 * Board Games
 */

Route::get('/boardgames', 'BoardGameController@index');
Route::get('/boardgames/{id}', 'BoardGameController@show');
// Route::middleware('auth:sanctum')->post('/types', 'TypeController@store');

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
