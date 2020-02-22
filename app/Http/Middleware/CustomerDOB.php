<?php

namespace App\Http\Middleware;

use Closure;

class CustomerDOB
{
    private const FORMAT = 'Y-m-d';
    private const SCORE  = 10;

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

        foreach ($customers as $customer) {
            if ($customer->date_of_birth < date('Y-m-d')) {
                continue;
            }

            $datacleansing[$customer->id]['date_of_birth'] = 'date of birth must be lower than current date';
            $datacleansing[$customer->id]['score'] = empty($datacleansing[$customer->id]['score'])
                ? self::SCORE
                : ($datacleansing[$customer->id]['score'] + self::SCORE);
        }

        $request->attributes->set('datacleansing', $datacleansing);
        return $next($request);
    }
}
