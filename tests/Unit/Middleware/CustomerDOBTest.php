<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\CustomerDOB;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class CustomerDOBTest extends TestCase
{
    private $middleware;

    protected function setUp(): void
    {
        $this->middleware = new CustomerDOB();
    }

    public function testHandleScoreStillEmptySameWithScoreConstant()
    {
        $request = new Request();
        $request->attributes->set('datacleansing', null);

        $date = date_create(date('Y-m-d'));
        date_add($date,date_interval_create_from_date_string("40 days"));

        $request->attributes->set('customers', [
            (object) [
                'id' => 1,
                'date_of_birth' => date_format($date,"Y-m-d")
            ],
        ]);

        $this->middleware->handle($request, function () { });
        $this->assertEquals(10, $request->attributes->get('datacleansing')[1]['score']);
    }
}
