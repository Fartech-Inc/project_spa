<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function index()
    {
        
        $services = [
            'big_title' => 'Facial Treatment',
            'items' => [
                [
                    'image' => 'img/massage.png',
                    'title' => 'Pijat Tradisional',
                    'description' => 'Pijat tradisional untuk relaksasi tubuh.',
                    'price' => 'Rp 150.000',
                ],
                [
                    'image' => 'img/logo.png',
                    'title' => 'Aromatherapy Massage',
                    'description' => 'Pijat dengan minyak aromaterapi.',
                    'price' => 'Rp 200.000',
                ],
                [
                    'image' => 'img/logo.png',
                    'title' => 'Facial Treatment',
                    'description' => 'Perawatan wajah lengkap.',
                    'price' => 'Rp 125.000',
                ],
            ]
        ];
    
        return view('jasa', compact('services'));
    }
}
