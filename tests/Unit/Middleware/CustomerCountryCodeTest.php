<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\CustomerCountryCode;
use Illuminate\Http\Request;
use Tests\TestCase;

class CustomerCountryCodeTest extends TestCase
{
    private $middleware;

    protected function setUp(): void
    {
        $this->middleware = new CustomerCountryCode();
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
                            'id'       => 1,
                            'country_code' => 'XX'
                        ],
                    ])
                );

        $this->middleware->handle($request, function () { });
        $this->assertEquals(10, $request->attributes->get('datacleansing')[1]['score']);
    }
}
