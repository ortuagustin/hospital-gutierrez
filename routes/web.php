<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('register', 'Auth\RegisterController@register');

Route::middleware('auth')->group(function () {
    Route::get('patients/search', 'PatientsSearchController@index')->name('patients.search');
    Route::resource('patients', 'PatientsController');
    Route::resource('patients.medical_records', 'MedicalRecordsController', ['except' => ['edit', 'update']]);
    Route::resource('reports', 'DemographicReportsController', ['only' => ['index', 'show']]);
    Route::get('patients/{patient}/reports', 'PatientsReportsController@index')->name('patients.reports');
    Route::get('patients/{patient}/reports/{report}', 'PatientsReportsController@show');

    Route::middleware('can:admin')->group(function () {
        Route::get('roles/reset', 'RolesController@reset')->name('roles.reset');
        Route::resource('roles', 'RolesController');
        Route::resource('permissions', 'PermissionsController', ['only' => ['index']]);
        Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'destroy']]);
        Route::delete('user/{user}/roles/{role}', 'UserRolesController@destroy')->name('user.roles.destroy');
        Route::patch('user/{user}/roles', 'UserRolesController@update')->name('user.roles.update');
        Route::delete('settings/reset', 'SettingsController@reset')->name('settings.reset');
        Route::resource('settings', 'SettingsController', ['only' => ['index', 'store']]);
    });
});
