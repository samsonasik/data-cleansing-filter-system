<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\CustomerName;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class CustomerNameTest extends TestCase
{
    private $middleware;

    protected function setUp(): void
    {
        $this->middleware = new CustomerName();
    }

    public function testHandleScoreStillEmptySameWithScoreConstant()
    {
        $request = new Request();
        $request->attributes->set('datacleansing', null);
        $request->attributes->set('customers', [
            (object) [
                'id' => 1,
                'name' => 'Abc...'
            ],
        ]);

        $this->middleware->handle($request, function () { });
        $this->assertEquals(10, $request->attributes->get('datacleansing')[1]['score']);
    }
}
