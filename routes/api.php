<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskeController;




Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);




Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/showCategories/{category}', [CategoryController::class, 'show']);
    Route::get('/allCategoties', [CategoryController::class, 'index']);
    Route::delete('/destroyCategoties/{category}', [CategoryController::class, 'destroy']);
    
    //    taskes 
    Route::post('categories/{category}/tasks',[TaskeController::class,'store']);
    Route::put('updateTaske/{taske}',[TaskeController::class,'update']);
    Route::get('categories/{category}/tasks/{taske}',[TaskeController::class,'show']);
    Route::get('categories/{category}/tasks',[TaskeController::class,'index']);
    Route::delete('categories/{category}/tasks/{taske}', [TaskeController::class, 'destroy']);

    
    Route::post('logout', [UserController::class, 'logout']);
});
