<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\CustomerTitle;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class CustomerTitleTest extends TestCase
{
    private $middleware;

    protected function setUp(): void
    {
        $this->middleware = new CustomerTitle();
    }

    public function testHandleScoreAlreadyExistIncrementExisting()
    {
        $request = new Request();
        $request->attributes->set('datacleansing', [
            1 => [
                'other_filter' => 'abc',
                'score' => 10,
            ]
        ]);
        $request->attributes->set('customers', [
            (object) [
                'id' => 1,
                'title' => 'XYZ'
            ],
        ]);

        $this->middleware->handle($request, function () { });
        $this->assertEquals($this->middleware::SCORE + 10, $request->attributes->get('datacleansing')[1]['score']);
    }
}
