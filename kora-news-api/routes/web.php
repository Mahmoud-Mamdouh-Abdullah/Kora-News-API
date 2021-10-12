<?php

use App\Http\Controllers\NewsCotroller;
use App\Models\News;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('news', [NewsCotroller::class, 'index']);

Route::get('news/create', [NewsCotroller::class, 'create']);

Route::get('news/{id}/edit', [NewsCotroller::class, 'edit']);

Route::put('news/{id}', [NewsCotroller::class, 'update']);

Route::delete('news/{id}', [NewsCotroller::class, 'destroy']);

Route::get('news', [NewsCotroller::class, 'index']);

Route::get('/', function() {
    return view('index');
});

Route::post('news', [NewsCotroller::class, 'store']);

Route::get('news/sort/desc', [NewsCotroller::class, 'sortDesc']);

Route::get('news/sort/asc', [NewsCotroller::class, 'sortAsc']);

Route::get('users/index', [NewsCotroller::class, 'userIndex']);