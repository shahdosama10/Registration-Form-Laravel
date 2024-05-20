<?php

use App\Http\Controllers\API_Ops_Controller;
use App\Http\Controllers\RegistrationController; 

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\App;



use function Termwind\style;

Route::get('/', function () {
    return view('register');
});



Route::post('/register', [RegistrationController::class, 'register'])->name('register.register');
Route::get('/getActors', [API_Ops_Controller::class, 'getActors'])->name('API');

Route::get('/{lang?}', function ($lang = "en") {
    if ($lang) {
        
        App::setLocale($lang);
    }
    return view('register');
});



?>
