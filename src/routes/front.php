<?php

Route::get('login',
    ['uses' => \Myrtle\Core\Users\Http\Controllers\AuthenticationController::class . '@login', 'as' => 'login']);

Route::get('logout',
    ['uses' => \Myrtle\Core\Users\Http\Controllers\AuthenticationController::class . '@logout', 'as' => 'logout']);

Route::post('authenticate',
    [
        'uses' => \Myrtle\Core\Users\Http\Controllers\AuthenticationController::class . '@authenticate',
        'as' => 'authenticate'
    ]);

Route::get('register', [
    'uses' => \Myrtle\Core\Users\Http\Controllers\RegistrationController::class . '@index',
    'as' => 'register',
]);

Route::put('register', [
    'uses' => \Myrtle\Core\Users\Http\Controllers\RegistrationController::class . '@store',
    'as' => 'register',
]);