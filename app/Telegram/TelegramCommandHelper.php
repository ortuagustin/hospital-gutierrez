<?php
use GuzzleHttp\Exception\RequestException;

class BadRequestException extends Exception
{
  public function __construct($json_error_response)
  {
    parent::__construct($json_error_response->{'description'}, $json_error_response->{'error_code'});
  }
}

class TelegramCommandHelper
{
  public static $API_BASE_URI = 'https://grupo1.proyecto2017.linti.unlp.edu.ar/api/';

  public static function getAvailableAppointments($date)
  {
    $answer = [];
    $response = self::sendGet("turnos/$date");
    $answer = \json_decode($response->getBody()->getContents());
    return $answer;
  }

  public static function appoint($date, $time, $dni)
  {
    $args = array('fecha'  => $date, 'hora' => $time, 'dni' => $dni);
    $response = self::sendPost('turnos', $args);
    $appointment = \json_decode($response->getBody()->getContents());
    return $appointment->{'message'};
  }

  private static function executeRequest($method, $endpoint, $args = NULL)
  {
    $client = new \GuzzleHttp\Client(['base_uri' => self::$API_BASE_URI]);

    try
    {
      $response = $client->request($method, $endpoint, ['form_params' => $args]);
      if ($response->getStatusCode() == 400)
        throw new \BadRequestException( \json_decode($response->getBody()->getContents()));

      return $response;
    }
    catch (RequestException $e)
    {
      if ($e->hasResponse())
        return ($e->getResponse());
    }
  }

  private static function sendGet($endpoint)
  {
    return self::executeRequest('GET', $endpoint);
  }

  private static function sendPost($endpoint, $args)
  {
    return self::executeRequest('POST', $endpoint, $args);
  }
}