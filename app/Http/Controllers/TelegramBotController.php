<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Longman\TelegramBot\Telegram;

class TelegramBotController extends Controller
{
    public function index(Telegram $telegram)
    {
        try {
            $telegram->addCommandsPath('/app/Telegram/Commands');
            $telegram->enableLimiter();

            return response()->json([
                'isOk' => $telegram->handle(),
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response($e->getMessage(), 400);
        }
    }
}
