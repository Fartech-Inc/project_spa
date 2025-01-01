<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function index()
    {
        $services = [
            [
                'name' => 'Pijat Traditional',
                'image' => 'img/massage.png'
            ],
            [
                'name' => 'Aromatherapy Massage',
                'image' => 'img/massage.png'
            ],
            [
                'name' => 'Facial Treatment',
                'image' => 'img/massage.png'
            ],
            [
                'name' => 'Acne Treatment',
                'image' => 'img/massage.png'
            ],
            [
                'name' => 'Spa Kuku',
                'image' => 'img/massage.png'
            ]
        ];

        return view('details', compact('services'));
    }
}
