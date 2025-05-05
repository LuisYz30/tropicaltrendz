<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CarritoController;


Route::get('/index', function () {
    return view('index');
})->name('index');

//Autenticacion
// Mostrar formulario de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
// Procesar inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Mostrar formulario de registro
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
// Procesar registro de nuevo usuario
Route::post('/register', [AuthController::class, 'register'])->name('register');


//Rutas de admin para CRUD
    Route::get('/admin/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/admin/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    // Rutas Para los modulos

// Hombre
Route::get('/hombre', [PublicController::class, 'hombre'])->name('hombre');

// Mujer
Route::get('/mujer', [PublicController::class, 'mujer'])->name('mujer');

// Niños
Route::get('/niños', [PublicController::class, 'niños'])->name('niños');

// Ofertas
Route::get('/ofertas', [PublicController::class, 'ofertas'])->name('ofertas');

// Detalle del producto
Route::get('/producto/{id}', [PublicController::class, 'detalleProducto'])->name('producto.detalle');

//Nosotros
Route::get('/nosotros', function () {
    return view('categorias.nosotros');
})->name('nosotros');

Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');
Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
Route::delete('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
