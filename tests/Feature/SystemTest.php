<?php

namespace Tests\Feature;

use App\Customer;
use App\LogDataCleansingFilter;
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

    public function testImportCustomersRedirectToReport()
    {
        $response = $this->post('/import');
        $response->assertStatus(302);
        $response->assertRedirect(route('report'));
    }

    public function testDeleteDataMakeEmptyRecords()
    {
        $this->get('/delete');
        $this->assertCount(0, Customer::all());
        $this->assertCount(0, LogDataCleansingFilter::all());
    }
}
