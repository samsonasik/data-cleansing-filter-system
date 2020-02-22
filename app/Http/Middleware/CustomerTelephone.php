<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use Closure;

class CustomerTelephone
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
                'telephone' => 'phone:' . $customer['country_code'],
            ]);

            if (! $validator->fails()) {
                continue;
            }

            $datacleansing[$customer['id']]['telephone'] = sprintf('invalid phone number for country %s', $customer['country_code']);
            $datacleansing[$customer['id']]['score'] = empty($datacleansing[$customer['id']]['score'])
                ? self::SCORE
                : ($datacleansing[$customer['id']]['score'] + self::SCORE);
        }

        $request->attributes->set('datacleansing', $datacleansing);
        return $next($request);
    }
}
