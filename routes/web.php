<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ReseñaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\FacturaController;

Route::get('/', [PublicController::class, 'index'])->name('index');;

// Redirección si alguien entra a /login o /register con GET
Route::get('/login', function () {
    return redirect()->route('index');
});
Route::get('/register', function () {
    return redirect()->route('index');
});
//Autenticacion

// Procesar inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Procesar registro de nuevo usuario
Route::post('/register', [AuthController::class, 'register'])->name('register');
// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/informes/detalles/{facturaId}', [ProductoController::class, 'detallesFactura']);


//Rutas de admin para CRUD
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/admin/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::get('/admin/informes', [ProductoController::class, 'informes'])->name('productos.informes');
});

// Rutas Para los modulos

Route::get('/hombre', [PublicController::class, 'hombre'])->name('hombre');
Route::get('/mujer', [PublicController::class, 'mujer'])->name('mujer');
Route::get('/niños', [PublicController::class, 'niños'])->name('niños');

Route::get('/ofertas', [PublicController::class, 'ofertas'])->name('ofertas');
Route::get('/producto/{id}', [PublicController::class, 'detalleProducto'])->name('producto.detalle');

//Nosotros
Route::get('/nosotros', function () {
    return view('categorias.nosotros');
})->name('nosotros');

// FAQ y metodos de pago 
Route::get('/FAQ', function () {
    return view('footer.FAQ');
})->name('FAQ');
Route::get('/Metodos de pago', function () {
    return view('footer.metodospago');
})->name('metodospago');

Route::middleware(['auth'])->group(function () {
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
Route::delete('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
});
Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');

//reseñas
Route::post('/reseñas', [ReseñaController::class, 'store'])->name('reseñas.store');
Route::get('/reseñas/{seccion}', [ReseñaController::class, 'index'])->name('reseñas.index');

Route::delete('/admin/reseñas/{id}', [ReseñaController::class, 'destroy'])->name('reseñas.destroy')->middleware('auth');
// FAQ y metodos de pago 
Route::get('/FAQ', function () {
    return view('footer.FAQ');
})->name('FAQ');
Route::get('/Metodos de pago', function () {
    return view('footer.metodospago');
})->name('metodospago');
// Recuperar contraseña



// Mostrar formulario para enviar enlace de recuperación
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Enviar el correo con el link
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Mostrar formulario para establecer nueva contraseña
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Actualizar contraseña
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');



//Pasarela de pago
Route::get('/pago', [PagoController::class, 'pagar'])->name('pago.iniciar');
Route::get('/pago/exito', [PagoController::class, 'exito'])->name('pago.exito');
Route::get('/pago/fallo', [PagoController::class, 'fallo'])->name('pago.fallo');
Route::get('/pago/pendiente', [PagoController::class, 'pendiente'])->name('pago.pendiente');
Route::post('/pago/confirmacion', [PagoController::class, 'confirmacion'])->name('pago.confirmacion');


Route::middleware('auth')->group(function () {
    Route::get('/cliente/editPerfil', [PerfilController::class, 'edit'])->name('cliente.edit');
    Route::post('/perfil/actualizar', [PerfilController::class, 'update'])->name('perfil.update');
});

Route::get('/factura/{id}/pdf', [FacturaController::class, 'generarPDF'])->name('factura.pdf');

