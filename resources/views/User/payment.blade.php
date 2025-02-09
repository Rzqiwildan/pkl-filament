<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Bukti Pembayaran</title>
    @vite('resources/css/app.css') <!-- Tambahkan jika menggunakan Tailwind -->
</head>
@include('components.navbar')

<body class="bg-gray-100">
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg border w-full max-w-md" style="border: 1px solid #a2a2a2;">
      <h2 class="text-2xl font-bold text-center text-gray-700 mb-8">Upload Bukti Pembayaran</h2>

      @if (session('success'))
          <div class="bg-green-500 text-white p-3 rounded-md mb-4 text-center">
              {{ session('success') }}
          </div>
      @endif

      <form action="{{ route('upload-bukti') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Input hidden untuk Pelatihan ID -->
        <input type="hidden" name="pelatihan_id" value="{{ $pelatihan->id }}">

        <!-- Input Bukti Pembayaran -->
        <div>
            <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mt-8 mb-4">Bukti Pembayaran</label>
            <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" accept=".jpg,.jpeg,.png,.pdf" required/>
            <p class="mt-4 text-sm text-gray-500">Format file yang didukung: JPG, PNG, PDF. Maks: 5 MB.</p>
        </div>

        <!-- Tombol Submit -->
        <div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg shadow-md focus:ring-4 focus:ring-blue-300 mt-8">
                Unggah
            </button>
        </div>
    </form>

    </div>
  </div>
</body>
</html>
