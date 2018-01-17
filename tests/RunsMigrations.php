<?php

namespace Tests;

/**
 * Runs pending Migrations before executing the test suite
 */
trait RunsMigrations
{
    /** @beforeClass */
    public static function runDatabaseMigrations()
    {
        exec('touch database/testing.sqlite');
        exec('php artisan migrate');
    }
}
