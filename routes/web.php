<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MessagesController;

Route::get('/', function () {
    return view('index');
});

Route::get('/main', function () {
    return view('logged.main');
})->middleware('auth');

// handling authenication
// shows register form
Route::get('/register',[UsersController::class, 'register'])->middleware('guest');
// shows login form
Route::get('/login',[UsersController::class, 'login']);
// log out user
Route::get('/logout',[UsersController::class, 'logout'])->middleware('auth');

//store user in db
Route::post('/register/user',[UsersController::class, 'store']);
//check user credentials to login
Route::post('/login/user',[UsersController::class, 'loginUser']);

//shows profile of user or others
Route::get('/profile/{id}',[UsersController::class, 'profile'])->name('profile');

//update user profile
Route::put('/update/{user}',[UsersController::class, 'update'])->middleware('auth');

//delete user profile picture
Route::delete('/delete/picture',[UsersController::class, 'deletePicture'])->middleware('auth');

//Sending user a message
Route::post('/message/store',[MessagesController::class, 'store'])->middleware('auth');

//show messages page
Route::get('/messages', [MessagesController::class, 'index'])->middleware('auth');

//search for users
Route::get('/search', [UsersController::class, 'search']);

