<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('index');
})->name('home');

//Autenticacion
// Mostrar formulario de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
// Procesar inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Mostrar formulario de registro
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
// Procesar registro de nuevo usuario
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Rutas de admin para CRUD
Route::get('/admin/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/admin/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');


// Rutas Para los modulos

//Hombre
Route::get('/hombre', function () {
    return view('hombre');
})->name('hombre');

//Mujer
Route::get('/mujer', function () {
    return view('mujer');
})->name('mujer');

//Niños
Route::get('/ninos', function () {
    return view('niños');
})->name('niños');

//Nosotros
Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');