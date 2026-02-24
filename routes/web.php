<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


Route::get('/test-log', function() {
    \Log::info('Test log message');
    return 'Check logs now';
});