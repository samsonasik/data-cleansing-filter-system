<?php

namespace App\Http\Controllers;

use App\LogDataCleansingFilter;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    private $customers;

    public function __construct()
    {
        $this->customers = include storage_path('app/customers.php');
    }

    public function form()
    {
        return view('system.form', [
            'customers' => collect($this->customers)->map(function ($item) {
                return (object) $item;
            }),
        ]);
    }

    public function import(Request $request)
    {
        $request->session()->flash('status', 'Customer data have been succesfully imported!');
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
