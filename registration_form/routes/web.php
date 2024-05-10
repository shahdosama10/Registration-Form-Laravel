<?php

use App\Http\Controllers\API_Ops_Controller;
use App\Http\Controllers\RegistrationController; 

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('register');
});

Route::post('/register', [RegistrationController::class, 'register'])->name('register');
Route::get('/getActors', [API_Ops_Controller::class, 'getActors'])->name('API');

?>
