<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ReparacionController;
use App\Http\Controllers\Admin\SeguimientoController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::resource('proyectos',App\Http\Controllers\ProyectoController::class);//->middleware('can:tecnico.proyectos.index');
Route::resource('equipos',App\Http\Controllers\EquipoController::class);
Route::resource('user', UserController::class)->only('index','edit','update');


Route::resource('seguimientos',SeguimientoController::class);

//Para los proyectos
Route::get('/proyecto/mis-proyectos', [ProyectoController::class, 'mis_proyectos'])->name('mis_proyectos');
Route::get('/proyecto/folio', [ProyectoController::class, 'getFolio']);
Route::get('/proyecto/diagnostico', [ProyectoController::class, 'diagnostico']);

Route::post('/proyecto/etapa', [ProyectoController::class, 'irEtapa'])->name('definirEtapa');

Route::post('/proyecto/cambiarEtapa', [ProyectoController::class, 'cambiarEtapa']);

Route::resource('/proyecto',ProyectoController::class);



//-- fin proyectos

Route::post('/cliente/autorizar', [ProyectoController::class, 'autorizacion']);




//Reparacion
Route::post('/agregar/imagen',[ReparacionController::class, 'store'])->name('mi.ruta');
Route::resource('reparacion',App\Http\Controllers\ReparacionController::class);


// Para Crud de clientes
Route::get('/cliente/listado/{cliente}', [ClienteController::class, 'filtrar_cliente']);  
Route::get('/cliente/listado/', [ClienteController::class, 'lista_clientes']);  

Route::resource('/cliente',ClienteController::class);