<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCaseFeature extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Disable all middleware (CSRF, auth, etc.)
        $this->withoutMiddleware();
    }
}
