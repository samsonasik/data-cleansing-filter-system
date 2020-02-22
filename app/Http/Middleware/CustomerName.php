<?php

namespace App\Http\Middleware;

use Closure;
use Naming\Validator\Naming;

class CustomerName
{
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
        $validator     = new Naming();

        foreach ($customers as $customer) {
            if ($validator->isValid($customer->name)) {
                continue;
            }

            $datacleansing[$customer->id]['name'] = current($validator->getMessages());
            $datacleansing[$customer->id]['score'] = empty($datacleansing[$customer->id]['score'])
                ? self::SCORE
                : ($datacleansing[$customer->id]['score'] + self::SCORE);
        }

        $request->attributes->set('datacleansing', $datacleansing);
        return $next($request);

        return $next($request);
    }
}
