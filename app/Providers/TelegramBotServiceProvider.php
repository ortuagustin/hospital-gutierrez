<?php

namespace App\Providers;

use App\Telegram\Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Longman\TelegramBot\Telegram;

class TelegramBotServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::get(\App\Telegram\Client::webhookUrl(), 'App\Http\Controllers\TelegramBotController@index')->middleware('web');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Telegram::class, function ($app) {
            return Client::instance();
        });
    }
}
