<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceGallery;

class SiteController extends Controller
{
    public function index(Request $request){

        // get all service with service galleries where is_thumbnail = true as service image
        $services = Service::whereNull('deleted_at')
            ->get();

        $service_galleries = ServiceGallery::whereNull('deleted_at')
            ->where('is_thumbnail', true)
            ->get();

        // get service gallery image where is_thumbnail = true and service_id = service_id
        foreach ($services as $service){
            foreach ($service_galleries as $service_gallery){
                if($service->id == $service_gallery->service_id){
                    $service->image = asset('storage/' . $service_gallery->image);
                }
            }
        }

        return view("landingPage", compact("services"));
    }

    public function services(Request $request)
    {
        // Get all service categories with their respective services
        $service_categories = ServiceCategory::with(['services' => function ($query) {
            $query->whereNull('deleted_at');
        }])
            ->whereNull('deleted_at')
            ->get();

        // Attach images to each service
        foreach ($service_categories as $category) {
            foreach ($category->services as $service) {
                $thumbnail = ServiceGallery::where('service_id', $service->id)
                    ->where('is_thumbnail', true)
                    ->whereNull('deleted_at')
                    ->first();

                $service->image = $thumbnail ? asset('storage/' . $thumbnail->image) : asset('img/massage.png');
            }
        }

        return view("jasa", compact("service_categories"));
    }

    public function service($id, Request $request){
        $service = Service::with(['service_galleries'])
            ->where('id', $id)
            ->firstOrFail();

        // get all service with service galleries where is_thumbnail = true as service image where service_id not equal to $id
        $services = Service::whereNull('deleted_at')
            ->where('id', '!=', $id)
            ->get();

        $service_galleries = ServiceGallery::whereNull('deleted_at')
            ->where('is_thumbnail', true)
            ->get();

        // get service gallery image where is_thumbnail = true and service_id = service_id
        foreach ($services as $other_service) {
            foreach ($service_galleries as $service_gallery) {
                if ($other_service->id == $service_gallery->service_id) {
                    $other_service->image = asset('storage/' . $service_gallery->image);
                }
            }
        }

        return view("details", compact("service", "services"));
    }

    public function booking_page(Request $request, $id){
        $service = Service::with(['service_galleries'])
            ->where('id', $id)
            ->firstOrFail();

        return view("mybooking", compact("service"));
    }
}
