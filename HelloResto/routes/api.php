<?php

use App\Models\User;
use App\Models\Restaurant;
use App\Http\Resources\UserResource;
use App\Http\Resources\RestaurantsResource;
use App\Http\Resources\MenuResource;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/auth', [AuthController::class, 'connect'])->name('login');
Route::get('/users', function(){
    return UserResource::collection(User::all());
});


Route::get('/restaurants', function(){
    return RestaurantsResource::collection(Restaurant::all());
});
Route::post('/restaurant', [RestaurantController::class, 'create'])->name('créer restaurant');
Route::put('/restaurant/{id}', [RestaurantController::class, 'update'])->name('modifier un restaurant');
Route::delete('/restaurant/{id}', [RestaurantController::class, 'destroy'])->name('supprimer un restaurant');

Route::get('/restaurant/{id}/menus', [MenuController::class, 'show'])->name('récupérer les menus d un restaurant');
Route::post('/restaurant/{id}/menu', [MenuController::class, 'create'])->name('créer un menu pour un restaurant');
Route::put('/restaurant/{id}/menu/{i}', [MenuController::class, 'update'])->name('modifier un menu pour un restaurant');
Route::delete('/restaurant/{id}/menu/{i}', [MenuController::class, 'destroy'])->name('Supprimer un menu pour un restaurant');
