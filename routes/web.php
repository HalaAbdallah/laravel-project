<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    $name = 'Hala';
    $departments = [
        '1'=>'Technical',
        '2'=>'Financial',
        '3'=>'Sales'
    ];
    //1. return view('about')->with('name', '$name');
    //2. return view('about', data: ['name' => $name]);
    //3.
    return view('about', compact('name', 'departments'));

});

Route::post('/about', function () {
    $name = $_POST['name'];
    $departments = [
        '1'=>'Technical',
        '2'=>'Financial',
        '3'=>'Sales'
    ];
    return view('about', compact('name'));
});

// Task Routes
Route::get('tasks', [TaskController::class, 'index']);
Route::post('create', [TaskController::class, 'create']);
Route::post('delete/{id}', [TaskController::class, 'destroy']);
Route::post('edit/{id}', [TaskController::class, 'edit']);
Route::post('update', [TaskController::class, 'update']);

// User Routes
Route::get('users', [UserController::class, 'index']);
Route::post('create', [UserController::class, 'create']);
Route::post('delete/{id}', [UserController::class, 'destroy']);
Route::post('edit/{id}', [UserController::class, 'edit']);
Route::post('update', [UserController::class, 'update']);

Route::get('app', function(){
    return view('layouts.app');
});
