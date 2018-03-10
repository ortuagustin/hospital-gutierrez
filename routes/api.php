<?php

Route::get('turnos/{fecha}', 'Api\ApointmentsController@index');
Route::post('turnos', 'Api\ApointmentsController@store');
