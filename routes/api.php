<?php

use App\Http\Controllers\Api\AddTagController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\CharacterMetaController;
use App\Http\Controllers\Api\DiffController;
use App\Http\Controllers\Api\NpcController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RemoveTagController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('guest')->name('guest.')->group(function () {
    Route::prefix('topics')->name('topics.')->group(function () {
        Route::get('/', [TopicController::class, 'indexForEveryone'])->name('indexForEveryone');
        Route::get('/{topic}/show', [TopicController::class, 'show'])->name('show');
    });
});

Route::middleware('checkToken')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('register', [AuthController::class, 'register'])->name('register')->withoutMiddleware('checkToken');
        Route::post('login', [AuthController::class, 'login'])->name('login')->withoutMiddleware('checkToken');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}/show', [UserController::class, 'show'])->name('show');
    });

    Route::prefix('/profile')->name('profile.')->group(function () {
       Route::get('/me', [ProfileController::class, 'me'])->name('me');
       Route::post('/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('upload-avatar');
    });

    Route::prefix('npcs')->name('npcs.')->group(function () {
        Route::get('/', [NpcController::class, 'index'])->name('index');
        Route::get('/{npc}/show', [NpcController::class, 'show'])->name('show');
    });

    Route::prefix('tags')->name('tags.')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
    });

    Route::prefix('characters')->name('characters.')->group(function () {
        Route::get('/', [CharacterController::class, 'index'])->name('index');
        Route::get('my-characters', [CharacterController::class, 'authUserCharacters'])->name('my-characters');
        Route::post('create', [CharacterController::class, 'create'])->name('create');
        Route::get('/{character}/show', [CharacterController::class, 'show'])->name('show');
        Route::post('/add-meta', [CharacterMetaController::class, 'create'])->name('add-meta');
        Route::post('{character}/verification-data', [CharacterController::class, 'createReviewData'])->name('verification-data');
        Route::post('/{character}/update-verification-data', [CharacterController::class, 'updateReviewData'])->name('update-verification-data');
    });

    Route::prefix('topics')->name('topics.')->group(function () {
        Route::get('/', [TopicController::class, 'indexForAuthenticatedUser'])->name('indexForAuthenticatedUser');
        Route::get('/{topic}/show', [TopicController::class, 'show'])->name('show');
    });

    Route::prefix('sections')->name('sections.')->group(function () {
        Route::get('/', [SectionController::class, 'index'])->name('index');
        Route::get('{section}/show', [SectionController::class, 'show'])->name('show');
    });

    Route::middleware('admin')->group(function () {
        Route::prefix('/admin')->name('admin.')->group(function () {

            Route::prefix('users')->name('users.')->group(function () {
                Route::post('/create', [UserController::class, 'store'])->name('create');
                Route::put('/{user}/update', [UserController::class, 'update'])->name('update');
                Route::delete('/{user}/delete', [UserController::class, 'delete'])->name('delete');
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

            Route::prefix('remove-tags')->name('remove-tags.')->group(function () {
                Route::post('/{npc}/npc', [RemoveTagController::class, 'forNpc'])->name('npc');
            });

            Route::prefix('npcs')->name('npcs.')->group(function () {
                Route::post('/create', [NpcController::class, 'create'])->name('create');
                Route::patch('/{npc}/update', [NpcController::class, 'update'])->name('update');
                Route::delete('/{npc}/delete', [NpcController::class, 'delete'])->name('destroy');
            });

            Route::prefix('/characters')->name('characters.')->group(function () {
                Route::get('/', [CharacterController::class, 'index'])->name('index');
            });

            Route::prefix('/diffs')->name('diffs.')->group(function () {
                Route::get('/', [DiffController::class, 'index'])->name('index');
                Route::get('/{character}/show', [DiffController::class, 'show'])->name('show');
                Route::post('/{character}/accept-all', [DiffController::class, 'acceptAll'])->name('accept-all');
                Route::post('/{character}/accept-selectively', [DiffController::class, 'acceptSelectively'])->name('accept-selectively');
                Route::post('/{character}/reject-all', [DiffController::class, 'rejectAll'])->name('reject-all');
                Route::post('/{character}/reject-selectively', [DiffController::class, 'rejectSelectively'])->name('reject-selectively');
            });

            Route::prefix('sections')->name('sections.')->group(function () {
                Route::get('/', [SectionController::class, 'index'])->name('index');
                Route::get('{section}/show', [SectionController::class, 'show'])->name('show');
                Route::post('/create', [SectionController::class, 'create'])->name('create');
                Route::patch('/{section}/update', [SectionController::class, 'update'])->name('update');
                Route::delete('{section}/delete', [SectionController::class, 'delete'])->name('destroy');
            });

            Route::prefix('topics')->name('topics.')->group(function () {
                Route::get('/', [TopicController::class, 'index'])->name('index');
                Route::post('/create', [TopicController::class, 'create'])->name('create');
                Route::get('/{topic}/show', [TopicController::class, 'show'])->name('show');
                Route::patch('{topic}/update', [TopicController::class, 'update'])->name('update');
                Route::delete('{topic}/delete', [TopicController::class, 'delete'])->name('destroy');
            });

        });
    });
});
