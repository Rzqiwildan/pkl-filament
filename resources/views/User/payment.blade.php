<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@include('components.navbar')
<body class="bg-gray-100">
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg border w-full max-w-md" style="border: 1px solid #a2a2a2;">
      <h2 class="text-2xl font-bold text-center text-gray-700 mb-8">Upload Bukti Pembayaran</h2>
      <!-- <form action="/upload" method="POST" enctype="multipart/form-data" class="space-y-6"> -->
        <!-- Input Nama Pengguna -->
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700 mb-2 mt-8">Nama pelatihan</label>
          <input type="text" id="username" name="username" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama pelatihan" required/>
        </div>
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700 mb-2 mt-8">Total biaya yang harus dibayar</label>
          <input type="text" id="username" name="username" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan total biaya yang harus dibayar" required/>
        </div>

        <!-- Input File Bukti Pembayaran -->
        <div>
          <label for="buktiPembayaran" class="block text-sm font-medium text-gray-700 mt-8">Bukti Pembayaran</label>
          <input type="file" id="buktiPembayaran" name="buktiPembayaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" accept=".jpg,.jpeg,.png,.pdf" required/>
          <p class="mt-2 text-sm text-gray-500">Format file yang didukung: JPG, PNG, PDF. Maks: 5 MB.</p>
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