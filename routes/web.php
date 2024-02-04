<?php

use App\Http\Controllers\EquiposController;
use App\Http\Controllers\HerramientasController;
use App\Http\Controllers\LaboratoriosController;
use App\Http\Controllers\MaterialGastableController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\UsuariosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');


//Rutas para reservas
Route::get('/reservas/show', [ReservasController::class, 'misReservas'])->middleware(['auth']);
Route::get('/reservas/crear', [ReservasController::class, 'crear'])->middleware(['auth']);
Route::get('/reservas/crear/dia', [ReservasController::class, 'crearPorDia'])->middleware(['auth']);
Route::get('/reservas/crear/{id}', [ReservasController::class, 'crearPorLab'])->middleware(['auth']);
Route::get('/reservas/crear/dia/{id}', [ReservasController::class, 'crearPorDiaPorLab'])->middleware(['auth']);
Route::post('/reservas/store', [ReservasController::class, 'store'])->middleware(['auth']);
Route::post('/reservas/store/dia', [ReservasController::class, 'storePorDia'])->middleware(['auth']);
Route::get('/reservas/detalles/{id}',[ReservasController::class, 'detalles'])->middleware(['auth']);
Route::get('/reservas/gestionar', [ReservasController::class, 'gestionar'])->middleware(['admin']);
Route::get('/reservas/gestionar/{id}', [ReservasController::class, 'gestionReserva'])->middleware(['admin']);
Route::post('/reservas/aprobar', [ReservasController::class, 'aprobarReserva'])->middleware(['admin']);
Route::post('/reservas/rechazar', [ReservasController::class, 'rechazarReserva'])->middleware(['admin']);
Route::post('/reservas/cancelar', [ReservasController::class, 'cancelarReserva'])->middleware(['admin']);
Route::get('/reservas/entregar/{id}',[ReservasController::class, 'entregarReserva'])->middleware(['admin']);
Route::post('/reservas/aprobar-entrega',[ReservasController::class, 'aprobarEntrega'])->middleware(['admin']);


//Rutas para módulos

Route::get('/modulos/show', [ModulosController::class, 'index'])->middleware(['admin']); //admin
Route::get('/modulos/crear', [ModulosController::class, 'crear'])->middleware(['admin']); //admin
Route::post('/modulos/store', [ModulosController::class, 'store'])->middleware(['admin']); //admin
Route::get('/modulos/edit/{modulo}', [ModulosController::class, 'edit'])->middleware(['admin']); //admin
Route::post('/modulos/update/{modulo}', [ModulosController::class, 'update'])->middleware(['admin']); //admin
Route::delete('/modulos/destroy/{id}', [ModulosController::class, 'destroy'])->middleware(['admin']); //admin

//Rutas para usuarios
Route::get('/usuarios/show', [UsuariosController::class, 'index'])->middleware(['admin']); //admin
Route::get('/usuarios/crear', [UsuariosController::class, 'crear'])->middleware(['admin']); //admin
Route::post('/usuarios/store', [UsuariosController::class, 'store'])->middleware(['admin']); //admin
Route::get('/usuarios/rol/{user}',[UsuariosController::class, 'cambiarRol'])->middleware(['admin']); //admin
Route::put('/usuarios/rol/update/{user}', [UsuariosController::class, 'updateRol'])->middleware(['admin']); //admin
Route::delete('/usuario/destroy/{id}', [UsuariosController::class, 'destroy'])->middleware(['admin']); //admin

//Rutas para mi cuenta
Route::get('/cuenta', [UsuariosController::class, 'miCuenta'])->middleware(['auth']);
Route::post('/cuenta/update/{user}', [UsuariosController::class, 'update'])->middleware(['auth']);
Route::get('/cuenta/update/password', [UsuariosController::class, 'updatePasswordView'])->middleware(['auth']);
Route::post('/cuenta/update-password', [UsuariosController::class, 'updatePassword'])->middleware(['auth']);




Route::get('/laboratorios', [LaboratoriosController::class, 'index'])->middleware('auth');
Route::get('/laboratorios/ingreso', [LaboratoriosController::class, 'create'])->middleware('auth');
Route::post('/laboratorios/store', [LaboratoriosController::class, 'store'])->middleware('auth');
Route::post('/laboratorios/laboratoriosRecursos/{idLaboratorios}', [LaboratoriosController::class, 'recursosLab'])->middleware('auth');
Route::put('/laboratorios/update/{idLaboratorios}', [LaboratoriosController::class, 'update'])->middleware('auth');

Route::get('/equipos/show', [EquiposController::class, 'index'])->middleware('admin');
Route::get('/equipos/programas/{idEquipos}', [EquiposController::class, 'programas_get'])->middleware('admin');
Route::get('/equipos/ingreso', [EquiposController::class, 'create'])->middleware('admin')->name('ingresarEquipos');
Route::post('/equipos/store', [EquiposController::class, 'store'])->middleware('admin');
Route::put('/equipos/update/{idEquipos}', [EquiposController::class, 'update'])->middleware('admin');


Route::get('/herramientas/show', [HerramientasController::class, 'index'])->middleware('admin');
Route::get('/herramientas/ingreso', [HerramientasController::class, 'create'])->middleware('admin');
Route::post('/herramientas/store', [HerramientasController::class, 'store'])->middleware('admin');
Route::put('/herramientas/update/{idHerramientas}', [HerramientasController::class, 'update'])->middleware('admin');


Route::get('/materialGastable/show', [MaterialGastableController::class, 'index'])->middleware('admin');
Route::get('/materialGastable/ingreso', [MaterialGastableController::class, 'create'])->middleware('admin');
Route::post('/materialGastable/store', [MaterialGastableController::class, 'store'])->middleware('admin');
Route::put('/materialGastable/update/{idMaterialGastable}', [MaterialGastableController::class, 'update'])->middleware('admin');

