<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\CustomerRegion;
use Illuminate\Http\Request;
use Tests\TestCase;

class CustomerRegionTest extends TestCase
{
    private $middleware;

    protected function setUp(): void
    {
        $this->middleware = new CustomerRegion();
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
                            'region' => '',
                        ]
                    ])
                );

        $this->middleware->handle($request, function () { });
        $this->assertEquals($this->middleware::SCORE, $request->attributes->get('datacleansing')[1]['score']);
    }
}
