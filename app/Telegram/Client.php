<?php

namespace App\Telegram;

use Illuminate\Support\Facades\Log;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

class Client
{
    public static function webhookUrl()
    {
        return config('telegram.bot_hook_url');
    }

    /**
     * Delete any assigned webhook
     *
     * @return mixed
     */
    public static function deleteWebhook()
    {
        try {
            return static::instance()->deleteWebhook();
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
            return static::instance()->setWebhook(url(static::webhookUrl()));
        } catch (TelegramException $e) {
            Log::error($e->getMessage());

            return $e;
        }
    }

    /**
     * Returns an instance of the Telegram Client API using the TELEGRAM_BOT_API_KEY and TELEGRAM_BOT_API_KEY enviroment variable credentials
     *
     * @return \Longman\TelegramBot\Telegram
     */
    public static function instance()
    {
        return new Telegram(config('telegram.key'), config('telegram.bot_username'));
    }
}
