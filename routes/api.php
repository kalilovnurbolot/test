<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StocksController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CharacteristicsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/category/create',[CategoryController::class,'store']);
Route::post('/product/create', [ProductController::class, 'store']);
Route::post('/stock/create', [StocksController::class, 'store']);
Route::post('/characteristics/create', [CharacteristicsController::class, 'store']);
Route::get('/goods/{id}', [ProductController::class, 'show']);
Route::post('/goods', [ProductController::class, 'index']);
