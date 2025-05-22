<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpotifyController;

Route::get('/spotify/get/{id}', [SpotifyController::class, 'getArtist']);

Route::get('/spotify/search/{name}', [SpotifyController::class, 'searchArtist']);


