<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;

/**
 * A Feature test that uses DatabaseTransactions and also runs pending migrations
 */
abstract class FeatureTest extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    /**
     * runs the migrations, if needed, before executing the test suite
     */
    /** @beforeClass */
    public static function runDatabaseMigrations()
    {
        exec('php artisan migrate');
    }
}
