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

    public function testImportCustomersFillCustomersDataAndRedirectToReport()
    {
        $this->assertCount(0, Customer::all());
        $response = $this->post('/import');
        $this->assertCount(12, Customer::all());
        $response->assertStatus(302);
        $response->assertRedirect(route('report'));

        // consecutive call to hit customer is imported
        // no session flash as already imported
        $this->assertCount(12, Customer::all());
        $response = $this->post('/import');
        $this->assertCount(12, Customer::all());
    }

    public function testDeleteDataMakeEmptyRecords()
    {
        // fill first
        $this->post('/import');
        $this->assertCount(12, Customer::all());

        $this->get('/delete');
        $this->assertCount(0, Customer::all());
        $this->assertCount(0, LogDataCleansingFilter::all());
    }
}
