<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::post('api/signup', 'UserController@signup')->name('signup'); // Named route for signup
Route::get('/signup', 'UserController@signup')->name('signup'); // Named route for signup
Route::get('/test', function () {
    return 'Test route works';
});

// Redirect to a named route after signup
Route::get('/signup-test', function (Request $request) {
    // Assuming 'home' is the name of the route you want to redirect to
    return redirect()->route('login');
});
