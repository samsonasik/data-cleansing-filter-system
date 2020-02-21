<?php

namespace App\Http\Controllers;

use App\Customer;
use App\LogDataCleansingFilter;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    private $customers;

    public function __construct()
    {
        $this->customers = include storage_path('app/customers.php');
    }

    public function form(Request $request)
    {
        $isImported = ! Customer::all()->isEmpty();
        $customers  = $isImported ? [] : $this->customers;

        return view('system.form', [
            'customers' => collect($customers)->map(function ($item) {
                return (object) $item;
            }),
        ]);
    }

    public function import(Request $request)
    {
        $request->session()
                ->flash('status', 'Customer data have been succesfully imported!');

        return redirect('report');
    }

    public function report()
    {
        $log = LogDataCleansingFilter::all();
        $isEmpty = $log->isEmpty();

        return view('system.report', [
            'log' => $log,
            'isEmpty' => $isEmpty,
        ]);
    }
}
