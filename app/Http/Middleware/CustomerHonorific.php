<?php

namespace App\Http\Middleware;

use Closure;

class CustomerHonorific
{
    private const ALLOWED_HONORIFIC = [
        null,
        'Mr.',
        'Mrs',
    ];

    private const SCORE = 10;

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
            if ($customer->title === null) {
                continue;
            }

            if (in_array($customer->title, self::ALLOWED_HONORIFIC)) {
                continue;
            }

            $datacleansing[$customer->id]['title'] = sprintf('title  must be empty, or %s, or %s',
                self::ALLOWED_HONORIFIC[1],
                self::ALLOWED_HONORIFIC[2]
            );
            $datacleansing[$customer->id]['score'] = empty($datacleansing[$customer->id]['score'])
                ? self::SCORE
                : ($datacleansing[$customer->id]['score'] + self::SCORE);
        }

        $request->attributes->set('datacleansing', $datacleansing);
        return $next($request);
    }
}
