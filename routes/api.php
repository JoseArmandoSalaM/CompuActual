<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\HallazgoController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\AutorizacionController;


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



//Para ver el proyecto
Route::get('/proyecto/{id}', [ProyectoController::class,'verProyecto']);
Route::post('/proyecto/cambiarEtapa', [ProyectoController::class, 'cambiarEtapa']);


//Rutas para acualizar las caracteristicas del equipo
Route::get('equipo/{id}', [ProyectoController::class, 'verCaracteristicas']);
Route::put('equipo/{id}',[ProyectoController::class,'caracteristicasRealesSave']);

//Route::resource('diagnitico',DiagnosticoController::class);
//Rutas para CRUD de hallazgos
Route::delete('hallazgos/{id}',[HallazgoController::class,'destroy']);
Route::get('hallazgos/{proyecto}',[HallazgoController::class,'index']);
Route::get('hallazgos/{id}/edit',[HallazgoController::class,'edit']);
Route::post('hallazgos/',[HallazgoController::class,'store']);
Route::put('hallazgos/{id}',[HallazgoController::class,'update']);


//Rutas para CRUD de Diagnosticos
Route::get('diagnostico/{idDiagnostico}',[DiagnosticoController::class,'index']);
Route::get('diagnostico/{idDiagnostico}/edit',[DiagnosticoController::class,'edit']);
Route::delete('diagnostico/{id}',[DiagnosticoController::class,'destroy']);
Route::post('diagnostico/',[DiagnosticoController::class,'store']);
Route::post('diagnostico/{id}',[DiagnosticoController::class,'update']);
// --- Ruta para obtener imagen del diagnostico
Route::get('diagnostico/image/{filename}',[DiagnosticoController::class,'getImage']);

Route::post('/autorizacion', [AutorizacionController::class,'store']);
Route::get('/autorizacion/{id}', [AutorizacionController::class,'index']);
Route::delete('/autorizacion/{id}', [AutorizacionController::class,'destroy']);



