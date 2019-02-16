<?php

namespace Tests;
use Redis;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function flushRedis() {
        Redis::flushall();
    }
}
