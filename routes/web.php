<?php

use App\Http\Controllers\Modulo\Auth\AuthController;
use App\Http\Controllers\Modulo\ClientesController;
use App\Http\Controllers\Modulo\Configuraciones\CategoriaController;
use App\Http\Controllers\Modulo\Configuraciones\HabitacionController;
use App\Http\Controllers\Modulo\Configuraciones\HotelController;
use App\Http\Controllers\Modulo\Configuraciones\NivelController;
use App\Http\Controllers\Modulo\Configuraciones\UsuarioController;
use App\Http\Controllers\Modulo\HomeController;
use App\Http\Controllers\Modulo\RecepcionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('session', [AuthController::class, 'session'])->name('session');
});
Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::get('auto-seleccionar', [HotelController::class, 'autoSeleccionar'])->name('auto-seleccionar');
    Route::post('seleccionar-hotel', [HotelController::class, 'seleccionarHotel'])->name('seleccionar-hotel');

    Route::name('recepcion.')->prefix('recepcion')->group(function () {
        Route::get('lista', [RecepcionController::class, 'lista'])->name('lista');
        Route::get('registrar/{id}', [RecepcionController::class, 'registrar'])->name('registrar');

        Route::post('guardar', [RecepcionController::class, 'guardar'])->name('guardar');
        Route::get('editar/{id}', [RecepcionController::class, 'editar'])->name('editar');
        Route::put('eliminar/{id}', [RecepcionController::class, 'eliminar'])->name('eliminar');
        // Route::get('nuevo', [GalleryController::class, 'nuevo'])->name('nuevo');
    });

    Route::name('clientes.')->prefix('clientes')->group(function () {
        Route::get('lista', [ClientesController::class, 'lista'])->name('lista');
        Route::post('listar', [ClientesController::class, 'listar'])->name('listar');
        Route::post('guardar', [ClientesController::class, 'guardar'])->name('guardar');
        Route::get('editar/{id}', [ClientesController::class, 'editar'])->name('editar');
        Route::put('eliminar/{id}', [ClientesController::class, 'eliminar'])->name('eliminar');
        // Route::get('nuevo', [GalleryController::class, 'nuevo'])->name('nuevo');
    });

    Route::name('configuraciones.')->prefix('configuraciones')->group(function () {
        Route::name('habitacion.')->prefix('habitacion')->group(function () {
            Route::get('lista', [HabitacionController::class, 'lista'])->name('lista');
            Route::post('listar', [HabitacionController::class, 'listar'])->name('listar');
            Route::post('guardar', [HabitacionController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [HabitacionController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [HabitacionController::class, 'eliminar'])->name('eliminar');
            // Route::get('nuevo', [GalleryController::class, 'nuevo'])->name('nuevo');
        });
        Route::name('niveles.')->prefix('niveles')->group(function () {
            Route::get('lista', [NivelController::class, 'lista'])->name('lista');
            Route::post('listar', [NivelController::class, 'listar'])->name('listar');
            Route::post('guardar', [NivelController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [NivelController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [NivelController::class, 'eliminar'])->name('eliminar');
            // Route::get('nuevo', [GalleryController::class, 'nuevo'])->name('nuevo');
        });
        Route::name('categorias.')->prefix('categorias')->group(function () {
            Route::get('lista', [CategoriaController::class, 'lista'])->name('lista');
            Route::post('listar', [CategoriaController::class, 'listar'])->name('listar');
            Route::post('guardar', [CategoriaController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [CategoriaController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [CategoriaController::class, 'eliminar'])->name('eliminar');
            // Route::get('nuevo', [GalleryController::class, 'nuevo'])->name('nuevo');
        });
        Route::name('usuarios.')->prefix('usuarios')->group(function () {
            Route::get('lista', [UsuarioController::class, 'lista'])->name('lista');
            Route::post('listar', [UsuarioController::class, 'listar'])->name('listar');
            Route::post('guardar', [UsuarioController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [UsuarioController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [UsuarioController::class, 'eliminar'])->name('eliminar');
            // Route::get('nuevo', [GalleryController::class, 'nuevo'])->name('nuevo');
        });
    });

});
