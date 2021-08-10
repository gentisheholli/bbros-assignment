<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ToDoCategoryController;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'ApiAuthController@login');
Route::post('/register','ApiAuthController@register');


Route::group(['prefix' => 'admin','middleware'=> 'auth:api'], function() {



    Route::get('to-dos', [ToDoController::class, 'index']);
    Route::get('to-do/{id}', [ToDoController::class, 'show']);
    Route::delete('to-do/{id}', [ToDoController::class, 'destroy']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::post('user', [UserController::class, 'store']);
    Route::post('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
  

    
    Route::get('to-do-categories', [ToDoCategoryController::class, 'index']);
    Route::get('to-do-category/{id}', [ToDoCategoryController::class, 'show']);
    Route::post('to-do-category', [ToDoCategoryController::class, 'store']);
    Route::patch('to-do-category/{id}', [ToDoCategoryController::class, 'update']);
    Route::delete('to-do-category/{id}', [ToDoCategoryController::class, 'destroy']);
  
});

Route::middleware('auth:api')->group(function () {

    Route::post('/logout', 'ApiAuthController@logout');

    Route::get('to-do-categories', [ToDoCategoryController::class, 'index']);
    // Route::get('estimate-by-categoryx', [ToDoController::class, 'index']);
    Route::get('estimate-by-category/{categoryId}', [ToDoController::class, 'getEstimationByCategory']);
    Route::get('to-do/{id}', [ToDoController::class, 'show']); 
    Route::patch('to-do/{id}', [ToDoController::class, 'update']); 
    Route::patch('to-do-status/{id}', [ToDoController::class, 'updateStatus']); 
    Route::patch('to-do-start/{id}', [ToDoController::class, 'startToDo']); 
    Route::delete('to-do/{id}', [ToDoController::class, 'destroy']); 
    Route::get('to-do', [UserController::class, 'userToDos']);
    Route::post('user/{id}', [UserController::class, 'update']);
    Route::get('user/to-do/{id}', [UserController::class, 'singleUserToDo']);

  
});

