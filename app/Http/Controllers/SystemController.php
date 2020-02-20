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
                'title' => 'Mr.',
                'name'  => 'Abdul Malik Ikhsan',
                'email' => 'samsonasik@gmail.com',
                'date_of_birth' => '1987-01-23',
                'address' => 'Villa Cilame Indah No D3',
                'city'    => 'Bandung Barat',
                'region'  => 'Jawa Barat',
                'postcode' => '40552',
                'country_code' => 'ID',
                'telephone' => '+6281218601345',
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
}
