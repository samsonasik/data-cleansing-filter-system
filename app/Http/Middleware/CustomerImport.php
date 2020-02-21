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
            return redirect()->route('report');
        }

        $customers = include storage_path('app/customers.php');
        foreach ($customers as $customer) {
            $model = new Customer();
            $model->title = $customer['title'];
            $model->name = $customer['name'];
            $model->date_of_birth = $customer['date_of_birth'];
            $model->address = $customer['address'];
            $model->city = $customer['city'];
            $model->region = $customer['region'];
            $model->postcode = $customer['postcode'];
            $model->country_code = $customer['country_code'];
            $model->telephone = $customer['telephone'];
            $model->save();
        }

        return $next($request);
    }
}
