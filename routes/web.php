<?php

use Illuminate\Support\Facades\Route;

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
    return view('about', data: compact('name', 'departments'));

});

Route::post('/about', function () {
    $name = $_POST['name'];
    $departments = [
        '1'=>'Technical',
        '2'=>'Financial',
        '3'=>'Sales'
    ];
    return view('about', data:compact('name'));
});


Route::get('tasks', function(){

    return view('tasks');
});

Route::post('create', function(){
    $task_name = $_POST['name'];
    DB::table('tasks')->insert(['name'=>$task_name]);

    return view('tasks');
});
