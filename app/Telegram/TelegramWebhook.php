<?php

namespace App\Telegram;

use Illuminate\Support\Facades\Log;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

class TelegramWebhook
{
    /**
     * Delete any assigned webhook
     *
     * @return mixed
     */
    public static function deleteWebhook()
    {
        try {
            return static::telegram()->deleteWebhook();
        } catch (TelegramException $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Set Webhook for bot using the url provided by the TELEGRAM_BOT_HOOK_URL enviroment variable     *
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     */
    public static function setWebhook()
    {
        try {
            return static::telegram()->setWebhook(config('TELEGRAM_BOT_HOOK_URL'));
        } catch (TelegramException $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Returns an instance of the Telegram Client API using the TELEGRAM_BOT_API_KEY and TELEGRAM_BOT_API_KEY enviroment variable credentials
     *
     * @return \Longman\TelegramBot\Telegram
     */
    protected static function telegram()
    {
        return new Telegram(config('TELEGRAM_BOT_API_KEY'), config('TELEGRAM_BOT_API_KEY'));
    }
}
