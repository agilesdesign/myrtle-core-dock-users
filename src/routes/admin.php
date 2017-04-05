<?php

Route::group(['middleware' => 'can:users.access.admin'], function () {
    Route::resource('users', \Myrtle\Core\Users\Http\Controllers\Administrator\UsersController::class,
        ['except' => ['edit', 'update']]);

    Route::patch('users/{user}/enable', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserEnableController::class . '@update',
        'as' => 'users.enable'
    ]);

    Route::patch('users/{user}/disable', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserDisableController::class . '@update',
        'as' => 'users.disable'
    ]);

    Route::get('users/{user}/name', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserNameController::class . '@edit',
        'as' => 'users.name.edit'
    ]);

    Route::put('users/{user}/name', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserNameController::class . '@update',
        'as' => 'users.name.update'
    ]);

    Route::get('users/{user}/password', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserPasswordController::class . '@edit',
        'as' => 'users.password.edit'
    ]);

    Route::put('users/{user}/password', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserPasswordController::class . '@update',
        'as' => 'users.password.update'
    ]);

    Route::get('users/{user}/permissions', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserPermissionsController::class . '@edit',
        'as' => 'users.permissions.edit'
    ]);

    Route::put('users/{user}/permissions', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserPermissionsController::class . '@update',
        'as' => 'users.permissions.update'
    ]);

    Route::resource('users.addresses', \Myrtle\Core\Users\Http\Controllers\Administrator\UserAddressesController::class);

    Route::get('users/{user}/biograph', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserBiographController::class . '@edit',
        'as' => 'users.biograph.edit'
    ]);

    Route::put('users/{user}/biograph', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserBiographController::class . '@update',
        'as' => 'users.biograph.update'
    ]);

    Route::get('users/{user}/roles', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserRolesController::class . '@edit',
        'as' => 'users.roles.edit'
    ]);

    Route::put('users/{user}/roles', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UserRolesController::class . '@update',
        'as' => 'users.roles.update'
    ]);

    Route::resource('users.emails', \Myrtle\Core\Users\Http\Controllers\Administrator\UserEmailsController::class);

    Route::resource('users.phones', \Myrtle\Core\Users\Http\Controllers\Administrator\UserPhonesController::class);

    Route::get('dashboards/users', [
        'uses' => \Myrtle\Core\Users\Http\Controllers\Administrator\UsersController::class . '@dashboard',
        'as' => 'dashboards.users'
    ]);
});