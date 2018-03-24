<?php

namespace App\Telegram\Commands;

use App\AppointmentsApi;
use App\Contracts\AppointmentsApiInterface;
use Telegram\Bot\Commands\Command;

class ScheduleCommand extends Command
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
    protected $name = 'reservar';

    /**
     * @var string command description
     */
    protected $description = 'dni dd-mm-aaaa hh-mm: Permite reservar un turno para un paciente indicando su dni, la fecha y la hora. Retorna un identificador único de turno.';

    public function scheduleAppointment($arguments)
    {
        $strs = explode(' ', $arguments);

        try {
            $response = $this->api->schedule($strs[0], "$strs[1] $strs[2]");
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $answer = json_decode($response->getContent());

        return $answer->message;
    }

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->replyWithMessage(['text' => $this->scheduleAppointment($arguments)]);
    }
}
