<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

class AppointmentsCommand extends Command
{
    /**
     * @var AppointmentsApiInterface
     */
    private $api;

    public function __construct(AppointmentsApiInterface $api)
    {
        $this->api = $api;
    }

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
        $response = $this->api->available_at($date);

        $answer = json_decode($response);

        return empty($answer) ? 'Los turnos disponibles son: ' . implode(" | ", $answer) : 'No hay turnos disponibles :(';
    }

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->replyWithMessage(['text' => $this->getAvailableAppointments($arguments)]);
    }
}
