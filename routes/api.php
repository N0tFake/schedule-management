<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Courses\CoursesController;
use App\Http\Controllers\Disciplines\DisciplinesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/status', function(){
        return response()->json(['status' => 'ok']);
    });

    Route::prefix('course')->group(function () {
        Route::get('/list', [CoursesController::class, 'index']);
        Route::get('/show/{id}', [CoursesController::class, 'show']);
    });

    Route::prefix('discipline')->group(function () {
        Route::get('/list', [DisciplinesController::class, 'index']);
        Route::get('/show/{id}', [DisciplinesController::class, 'show']);
    });

    Route::prefix('admin')->middleware('admin')->group(function (){
        Route::patch('/role', [AdminController::class, 'defineRole']);
        Route::prefix('course')->group(function (){
            Route::post('/create', [CoursesController::class, 'store']);
            Route::put('/update/{id}', [CoursesController::class, 'update']);
            Route::delete('/delete/{id}', [CoursesController::class, 'destroy']);
        });
    });
    
    Route::prefix('discipline')->middleware('coordinator')->group(function (){
        Route::post('/create', [DisciplinesController::class, 'store']);
        Route::put('/update/{id}', [DisciplinesController::class, 'update']);
        Route::delete('/delete/{id}', [DisciplinesController::class, 'destroy']);
    });

});
