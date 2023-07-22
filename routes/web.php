<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ReparacionController;
use App\Http\Controllers\TecnicoController;
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

Route::redirect('/', '/login');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('can:user.proyectos.index');

//Route::resource('proyectos',App\Http\Controllers\ProyectoController::class);//->middleware('can:tecnico.proyectos.index');
Route::resource('equipos',App\Http\Controllers\EquipoController::class)->middleware('can:tecnico.proyectos.index');
Route::resource('user', UserController::class)->only('index','edit','update')->middleware('can:admin.proyectos.destroy');


Route::resource('seguimientos',SeguimientoController::class)->middleware('can:tecnico.proyectos.index');

//----Para los proyectos
//la ruta "mis_proyectos redirecciona a una vista diferente, deendiendo si eres un cliente o un trabajador 
Route::get('/proyecto/mis-proyectos', [ProyectoController::class, 'mis_proyectos'])->name('mis_proyectos')->middleware('can:user.proyectos.index'); //para cliente y trabajador


Route::get('/proyecto/folio', [ProyectoController::class, 'getFolio'])->middleware('can:tecnico.proyectos.index');
Route::get('/proyecto/diagnostico', [ProyectoController::class, 'diagnostico'])->middleware('can:tecnico.proyectos.index');
//Esta ruta define a que vista ir dependiedo en que etapa de encuetre 
Route::post('/proyecto/etapa', [ProyectoController::class, 'irEtapa'])->name('definirEtapa')->middleware('can:tecnico.proyectos.index');
//Esta ruta cambia de etapa a cada proyecto
Route::post('/proyecto/cambiarEtapa', [ProyectoController::class, 'cambiarEtapa'])->middleware('can:tecnico.proyectos.index');
Route::resource('/proyecto',ProyectoController::class)->names('proyecto')->middleware('can:tecnico.proyectos.index');
//-- fin proyectos

//Rutas del cliente aqui ve los diagnosticos y autoriza 
Route::post('/cliente/autorizar', [ProyectoController::class, 'autorizacion'])->middleware('can:user.proyectos.index');
Route::post('/cliente/ver-proyecto', [ProyectoController::class, 'clienteVerProyecto'])->middleware('can:user.proyectos.index');




//Reparacion
Route::post('/agregar/imagen',[ReparacionController::class, 'store'])->name('mi.ruta')->middleware('can:tecnico.proyectos.index');
Route::resource('reparacion',App\Http\Controllers\ReparacionController::class)->middleware('can:tecnico.proyectos.index');


// Para Crud de clientes
//ls dos rutas siguentes se ocupan en la vista de crear un nuevo proyecto
Route::get('/cliente/listado/{cliente}', [ClienteController::class, 'filtrar_cliente'])->middleware('can:tecnico.proyectos.index');  
Route::get('/cliente/listado/', [ClienteController::class, 'lista_clientes'])->middleware('can:tecnico.proyectos.index');
Route::resource('/cliente',ClienteController::class)->middleware('can:tecnico.proyectos.index');


//crud de tecnicos
Route::resource('/tecnicos',TecnicoController::class)->middleware('can:admin.proyectos.destroy');

