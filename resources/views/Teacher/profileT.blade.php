@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('components.navbarTeacher')
@section('title', 'Teacher Profile')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-8">
    <h2 class="text-2xl font-semibold text-center mb-6 mt-6">Welcome {{ $teacher->name }}</h2>
    <form method="POST" action="{{ route('teacher.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Foto Profil -->
        <div class="flex flex-col items-center">
            <div class="w-32 h-32">
                <img src="{{ $teacher->profile_photo_path ? asset('storage/' . $teacher->profile_photo_path) : 'https://via.placeholder.com/100' }}"
                    alt="Profile Picture" class="w-full h-full object-cover rounded-full border border-gray-300 shadow">
            </div>
            <label class="cursor-pointer bg-blue-500 text-white py-1 px-3 rounded-lg mt-3">
                Change
                <input type="file" name="profile_photo" class="hidden">
            </label>
            @error('profile_photo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- NIP -->
        <div class="mb-4">
            <label for="nip" class="block text-lg font-semibold text-gray-900 pl-3 mb-2">NIP</label>
            <input type="number" name="nip" id="nip" value="{{ old('nip', $teacher->nip) }}"
                oninput="if(this.value.length > 16) this.value = this.value.slice(0, 16);" required
                title="NIK harus terdiri dari 16 angka"
                class="mt-1 block w-full rounded-lg border border-gray-400 shadow-sm p-2">
            @error('nip')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block text-lg font-semibold text-gray-900 pl-3 mb-2">Nama</label>
            <input type="text" name="name" id="name" value="{{ $teacher->name }}" readonly
                class="mt-1 block w-full rounded-lg border border-gray-400 shadow-sm p-2 bg-gray-100">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-lg font-semibold text-gray-900 pl-3 mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ $teacher->email }}" readonly
                class="mt-1 block w-full rounded-lg border border-gray-400 shadow-sm p-2 bg-gray-100">
        </div>

        <!-- Nomor Telepon -->
        <div class="mb-4">
            <label for="no_telp" class="block text-lg font-semibold text-gray-900 pl-3 mb-2">No Telepon</label>
            <input type="number" name="no_telp" id="no_telp" value="{{ old('no_telp', $teacher->no_telp) }}"
                oninput="if(this.value.length > 13) this.value = this.value.slice(0, 13);" required
                title="Nomor telepon maksimal 13 angka"
                class="mt-1 block w-full rounded-lg border border-gray-400 shadow-sm p-2">
            @error('no_telp')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tanggal Lahir -->
        <div class="mb-4">
            <label for="tgl_lahir" class="block text-lg font-semibold text-gray-900 pl-3 mb-2">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir', $teacher->tgl_lahir) }}"
                class="mt-1 block w-full rounded-lg border border-gray-400 shadow-sm p-2 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
            @error('tgl_lahir')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Tombol -->
        <div class="flex justify-end space-x-3">
            <button type="reset" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Reset</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Simpan Perubahan</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>
@include('components.footer')

