<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

class AppointmentsCommand extends Command
{
    use SendsRequests;

    /**
     * @var string command name
     */
    protected $name = 'turnos';

    /**
     * @var string command description
     */
    protected $description = 'dd-mm-aaaa: Devuelve los turnos disponibles para la fecha indicada';

    protected function getAvailableAppointments($arguments)
    {
        $response = $this->get("/api/turnos/$arguments");

        if ($response->getStatusCode() == 200) {
            $answer = json_decode($response->getBody()->getContents());

            return 'Los turnos disponibles son: ' . implode(" | ", $answer);
        }

        return 'No hay turnos disponibles :(';
    }

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->replyWithMessage(['text' => $this->getAvailableAppointments($arguments)]);
    }
}
