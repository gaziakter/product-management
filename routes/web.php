<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('products', [ProductController::class, 'list'])->name('products.list');
Route::get('products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/specific', [ProductController::class, 'specific'])->name('products.specific');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::get('products/{id}/update', [ProductController::class, 'update'])->name('products.update');
Route::get('products/{id}/delete', [ProductController::class, 'delete'])->name('products.delete');