<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Profile</title>
    <style>
        .profile {
            display: flex;
            flex-direction: row;
            justify-content: start;
            align-items: center;
            gap: 20px;
        }

        @media screen and (max-width: 768px) {
            .profile {
                flex-direction: column;
                align-items: start;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <x-navbar></x-navbar>
    
    <div class="profile gap-5 min-h-screen container mx-auto">
        <div class="bg-white rounded-lg border p-5">
            <img id="profile-image" src="{{ $user->image ? $user->image : 'img/massage.png' }}" alt="Profile Image">
            <form id="upload-image-form" enctype="multipart/form-data" class="mt-5">
                <input type="file" id="image-input" name="image" accept="image/png, image/jpeg" class="mb-3 hidden" onchange="uploadImage()">
                <label for="image-input" class="cursor-pointer bg-[#D70DBFCC] text-white px-10 py-3 rounded">Pilih Foto</label>
            </form>
        </div>
        <div class="font-semibold">
            <p>Biodata Diri</p>
            <p>
                Nama :
                <span id="name-span">{{ $user->name }}</span>
                <input
                    type="text"
                    id="name-input"
                    class="hidden border rounded p-1"
                    value="{{ $user->name }}"
                    onblur="saveEdit('name')"
                />
                <span id="name-edit" class="editable-button text-[#D70DBFCC] cursor-pointer" onclick="toggleEdit('name')">Ubah</span>
            </p>
            <p>
                Tanggal Lahir :
                <span id="bod-span">{{ date('d-m-Y', strtotime($user->bod)) }}</span>
                <input
                    type="date"
                    id="bod-input"
                    class="hidden border rounded p-1"
                    value="{{ date('Y-m-d', strtotime($user->bod)) }}"
                    onfocus="setDatePickerDefaultValue('bod')"
                    onblur="saveEdit('bod')"
                />
                <span id="bod-edit" class="editable-button text-[#D70DBFCC] cursor-pointer" onclick="toggleEdit('bod')">Ubah</span>
            </p>
            <p class="mt-10">
                Email :
                <span id="email-span">{{ $user->email }}</span>
                <input
                    type="email"
                    id="email-input"
                    class="hidden border rounded p-1"
                    value="{{ $user->email }}"
                    onblur="saveEdit('email')"
                />
                <span id="email-edit" class="editable-button text-[#D70DBFCC] cursor-pointer" onclick="toggleEdit('email')">Ubah</span>
            </p>
            <p>
                Nomor Handphone :
                <span id="phone-span">{{ $user->phone }}</span>
                <input
                    type="tel"
                    id="phone-input"
                    class="hidden border rounded p-1"
                    value="{{ $user->phone }}"
                    onblur="saveEdit('phone')"
                />
                <span id="phone-edit" class="editable-button text-[#D70DBFCC] cursor-pointer" onclick="toggleEdit('phone')">Ubah</span>
            </p>
        </div>
    </div>

    <script>
        // Fungsi untuk mengedit
        function toggleEdit(key) {
            const spanElement = document.getElementById(`${key}-span`);
            const inputElement = document.getElementById(`${key}-input`);
            const editButton = document.getElementById(`${key}-edit`);

            if (spanElement && inputElement && editButton) {
                spanElement.classList.add('hidden');
                inputElement.classList.remove('hidden');
                editButton.classList.add('hidden');
            }
        }

        // Fungsi untuk handle upload image dan menampilkan preview
        async function uploadImage() {
            const form = document.getElementById('upload-image-form');
            const formData = new FormData(form);
            const imageInput = document.getElementById('image-input');

            if (imageInput.files.length === 0) {
                alert('Pilih gambar terlebih dahulu.');
                return;
            }

            // Preview gambar sebelum diunggah
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Tampilkan gambar ke elemen img
                    document.getElementById('profile-image').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }

            try {
                const response = await fetch("{{ route('user.profile.update') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: formData,
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    document.getElementById('profile-image').src = result.image_url;
                    alert(result.message);
                } else {
                    alert(result.error || "Gagal mengunggah gambar.");
                }
            } catch (error) {
                console.error("Error uploading image:", error);
                alert("Terjadi kesalahan saat mengunggah gambar.");
            }
        }

        // Fungsi untuk menyimpan perubahan
        async function saveEdit(key) {
            const inputElement = document.getElementById(`${key}-input`);
            const spanElement = document.getElementById(`${key}-span`);
            const editButton = document.getElementById(`${key}-edit`);

            if (!inputElement || !spanElement || !editButton) return;

            const originalValue = spanElement.textContent.trim();
            let value = inputElement.value;

            // Jika key adalah bod, ubah format dari yyyy-MM-dd ke dd-mm-yyyy untuk perbandingan
            if (key === "bod") {
                const formattedOriginalValue = formatDateToServer(originalValue);
                if (value === formattedOriginalValue) {
                    inputElement.value = formattedOriginalValue;
                    inputElement.classList.add('hidden');
                    spanElement.classList.remove('hidden');
                    editButton.classList.remove('hidden');
                    return;
                }
            } else if (value === originalValue) {
                // Untuk key selain bod, jika tidak ada perubahan
                inputElement.value = originalValue;
                inputElement.classList.add('hidden');
                spanElement.classList.remove('hidden');
                editButton.classList.remove('hidden');
                return;
            }

            // Kirim perubahan ke server
            try {
                const response = await fetch("{{ route('user.profile.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({ key, value }),
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    spanElement.textContent = key === "bod" ? formatDateToDisplay(value) : value;
                    alert(result.message);
                } else {
                    alert(result.error || "Gagal memperbarui data.");
                    inputElement.value = originalValue;
                }
            } catch (error) {
                console.error("Error updating profile:", error);
                alert("Terjadi kesalahan saat memperbarui data.");
                inputElement.value = originalValue; 
            }

            inputElement.classList.add('hidden');
            spanElement.classList.remove('hidden');
            editButton.classList.remove('hidden');
        }


        // Fungsi untuk memastikan default value datepicker diatur saat fokus
        function setDatePickerDefaultValue(key) {
            const inputElement = document.getElementById(`${key}-input`);
            const spanElement = document.getElementById(`${key}-span`);

            if (!inputElement || !spanElement) return;

            const originalDate = spanElement.textContent.trim();
            const [day, month, year] = originalDate.split("-");

            const formattedDate = `${year}-${month}-${day}`;
            inputElement.value = formattedDate;
        }

        // Format tanggal dari yyyy-mm-dd ke dd-mm-yyyy untuk ditampilkan
        function formatDateToDisplay(date) {
            const [year, month, day] = date.split("-");
            return `${day}-${month}-${year}`;
        }

        // Format tanggal dari dd-mm-yyyy ke yyyy-MM-dd untuk server
        function formatDateToServer(date) {
            const [day, month, year] = date.split("-");
            return `${year}-${month}-${day}`;
        }

        // Tutup input field jika klik di luar input
        document.addEventListener("click", function (event) {
            const inputs = document.querySelectorAll("input, select");
            const editButtons = document.querySelectorAll(".editable-button");

            let clickedInside = false;

            inputs.forEach((input) => {
                if (input && input.contains(event.target)) {
                    clickedInside = true;
                }
            });

            editButtons.forEach((button) => {
                if (button && button.contains(event.target)) {
                    clickedInside = true;
                }
            });

            if (!clickedInside) {
                inputs.forEach((input) => {
                    if (input) {
                        const key = input.id.split("-")[0];
                        const spanElement = document.getElementById(`${key}-span`);
                        const editButton = document.getElementById(`${key}-edit`);

                        if (spanElement && editButton) {
                            input.value = spanElement.textContent.trim(); 
                            input.classList.add("hidden");
                            spanElement.classList.remove("hidden");
                            editButton.classList.remove("hidden");
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
