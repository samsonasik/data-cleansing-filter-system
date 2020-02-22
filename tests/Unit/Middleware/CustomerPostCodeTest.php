<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\CustomerPostCode;
use Illuminate\Http\Request;
use Tests\TestCase;

class CustomerPostCodeTest extends TestCase
{
    private $middleware;

    protected function setUp(): void
    {
        $this->middleware = new CustomerPostCode();
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
                        (object) [
                            'id'       => 1,
                            'postcode' => 'ABCDE',
                            'country_code' => 'XX'
                        ],
                        (object) [
                            'id'       => 2,
                            'postcode' => 'ABCDE',
                            'country_code' => 'ID'
                        ]
                    ])
                );

        $this->middleware->handle($request, function () { });
        $this->assertEquals(10, $request->attributes->get('datacleansing')[1]['score']);
        $this->assertEquals(10, $request->attributes->get('datacleansing')[2]['score']);
    }
}
