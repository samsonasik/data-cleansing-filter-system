<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\CustomerCity;
use Illuminate\Http\Request;
use Tests\TestCase;

class CustomerCityTest extends TestCase
{
    private $middleware;

    protected function setUp(): void
    {
        $this->middleware = new CustomerCity();
    }

    public function testHandleScoreStillEmptySameWithScoreConstant()
    {
        // require set facade for Validator::make testing
        $this->createApplication();

        $request = new Request();
        $request->attributes->set('datacleansing', null);

        $request->attributes
                ->set(
                    'customers',
                    collect([
                        [
                            'id' => 1,
                            'city' => '',
                        ]
                    ])
                );

        $this->middleware->handle($request, function () { });
        $this->assertEquals(10, $request->attributes->get('datacleansing')[1]['score']);
    }
}
