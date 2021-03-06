<?php

use App\Http\Controllers\BarangController;
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

Route::get('/report', [BarangController::class, 'getMonthlyReport']);
Route::get('/supplies', [BarangController::class, 'getAvgSupplies']);
Route::post('/supplies', [BarangController::class, 'addSupplies']);
Route::post('/supplies/distribute', [BarangController::class, 'distributeSupplies']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
