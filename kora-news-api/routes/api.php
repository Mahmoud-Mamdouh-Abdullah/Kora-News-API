<?php

use App\Http\Controllers\NewsCotroller;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('news/{id}', [NewsCotroller::class, 'update']);

Route::delete('news/{id}', [NewsCotroller::class, 'destroy']);

Route::get('news', [NewsCotroller::class, 'index']);

Route::post('news', [NewsCotroller::class, 'store']);

Route::get('news/sort/desc', [NewsCotroller::class, 'sortDesc']);

Route::get('news/sort/asc', [NewsCotroller::class, 'sortAsc']);
