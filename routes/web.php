<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::resource('patients', 'PatientsController');
    Route::resource('patients.medical_records', 'MedicalRecordsController', ['except' => ['edit', 'update']]);

    Route::middleware('can:admin')->group(function () {
        Route::get('/roles/reset', 'RolesController@reset')->name('roles.reset');
        Route::resource('roles', 'RolesController');
        Route::resource('permissions', 'PermissionsController', ['except' => ['show']]);
        Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'destroy']]);
    });
});
