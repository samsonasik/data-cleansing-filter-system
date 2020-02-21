<?php

namespace App\Http\Middleware;

use App\Customer;
use Closure;

class SetCustomersAttribute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->attributes->set('customers', Customer::all());
        return $next($request);
    }
}
