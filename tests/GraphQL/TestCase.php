<?php

namespace Tests\GraphQL;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use LazilyRefreshDatabase, MakesGraphQLRequests;
}
