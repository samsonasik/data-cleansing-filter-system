<?php

namespace App\Http\Controllers;

use App\LogDataCleansingFilter;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    private $customers;

    public function __construct()
    {
        $this->customers = [
            [
                'title' => 'Mr.',
                'name'  => 'Abdul Malik Ikhsan',
                'date_of_birth' => '1987-01-23',
                'address' => 'Villa Cilame Indah No D3',
                'city'    => 'Bandung Barat',
                'region'  => 'Jawa Barat',
                'postcode' => '40552',
                'country_code' => 'ID',
                'telephone' => '+62 812-1860-1345',
            ],
            [
                'title' => 'XXX', // not registered in title filter
                'name'  => 'Abdul Malik Ikhsan',
                'date_of_birth' => '1987-01-23',
                'address' => 'Villa Cilame Indah No D3',
                'city'    => 'Bandung Barat',
                'region'  => 'Jawa Barat',
                'postcode' => '40552',
                'country_code' => 'ID',
                'telephone' => '+62 812-1860-1345',
            ],
            [
                'title' => 'XXX', // not registered in title filter
                'name'  => 'Abc...', // multiple consecutive "..."
                'date_of_birth' => '1987-01-24',
                'address' => 'Villa Cilame Indah No D4',
                'city'    => 'Bandung Barat',
                'region'  => 'Jawa Barat',
                'postcode' => '40552',
                'country_code' => 'ID',
                'telephone' => '+62 812-1860-1346',
            ],
            [
                'title' => 'XXX', // not registered in title filter
                'name'  => 'Abc...d', // multiple consecutive "..."
                'date_of_birth' => '2030-01-24', // more than current YEAR
                'address' => 'Villa Cilame Indah No D5',
                'city'    => 'Bandung Barat',
                'region'  => 'Jawa Barat',
                'postcode' => '40552',
                'country_code' => 'ID',
                'telephone' => '+62 812-1860-1346',
            ],
            [
                'title' => 'XXX', // not registered in title filter
                'name'  => 'Abc...de', // multiple consecutive "..."
                'date_of_birth' => '2030-01-24', // more than current YEAR
                'address' => '', // empty
                'city'    => 'Bandung Barat',
                'region'  => 'Jawa Barat',
                'postcode' => '40552',
                'country_code' => 'ID',
                'telephone' => '+62 812-1860-1346',
            ],
            [
                'title' => 'XXX', // not registered in title filter
                'name'  => 'Abc...def', // multiple consecutive "..."
                'date_of_birth' => '2030-01-24', // more than current YEAR
                'address' => '', // empty
                'city'    => '', // empty
                'region'  => 'Jawa Barat',
                'postcode' => '40552',
                'country_code' => 'ID',
                'telephone' => '+62 812-1860-1346',
            ],
            [
                'title' => 'XXX', // not registered in title filter
                'name'  => 'Abc...def', // multiple consecutive "..."
                'date_of_birth' => '2030-01-24', // more than current YEAR
                'address' => '', // empty
                'city'    => '', // empty
                'region'  => '', // empty
                'postcode' => '40552',
                'country_code' => 'ID',
                'telephone' => '+62 812-1860-1346',
            ],
            [
                'title' => 'XXX', // not registered in title filter
                'name'  => 'Abc...def', // multiple consecutive "..."
                'date_of_birth' => '2030-01-24', // more than current YEAR
                'address' => '', // empty
                'city'    => '', // empty
                'region'  => '', // empty
                'postcode' => 'ABCDE', // invalid postcode based on country
                'country_code' => 'ID',
                'telephone' => '+62 812-1860-1346',
            ],
            [
                'title' => 'XXX', // not registered in title filter
                'name'  => 'Abc...defg', // multiple consecutive "..."
                'date_of_birth' => '2030-01-24', // more than current YEAR
                'address' => '', // empty
                'city'    => '', // empty
                'region'  => '', // empty
                'postcode' => 'ABCDE', // invalid postcode based on country
                'country_code' => 'XX', // invalid country code
                'telephone' => '+62 812-1860-1346',
            ],
            [
                'title' => 'XXX', // not registered in title filter
                'name'  => 'Abc...defgh', // multiple consecutive "..."
                'date_of_birth' => '2030-01-24', // more than current YEAR
                'address' => '', // empty
                'city'    => '', // empty
                'region'  => '', // empty
                'postcode' => 'ABCDE', // invalid postcode based on country code
                'country_code' => 'ID',
                'telephone' => '123', // invalid telephone based on country code
            ],
            [
                'title' => 'XXX', // not registered in title filter
                'name'  => 'Abc...defghi', // multiple consecutive "..."
                'date_of_birth' => '2030-01-24', // more than current YEAR
                'address' => '', // empty
                'city'    => '', // empty
                'region'  => '', // empty
                'postcode' => 'ABCDE', // invalid postcode based on country code
                'country_code' => 'XX', // invalid country code
                'telephone' => '123', // invalid telephone based on country code
            ],
        ];
    }

    public function form()
    {
        return view('system.form', [
            'customers' => collect($this->customers)->map(function ($item) {
                return (object) $item;
            }),
        ]);
    }

    public function import()
    {
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
