<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

Route::get('/', [userController::class, 'inicio'])->name('usuario.inicio');

Route::post('/addUser', [userController::class, 'store'])->name('usuario.store');

Route::get('/usuarios', [userController::class, 'index'])->name('usuario.index');
Route::get('/usuario/{id}/edit', [userController::class, 'edit'])->name('usuario.edit');
Route::put('/usuario/{id}', [userController::class, 'update'])->name('usuario.update');
Route::delete('/usuario/{id}', [userController::class, 'destroy'])->name('usuario.destroy');
