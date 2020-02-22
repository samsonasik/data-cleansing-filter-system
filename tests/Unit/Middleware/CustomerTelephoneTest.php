<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\CustomerTelephone;
use Illuminate\Http\Request;
use Tests\TestCase;

class CustomerTelephoneCodeTest extends TestCase
{
    private $middleware;

    protected function setUp(): void
    {
        $this->middleware = new CustomerTelephone();
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
                            'telephone' => 123,
                            'country_code' => 'XX'
                        ],
                    ])
                );

        $this->middleware->handle($request, function () { });
        $this->assertEquals($this->middleware::SCORE, $request->attributes->get('datacleansing')[1]['score']);
    }
}
