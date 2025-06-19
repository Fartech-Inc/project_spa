<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Model
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;

// Helper
use App\Helper\InputValidationHelper;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        // get user data from session, check if user is login, if not redirect to login page
        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('auth.login')
                ->with('error', 'Silahkan login terlebih dahulu');
        }

        // if user found, change bod format to dd-mm-yyyy
        $user->bod = date('d-m-Y', strtotime($user->bod));

        return view("profile", compact("user"));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi jika key adalah "image"
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            try {
                // Hapus gambar lama jika ada
                if ($user->image && Storage::disk('public')->exists($user->image)) {
                    Storage::disk('public')->delete($user->image);
                }

                // Simpan gambar baru ke storage/app/public/users
                $filename = $user->name . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $path = $request->file('image')->storeAs('users', $filename, 'public'); // simpan ke disk 'public'

                $user->image = $path; // Simpan path relatif, misalnya "users/namafile.jpg"
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Foto profil berhasil diperbarui.',
                    'image_url' => asset('storage/' . $path), // URL akses gambar
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Terjadi kesalahan saat mengunggah gambar.',
                    'message' => $e->getMessage(), // Tambahkan ini
                ], 500);
            }
        }

        $validatedData = $request->validate([
            'key' => 'required|string|in:name,bod,email,phone',
            'value' => 'required|string',
        ]);

        $key = $validatedData['key'];
        $value = $validatedData['value'];

        try {
            // Validasi berdasarkan key
            switch ($key) {
                case 'name':
                    $keyLabel = 'Nama';
                    if ($user->name === $value) return response()->noContent(); // Jika tidak berubah, tidak ada aksi
                    $name = InputValidationHelper::validate_input_text($value);
                    if (!$name) {
                        return response()->json(['error' => 'Nama tidak valid.'], 422);
                    }
                    $user->name = $name;
                    break;

                case 'bod':
                    $keyLabel = 'Tanggal lahir';
                    if ($user->bod === $value) return response()->noContent(); // Jika tidak berubah, tidak ada aksi
                    $bod = InputValidationHelper::validate_input_date($value);
                    if (!$bod || strtotime($bod) > strtotime(date('Y-m-d'))) {
                        return response()->json(['error' => 'Tanggal lahir tidak valid atau melebihi hari ini.'], 422);
                    }
                    $user->bod = $bod;
                    break;

                case 'email':
                    $keyLabel = 'Email';
                    if ($user->email === $value) return response()->noContent(); // Jika tidak berubah, tidak ada aksi
                    $email = InputValidationHelper::validate_input_email($value);
                    if (!$email) {
                        return response()->json(['error' => 'Email tidak valid.'], 422);
                    }
                    // Pastikan email unik kecuali jika email adalah miliknya sendiri
                    if ($email !== $user->email && User::where('email', $email)->exists()) {
                        return response()->json(['error' => 'Email sudah digunakan oleh pengguna lain.'], 422);
                    }
                    $user->email = $email;
                    break;

                case 'phone':
                    $keyLabel = 'Nomor telepon';
                    if ($user->phone === $value) return response()->noContent(); // Jika tidak berubah, tidak ada aksi
                    $phone = InputValidationHelper::validate_input_text($value);
                    if (!$phone) {
                        return response()->json(['error' => 'Nomor telepon tidak valid.'], 422);
                    }
                    $user->phone = $phone;
                    break;

                default:
                    return response()->json(['error' => 'Key tidak valid.'], 400);
            }

            // Simpan perubahan jika valid
            $user->save();

            return response()->json([
                'success' => true,
                'message' => $keyLabel . ' berhasil diperbarui.',
                'value' => $value,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat memperbarui data.'], 500);
        }
    }

    public function my_transations(Request $request)
    {
        $user = Auth::user();

        // get all transaction where user_id = $user->id
        $transactions = Transaction::where('user_id', $user->id)
            ->with('service')
            ->get();

        foreach ($transactions as $transaction) {
            // change transaction_date format to M d, Y
            $transaction->transaction_date = date('M d, Y', strtotime($transaction->transaction_date));

            // get day name from transaction_date
            $transaction->day = date('l', strtotime($transaction->transaction_date));

            // change format start end time to H:i
            $transaction->start_time = date('H:i', strtotime($transaction->start_time));
            $transaction->end_time = date('H:i', strtotime($transaction->end_time));

            // get AM or PM from end time
            $transaction->end_time_am_pm = date('A', strtotime($transaction->end_time));
        }

        return view("mybooking", compact("transactions"));
    }

    public function cancel_transaction(Request $request, $id)
    {
        try {
            $user = Auth::user();

            // Cari transaksi berdasarkan ID dan User ID
            $transaction = Transaction::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (!$transaction) {
                return redirect()
                    ->back()
                    ->with('error', 'Transaksi tidak ditemukan.');
            }

            // Cek apakah transaksi sudah dibatalkan sebelumnya
            if ($transaction->status == 'cancel') {
                return redirect()
                    ->back()
                    ->with('error', 'Transaksi ini sudah dibatalkan sebelumnya.');
            }

            // Ubah status menjadi cancel
            $transaction->status = 'cancel';
            $transaction->save();

            return redirect()
                ->back()
                ->with('success', 'Transaksi berhasil dibatalkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat membatalkan transaksi. Silakan coba lagi.');
        }
    }
}
