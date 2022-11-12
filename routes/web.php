<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'login');
Route::post('autenticar', [LoginController::class, 'validarInicio'])->name('validarInicio');
Route::post('salir', [LoginController::class, 'finalizarSesion'])->name('salir');  

Route::get('administrador', [AdministradorController::class, 'index'])->name('adminDash');
Route::post('administrador/nuevousuario', [AdministradorController::class, 'nuevoUsuario'])->name('adminNuevoUsuario');
Route::post('administrador/editarusuario', [AdministradorController::class, 'modificarUsuario'])->name('adminEditarUsuario');
Route::get('administrador/detallesUsuario', [AdministradorController::class, 'obtenerDetalles'])->name('detallesUsuario');

Route::get('administrador/grupostrabajo', [AdministradorController::class, 'indexGruposTrabajo'])->name('adminGrupos');
Route::get('administrador/detallesEspacioTrabajo', [AdministradorController::class, 'detallesEspacioTrabajo'])->name('adminDetalleGT');
Route::post('administrador/nuevogrupotrabajo', [AdministradorController::class, 'nuevoGrupoTrabajo'])->name('adminNuevoGT');
Route::post('administrador/agregardocentegt', [AdministradorController::class, 'agregarDocenteEspacioTrabajo'])->name('adminAddDocGT');

Route::get('administrador', [AdministradorController::class, 'index'])->name('adminDash');

