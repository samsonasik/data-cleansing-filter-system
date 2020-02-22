<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use Closure;

class CustomerRegion
{
    public const SCORE  = 10;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $datacleansing = $request->attributes->get('datacleansing');
        $customers     = $request->attributes->get('customers');

        foreach ($customers->toArray() as $customer) {
            $validator = Validator::make($customer, [
                'region' => 'required|min:1',
            ]);

            if (! $validator->fails()) {
                continue;
            }

            $datacleansing[$customer['id']]['region'] = $validator->messages()->first();
            $datacleansing[$customer['id']]['score'] = empty($datacleansing[$customer['id']]['score'])
                ? self::SCORE
                : ($datacleansing[$customer['id']]['score'] + self::SCORE);
        }

        $request->attributes->set('datacleansing', $datacleansing);
        return $next($request);
    }
}
