<?php

use App\Http\Controllers\RegistrationController; 

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('register');
});

Route::post('/register', [RegistrationController::class, 'register'])->name('register');

?>
