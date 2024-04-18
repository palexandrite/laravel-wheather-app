<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WheatherController;

Route::controller(WheatherController::class)->group(function () {

    Route::post('/ask-wheather', 'askWheather');

});