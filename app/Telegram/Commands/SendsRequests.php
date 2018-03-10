<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait SendsRequests
{
    protected function base_uri()
    {
        return config('telegram.api_base_url');
    }

    private function sendRequest($method, $endpoint, $args = null)
    {
        $client = new Client([
            'base_uri' => $this->base_uri(),
        ]);

        try {
            $response = $client->request($method, $endpoint, ['form_params' => $args]);

            return $response;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return ($e->getResponse());
            }
        }
    }

    public function get($endpoint)
    {
        return $this->sendRequest('GET', $endpoint);
    }

    public function post($endpoint, $args)
    {
        return $this->sendRequest('POST', $endpoint, $args);
    }
}
