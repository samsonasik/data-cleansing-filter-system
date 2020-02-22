<?php

namespace App\Http\Middleware;

use Axlon\PostalCodeValidation\Validator as PostalCodeValidator;
use Closure;
use InvalidArgumentException;

class CustomerPostCode
{
    public const SCORE = 10;

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
        $validator     = app(PostalCodeValidator::class);

        foreach ($customers as $customer) {
            try {
                if ($validator->validate($customer->country_code, $customer->postcode)) {
                    continue;
                }

                $datacleansing[$customer->id]['postcode'] = sprintf(
                    'postcode is invalid for country %s',
                    $customer->country_code
                );
                $datacleansing[$customer->id]['score'] = empty($datacleansing[$customer->id]['score'])
                    ? self::SCORE
                    : ($datacleansing[$customer->id]['score'] + self::SCORE);
            } catch (InvalidArgumentException $e) {
                $datacleansing[$customer->id]['postcode'] = sprintf(
                    'postcode is invalid due country %s is not correct',
                    $customer->country_code
                );
                $datacleansing[$customer->id]['score'] = empty($datacleansing[$customer->id]['score'])
                    ? self::SCORE
                    : ($datacleansing[$customer->id]['score'] + self::SCORE);
            }
        }

        $request->attributes->set('datacleansing', $datacleansing);
        return $next($request);
    }
}
