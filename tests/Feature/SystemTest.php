<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SystemTest extends TestCase
{
    use RefreshDatabase;

    public function testDisplayForm()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testDisplayEmptyReport()
    {
        $response = $this->get('/report');
        $response->assertStatus(200);
    }
}
