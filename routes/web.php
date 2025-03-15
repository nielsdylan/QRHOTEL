<?php

use App\Http\Controllers\Modulo\Auth\AuthController;
use App\Http\Controllers\Modulo\Configuraciones\ClienteController;
use App\Http\Controllers\Modulo\Configuraciones\HotelController;
use App\Http\Controllers\Modulo\HomeController;
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

    Route::name('clientes.')->prefix('clientes')->group(function () {
        Route::get('lista', [ClienteController::class, 'lista'])->name('lista');
        Route::post('listar', [ClienteController::class, 'listar'])->name('listar');
        Route::post('guardar', [ClienteController::class, 'guardar'])->name('guardar');
        Route::get('editar/{id}', [ClienteController::class, 'editar'])->name('editar');
        Route::put('eliminar/{id}', [ClienteController::class, 'eliminar'])->name('eliminar');
        // Route::get('nuevo', [GalleryController::class, 'nuevo'])->name('nuevo');
    });

    Route::name('administrador.')->prefix('administrador')->group(function () {
        // Route::name('configuraciones.')->prefix('configuraciones')->group(function () {
        //     Route::name('clientes.')->prefix('clientes')->group(function () {
        //         Route::get('lista', [ClienteController::class, 'lista'])->name('lista');
        //         Route::post('listar', [ClienteController::class, 'listar'])->name('listar');
        //         Route::post('guardar', [ClienteController::class, 'guardar'])->name('guardar');
        //         Route::get('editar/{id}', [ClienteController::class, 'editar'])->name('editar');
        //         Route::put('eliminar/{id}', [ClienteController::class, 'eliminar'])->name('eliminar');
        //         // Route::get('nuevo', [GalleryController::class, 'nuevo'])->name('nuevo');
        //     });
        // });
    });
});
