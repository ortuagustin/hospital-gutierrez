<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;
use Tests\RunsMigrations;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RunsMigrations;
    use DatabaseTransactions;
}
