<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// Model
use App\Models\User;

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
                if ($user->image && file_exists(public_path($user->image))) {
                    unlink(public_path($user->image));
                }

                // Simpan gambar baru ke folder public/uploads/user_images/
                $filename = $user->name . '_' . $request->file('image')->getClientOriginalName() . time();
                $path = 'uploads/user_images/' . $filename;
                $request->file('image')->move(public_path('uploads/user_images'), $filename);

                $user->image = $path;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Foto profil berhasil diperbarui.',
                    'image_url' => asset($path),
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Terjadi kesalahan saat mengunggah gambar.'], 500);
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
}
