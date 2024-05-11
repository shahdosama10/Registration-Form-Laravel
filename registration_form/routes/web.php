<?php

use App\Http\Controllers\RegistrationController; 

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return view('register');
});

Route::post('/register', [RegistrationController::class, 'register'])->name('register');

Route::get('/{lang?}', function ($lang = "en") {
    if ($lang) {
        App::setLocale($lang);
    }
    return view('register');
});

?>
