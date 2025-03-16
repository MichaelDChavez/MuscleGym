<?php

use App\Http\Controllers\api\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/productos/cantidad", [ApiController::class, "cantidadProductos"]);

Route::get('/satisfaccion/{idUsuario}/{idRespuesta}', [ApiController::class, 'respuestaSatisfaccion'])->name('api.satisfaccion');