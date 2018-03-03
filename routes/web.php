<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('patients/search', 'PatientsSearchController@index')->name('patients.search');
    Route::resource('patients', 'PatientsController');
    Route::resource('patients.medical_records', 'MedicalRecordsController', ['except' => ['edit', 'update']]);
    Route::resource('reports', 'ReportsController', ['only' => ['index', 'show']]);

    Route::middleware('can:admin')->group(function () {
        Route::get('/roles/reset', 'RolesController@reset')->name('roles.reset');
        Route::resource('roles', 'RolesController');
        Route::resource('permissions', 'PermissionsController', ['only' => ['index']]);
        Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'destroy']]);
        Route::delete('user/{user}/roles/{role}', 'UserRolesController@destroy')->name('user.roles.destroy');
        Route::patch('user/{user}/roles', 'UserRolesController@update')->name('user.roles.update');
        Route::get('/settings/reset', 'SettingsController@reset')->name('settings.reset');
        Route::resource('settings', 'SettingsController', ['only' => ['index', 'store']]);
    });
});
