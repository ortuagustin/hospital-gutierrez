<?php

Route::post("telegram", 'Api\TelegramController@handle')->name('telegram');
Route::get("telegram/setWebhook", 'Api\TelegramController@setWebhook');
Route::get("telegram/removeWebhook", 'Api\TelegramController@removeWebhook');
Route::get('turnos/{fecha}', 'Api\ApointmentsController@index');
Route::post('turnos', 'Api\ApointmentsController@store');
