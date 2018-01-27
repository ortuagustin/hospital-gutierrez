<?php

namespace App\Auth;

use Illuminate\Auth\Passwords\PasswordBroker as IlluminatePasswordBroker;

class PasswordBroker extends IlluminatePasswordBroker
{
    protected function validatePasswordWithDefaults(array $credentials)
    {
        list($password, $confirm) = [
            $credentials['password'],
            $credentials['password_confirmation'],
        ];

        return $password === $confirm && mb_strlen($password) >= 4;
    }
}
