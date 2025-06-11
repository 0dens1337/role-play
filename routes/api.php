<?php

use App\Http\Controllers\Api\AddTagController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NpcController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('register', [AuthController::class, 'register'])->name('register')->withoutMiddleware('auth');
        Route::post('login', [AuthController::class, 'login'])->name('login')->withoutMiddleware('auth');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}/show', [UserController::class, 'show'])->name('show');
        Route::post('/create', [UserController::class, 'store'])->name('create');
        Route::put('/{user}/update', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}/delete', [UserController::class, 'delete'])->name('delete');
    });

    Route::prefix('npcs')->name('npcs.')->group(function () {
        Route::get('/', [NpcController::class, 'index'])->name('index');
        Route::get('/{npc}/show', [NpcController::class, 'show'])->name('show');
        Route::post('/create', [NpcController::class, 'create'])->name('create');
        Route::patch('/{npc}/update', [NpcController::class, 'update'])->name('update');
        Route::delete('/{npc}/delete', [NpcController::class, 'delete'])->name('destroy');
    });

    Route::prefix('tags')->name('tags.')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::post('/create', [TagController::class, 'create'])->name('create');
        Route::patch('/{tag}/update', [TagController::class, 'update'])->name('update');
        Route::delete('/{tag}/delete', [TagController::class, 'delete'])->name('destroy');
    });

    Route::prefix('add-tags')->name('add-tags.')->group(function () {
        Route::post('/{npc}/npc', [AddTagController::class, 'forNpc'])->name('npc');
    });
});
