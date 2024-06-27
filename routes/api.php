<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ProductoController;

//API´S para la tabla Categoria
Route::get('categorias', [CategoriaController::class, 'index']);
Route::get('categorias/{id}', [CategoriaController::class, 'show']);
Route::post('categorias', [CategoriaController::class, 'store']);
Route::put('categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy']);

//API'S para la tabla Producto
Route::get('productos', [ProductoController::class, 'index']);
Route::get('productos/{id}', [ProductoController::class, 'show']);
Route::post('productos', [ProductoController::class, 'store']);
Route::post('productos/{id}', [ProductoController::class, 'update']);
Route::delete('productos/{id}', [ProductoController::class, 'destroy']);

//API'S para la tabla Oferta
Route::get('ofertas', [OfertaController::class, 'index']);
Route::get('ofertas/{id}', [OfertaController::class, 'show']);
Route::post('ofertas', [OfertaController::class, 'store']);
Route::post('ofertas/{id}', [OfertaController::class, 'update']);
Route::delete('ofertas/{id}', [OfertaController::class, 'destroy']);

//API´S para la tabla Carrito
Route::get('carrito', [CarritoController::class, 'index']);
Route::get('carrito/{id}', [CarritoController::class, 'show']);
Route::post('carrito', [CarritoController::class, 'store']);
Route::put('carrito/{id}', [CarritoController::class, 'update']);
Route::delete('carrito/{id}', [CarritoController::class, 'destroy']);

//API´S para la tabla Pedido
Route::get('pedidos', [PedidoController::class, 'index']);
Route::get('pedidos/{id}', [PedidoController::class, 'show']);
Route::post('pedidos', [PedidoController::class, 'store']);
Route::put('pedidos/{id}', [PedidoController::class, 'update']);
Route::delete('pedidos/{id}', [PedidoController::class, 'destroy']);

//API´S para el login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');