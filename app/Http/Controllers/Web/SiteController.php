<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

// Midtrans
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

// Helper
use App\Helper\InputValidationHelper;

// Models
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceGallery;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Testimonial;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        // Get all services with their galleries
        $services = Service::with(['service_galleries'])->whereNull('deleted_at')->get();

        // Set thumbnail for each service
        foreach ($services as $service) {
            $thumbnail = $service->service_galleries->firstWhere('is_thumbnail', true);

            if ($thumbnail) {
                $service->thumbnail_url = asset('storage/' . $thumbnail->image_path);
            } else {
                $service->thumbnail_url = asset('img/massage.png'); // path ke gambar default
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

    public function service($id, Request $request)
    {
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

        $testimonials = Testimonial::where('service_id', $service->id)
            ->whereNull('deleted_at')
            ->with(['user'])
            ->get();

        // Calculate average rating
        $averageRating = $testimonials->count() > 0 ? round($testimonials->avg('rating'), 1) : 0;

        // check if user is logged in
        $is_login = false;
        if (Auth::check()) {
            $user = Auth::user();
            $is_login = true;
        }

        $transactions = null;
        if ($is_login) {
            $transactions = Transaction::where('user_id', $user->id)
                ->where('service_id', $service->id)
                ->whereNull('deleted_at')
                ->get();
        }

        $is_consuming = false;
        // Set is_consuming ke true jika ada transaksi dengan status success
        if (!empty($transactions) && $transactions->where('status', 'success')->count() > 0) {
            $is_consuming = true;
        }

        $is_already_testimonial = false;
        // Check if user has already given a testimonial for this service
        if ($is_login) {
            $is_already_testimonial = Testimonial::where('user_id', $user->id)
                ->where('service_id', $service->id)
                ->whereNull('deleted_at')
                ->exists();
        }

        return view("details", compact("service", "services", "testimonials", "averageRating", "is_login", "is_consuming", "is_already_testimonial"));
    }

    public function store_testimonial(Request $request, $id)
    {
        $validation = [
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:1000',
        ];
        $message = [
            'rating.required' => 'Rating harus diisi.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal 1.',
            'rating.max' => 'Rating maksimal 5.',
            'message.required' => 'Pesan harus diisi.',
            'message.string' => 'Pesan harus berupa teks.',
            'message.max' => 'Pesan maksimal 1000 karakter.',
        ];
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB Transaction
        DB::beginTransaction();
        try {
            if (!Auth::check()) {
                return redirect()
                    ->back()
                    ->with('error', 'Anda harus login untuk memberikan testimonial.');
            }

            $user = Auth::user();

            $transaction = Transaction::where('user_id', $user->id)
                ->where('service_id', $id)
                ->whereNull('deleted_at')
                ->first();

            if (!$transaction) {
                return redirect()
                    ->back()
                    ->with('error', 'Anda harus membeli layanan ini sebelum memberikan testimonial.');
            }

            $message = InputValidationHelper::validate_input_text($request->message);
            if (!$message) {
                return redirect()
                    ->back()
                    ->with('error', 'Message tidak valid')
                    ->withInput();
            }

            $data = new Testimonial;
            $data->user_id = $user->id;
            $data->service_id = $id;
            $data->transaction_id = $transaction->id;
            $data->rating = $request->rating;
            $data->message = $message;
            $data->save();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Testimonial berhasil dikirim. Terima kasih atas ulasan Anda!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan. Silahkan coba lagi.');
        }
    }

    public function booking_page(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        $service = Service::where('id', $id)
            ->firstOrFail();

        $service_thumbnail = ServiceGallery::where('service_id', $service->id)
            ->where('is_thumbnail', true)
            ->first();

        if ($service_thumbnail) {
            $service->image = asset('storage/' . $service_thumbnail->image);
        } else {
            $service->image = asset('img/massage.png');
        }

        $products = Product::with(['product_category'])
            ->whereNull('deleted_at')
            ->get();

        $user = Auth::user();

        // create random code for booking with format #PJT + 4 random number and alphabet (uppercase)
        $code = '#PJT' . strtoupper(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 4));

        return view("myBookingDetails", compact("service", "products", "user", "code"));
    }

    public function booking_process(Request $request)
    {
        $validation = [
            "code" => "required|string",
            "user_id" => 'required|exists:users,id',
            "service_id" => "required|exists:services,id",
            "total_price" => "required|integer",
            "transaction_date" => "required|date|after:today",
            "start_time" => 'required|date_format:H:i',
            "end_time" => 'required|date_format:H:i|after:start_time',
            "payment_type" => 'required|in:full_payment,down_payment',
        ];
        $message = [
            'required' => ':attribute tidak boleh kosong',
            'exists' => ':attribute tidak valid',
            'date' => ':attribute harus berupa tanggal',
            'date_format' => ':attribute harus berupa format waktu',
            'integer' => ':attribute harus berupa angka',
            'after' => ':attribute harus lebih besar dari :date',
            'in' => ':attribute tidak valid',
        ];
        $names = [
            'code' => 'Code',
            'user_id' => 'User',
            'service_id' => 'Service',
            'total_price' => 'Total Price',
            'transaction_date' => 'Transaction Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'payment_type' => 'Payment Type',
        ];
        $validator = Validator::make($request->all(), $validation, $message, $names);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB Transaction
        DB::beginTransaction();
        try {

            $transation_date = InputValidationHelper::validate_input_text($request->transaction_date);
            if (!$transation_date) {
                return redirect()
                    ->back()
                    ->with('error', 'Tanggal transaksi tidak valid')
                    ->withInput();
            }

            $start_time = InputValidationHelper::validate_input_text($request->start_time);
            if (!$start_time) {
                return redirect()
                    ->back()
                    ->with('error', 'Waktu mulai tidak valid')
                    ->withInput();
            }

            $end_time = InputValidationHelper::validate_input_text($request->end_time);
            if (!$end_time) {
                return redirect()
                    ->back()
                    ->with('error', 'Waktu selesai tidak valid')
                    ->withInput();
            }

            $payment_type = InputValidationHelper::validate_input_text($request->payment_type);
            if (!$payment_type) {
                return redirect()
                    ->back()
                    ->with('error', 'Jenis pembayaran tidak valid')
                    ->withInput();
            }

            // get total paid from total price * 0.5
            $total_paid = $request->total_price * 0.5;

            // Create new transaction
            $transaction = new Transaction();
            $transaction->code = $request->code;
            $transaction->user_id = $request->user_id;
            $transaction->service_id = $request->service_id;
            $transaction->total_price = $request->total_price;
            $transaction->total_paid = $total_paid;
            $transaction->transaction_date = $transation_date;
            $transaction->start_time = $start_time;
            $transaction->end_time = $end_time;
            $transaction->payment_type = $payment_type;
            // Midtrans
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
            \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
            \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $transaction->total_paid,
                ),
                'customer_details' => array(
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone,
                ),
            );

            $snapToken = Snap::getSnapToken($params);
            $transaction->token = $snapToken;
            $transaction->save();

            // Create new transaction detail
            if ($request->product_id) {
                foreach ($request->product_id as $product_id) {
                    $detail = new DetailTransaction();
                    $detail->transaction_id = $transaction->id;
                    $detail->product_id = $product_id;
                    $detail->quantity = 1;
                    $detail->price = Product::find($product_id)->price;
                    $detail->save();
                }
            }

            DB::commit();

            return redirect()
                ->route('web.payment.process', $transaction->id)
                ->with('success', 'Booking berhasil');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat melakukan booking')
                ->withInput();
        }
    }

    public function payment_process(Transaction $transaction)
    {
        return view('payment', compact('transaction'));
    }

    public function booking_success(Request $request, $id)
    {
        // get transaction where id = $id
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect()
                ->back()
                ->with('error', 'Transaksi tidak ditemukan');
        }

        // if found, get the code
        $code = $transaction->code;

        // update the transaction status to success
        $transaction->status = 'success';
        $transaction->token = null;
        $transaction->save();

        return view("myBookingSuccess", compact("code"));
    }

    public function booking_failed(Request $request)
    {
        return view("myBookingFailed");
    }
}
