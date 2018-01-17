<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;
use Tests\RunsMigrations;

abstract class FeatureTest extends BaseTestCase
{
    use CreatesApplication;
    use RunsMigrations;
    use DatabaseTransactions;
}
