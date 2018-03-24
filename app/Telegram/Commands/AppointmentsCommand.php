<?php

namespace App\Telegram\Commands;

use App\AppointmentsApi;
use App\Contracts\AppointmentsApiInterface;
use Telegram\Bot\Commands\Command;

class AppointmentsCommand extends Command
{
    /**
     * @var AppointmentsApiInterface
     */
    private $api;

    public function __construct()
    {
        $this->api = new AppointmentsApi();
    }

    /**
     * @var string command name
     */
    protected $name = 'turnos';

    /**
     * @var string command description
     */
    protected $description = 'dd-mm-aaaa: Devuelve los turnos disponibles para la fecha indicada';

    public function getAvailableAppointments($date)
    {
        try {
            $response = $this->api->available_at($date);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $answer = json_decode($response->getContent());

        return empty($answer) ? 'No hay turnos disponibles :(' : 'Los turnos disponibles son: ' . implode(" | ", $answer);
    }

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->replyWithMessage(['text' => $this->getAvailableAppointments($arguments)]);
    }
}
