<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceGallery;
use App\Models\Product;

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
        // Ambil semua kategori layanan dengan layanan yang tidak dihapus
        $service_categories = ServiceCategory::with(['services' => function ($query) {
            $query->whereNull('deleted_at');
        }])
        ->whereNull('deleted_at');

        // Jika ada pencarian, filter layanan berdasarkan nama
        if ($request->has('search')) {
            $search = $request->input('search');

            // Filter hanya kategori yang memiliki layanan sesuai pencarian
            $service_categories = $service_categories->whereHas('services', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->with(['services' => function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }]);
        }

        $service_categories = $service_categories->get();

        // Tambahkan gambar untuk setiap layanan
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
        $service = Service::where('id', $id)
            ->firstOrFail();

        $service->image = ServiceGallery::where('service_id', $service->id)
            ->where('is_thumbnail', true)
            ->firstOrFail();

        $products = Product::with(['product_categories'])
            ->whereNull('deleted_at')
            ->get();

        $user = Auth::user();

        return view("myBookingDetails", compact("service", "products", "user"));
    }
}
