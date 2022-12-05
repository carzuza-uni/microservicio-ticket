<?php

// use App\Http\Controllers\CalificacionController;
// use App\Http\Controllers\LibroController;
// use App\Http\Controllers\LoginController;
// use App\Http\Controllers\ServicioController;
// use App\Http\Controllers\SolicitudController;
// use App\Http\Controllers\UsuarioController;
// use App\Http\Controllers\UsuarioServicioController;

use App\Http\Controllers\LiquidacionController;
use App\Http\Controllers\TicketController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function () {
    return 'Hello World';
});

// Route::resource('libros', LibroController::class);
// Route::post('login', [LoginController::class, 'ingresar']);

// Route::resource('usuarios', UsuarioController::class);
// Route::resource('servicios', ServicioController::class);
// Route::get('servicios/listado-buscar/{texto}', [ServicioController::class, 'listadoBuscar']);

// Route::resource('solicitudes', SolicitudController::class);
// Route::get('solicitudes/listado-prestador/{prestador_id}', [SolicitudController::class, 'listadoPrestador']);
// Route::get('solicitudes/listado-cliente/{cliente_id}', [SolicitudController::class, 'listadoCliente']);
// Route::put('solicitudes/{id}/estado/{estado}', [SolicitudController::class, 'cambiarEstado']);
// Route::post('usuarioservicios', [UsuarioServicioController::class, 'store']);
// Route::get('usuarioservicios/listado-prestador/{prestador_id}', [UsuarioServicioController::class, 'listadoPrestador']);
// Route::put('usuarioservicios/eliminar/{id}', [UsuarioServicioController::class, 'destroy']);
// Route::post('calificaciones', [CalificacionController::class, 'store']);

// TICKET
Route::get('ticket', [TicketController::class, 'listado']);
Route::get('ticket/{ticket_id}', [TicketController::class, 'detalle']);
Route::post('ticket', [TicketController::class, 'store']);
Route::put('ticket/{id}/estado/{estado}', [TicketController::class, 'cambiarEstado']);

// LIQUIDACION
Route::get('liquidacion', [LiquidacionController::class, 'listado']);
Route::post('liquidacion', [LiquidacionController::class, 'store']);
Route::put('liquidacion/{id}/estado/{estado}', [LiquidacionController::class, 'cambiarEstado']);