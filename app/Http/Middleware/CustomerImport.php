<?php

namespace App\Http\Middleware;

use App\Customer;
use Closure;

class CustomerImport
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
        $isImported = ! Customer::all()->isEmpty();
        if ($isImported) {
            return redirect('report');
        }

        $customers = include storage_path('app/customers.php');
        foreach ($customers as $customer) {
            $c = new Customer();
            $c->title = $customer['title'];
            $c->name = $customer['name'];
            $c->date_of_birth = $customer['date_of_birth'];
            $c->address = $customer['address'];
            $c->city = $customer['city'];
            $c->region = $customer['region'];
            $c->postcode = $customer['postcode'];
            $c->country_code = $customer['country_code'];
            $c->telephone = $customer['telephone'];
            $c->save();
        }

        return $next($request);
    }
}
