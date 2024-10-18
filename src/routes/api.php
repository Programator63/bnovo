<?php


use App\Http\Middleware\DebugHeaders;
use Illuminate\Support\Facades\Route;


Route::apiResource('guest', 'App\Http\Controllers\GuestController')->middleware(DebugHeaders::class);
