<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function handle()
    {
        try {
            Telegram::commandsHandler(true);
        } catch (\Exception $e) {
            return response($e->getMessage(), 200);
        }

        return response('ok', 200);
    }

    public function setWebhook()
    {
        return Telegram::setWebhook([
                'url'   => config('app.url') . '/api/telegram',
            ]);
    }

    public function removeWebhook()
    {
        Telegram::removeWebhook();

        return response('webhook removed!', 200);
    }
}
