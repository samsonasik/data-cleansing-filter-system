<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    private $customers;

    public function __construct()
    {
        $this->customers = [
            [
                'title' => null,
                'name'  => 'Abdul Malik Ikhsan',
                'email' => 'samsonasik@gmail.com',
                'date_of_birth' => '1987-01-23',
                'address' => 'Villa Cilame Indah No D3',
                'city'    => 'Bandung Barat',
                'region'  => 'Jawa Barat',
                'postcode' => '40552',
                'country_code' => 'ID',
                'telephone' => '+6281218601345',
            ],
            [
                'title' => 'Mr.',
                'name'  => '<script>Abdul',
                'email' => 'samsonasik@hotmail.com',
                'date_of_birth' => '1987-01-20',
                'address' => 'Villa Cilame Indah No D4',
                'city'    => 'Bandung Barat',
                'region'  => 'Jawa Barat',
                'postcode' => '40552',
                'country_code' => 'ID',
                'telephone' => '+6281218601346',
            ]
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

    public function report()
    {
        return view('system.report', []);
    }
}
