<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MybookingController extends Controller
{
    public function index()
    {
        $services = [
            [
                'name' => 'Pijat Traditional',
                'kode-book' => '#PJT193E4',
                'schedule' => "Monday 8:00-9:00am July 31,2023"
            ],
            [
                'name' => 'Pijat Traditional',
                'kode-book' => '#PJT193E4',
                'schedule' => "Monday 8:00-9:00am July 31,2023"
            ],
            [
                'name' => 'Pijat Traditional',
                'kode-book' => '#PJT193E4',
                'schedule' => "Monday 8:00-9:00am July 31,2023"
            ],
            [
                'name' => 'Pijat Traditional',
                'kode-book' => '#PJT193E4',
                'schedule' => "Monday 8:00-9:00am July 31,2023"
            ],
            
        ];

        return view('mybooking', compact('services'));
    }

    public function myBookingDetails()
    {
        return view("myBookingDetails");
    }

    public function myBookingSuccess()
    {
        return view("myBookingSuccess");
    }

    public function myBookingFailed()
    {
        return view("myBookingFailed");
    }
}