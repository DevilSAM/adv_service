<?php

declare(strict_types=1);

use App\Http\Controllers\AdvertController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api'], function () {
    Route::resource('adverts', AdvertController::class)->only(['index', 'show', 'store']);
});

Route::get('/{any}', fn() => view('spa'))
    ->where('any', '.*')
    ->name('spa');
