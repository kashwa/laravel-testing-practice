<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class DatabaseConnectionTest extends TestCase
{
    public function test_database_connection_works()
    {
        $this->assertTrue(DB::connection()->getDatabaseName() !== null);
    }
}
