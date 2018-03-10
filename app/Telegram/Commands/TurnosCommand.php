<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Illuminate\Support\Facades\Log;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class TurnosCommand extends UserCommand
{
    use SendsRequests;

    protected $name = 'turnos';
    protected $description = '/turnos dd-mm-aaaa: Devuelve  los turnos disponibles para la fecha indicada';
    protected $usage = '/turnos';
    protected $version = '1.0.0';

    protected function availableAppointments($date)
    {
        $answer = [];
        $response = $this->get("turnos/$date");
        $answer = \json_decode($response->getBody()->getContents());

        return 'Los turnos disponibles son: ' . implode(" | ", $answer);
    }

    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $date = $message->getText(true);

        try {
            $data = [
                'chat_id' => $chat_id,
                'text'    => $this->availableAppointments($date),
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            $data = [
                'chat_id' => $chat_id,
                'text'    => $e->getMessage(),
            ];
        }

        return Request::sendMessage($data);
    }
}
