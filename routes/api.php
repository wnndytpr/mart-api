<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
Use App\Http\Controllers\LoginController;
Use App\Http\Controllers\ProdukController;

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

Route::post('/registrasi', [RegistrasiController::class, 'registrasi']);
Route::post('/login', [LoginController::class, 'login']);

Route::prefix('produk')->group(function () {
    Route::post('/', [ProdukController::class, 'create']);            // send data satu per satu
    Route::post('/bulk', [ProdukController::class, 'bulkCreate']);    // send data secara semua/lgsng banyak
    Route::get('/', [ProdukController::class, 'list']);               // lihat semua
    Route::get('/{id}', [ProdukController::class, 'detail']);         // detail by id
    Route::put('/{id}', [ProdukController::class, 'ubah']);           // update
    Route::delete('/{id}', [ProdukController::class, 'hapus']);       // hapus
});