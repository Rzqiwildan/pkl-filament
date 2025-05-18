<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Pembayaran</title>
    @vite('resources/css/app.css')
    @include('components.navbar')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="container mx-auto px-4 py-8 flex-grow">
        <h1 class="text-2xl font-semibold mb-6">Halaman Pembayaran</h1>

        {{-- Transaksi yang sedang pending --}}
        @if ($currentTransaction && $currentTransaction->status_pembayaran === 'pending')
            <div class="bg-white rounded-lg shadow-md overflow-x-auto mb-6">
                <div class="p-4 bg-yellow-50 border-b">
                    <h2 class="text-lg font-semibold text-yellow-800">Transaksi Pending</h2>
                    <p class="text-sm text-yellow-600">Silakan selesaikan pembayaran Anda</p>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode Transaksi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Pengguna
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelatihan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status Pembayaran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $currentTransaction->transaction_code }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ Auth::user()->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $currentTransaction->pelatihan->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button onclick="showUploadModal('{{ $currentTransaction->transaction_code }}')"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                                    Upload Bukti
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif

        {{-- History Transaksi --}}
        @if ($transaksis && $transaksis->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-x-auto">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold">History Transaksi</h2>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode Transaksi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelatihan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status Pembayaran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($transaksis as $transaksi)
                            @if ($transaksi->status_pembayaran !== 'pending')
                                <!-- Hanya tampilkan yang approved -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $transaksi->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaksi->transaction_code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaksi->pelatihan->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($transaksi->status_pembayaran === 'approved')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Approved
                                            </span>
                                        @elseif($transaksi->status_pembayaran === 'rejected')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Rejected
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($transaksi->status_pembayaran === 'approved')
                                            <span class="text-green-500 text-sm">✓ Selesai</span>
                                        @elseif($transaksi->status_pembayaran === 'rejected')
                                            <button onclick="showUploadModal('{{ $transaksi->transaction_code }}')"
                                                class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md text-sm">
                                                Upload Ulang
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <!-- Modal Upload -->
        <div id="uploadModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
                    <h3 class="text-lg font-semibold mb-4">Upload Bukti Pembayaran</h3>
                    <form action="{{ route('payment.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="transaction_code" id="modal_transaction_code">

                        <div class="mb-4">
                            <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Bukti Pembayaran (jpg, jpeg, png | max 2MB)
                            </label>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran"
                                accept="image/jpeg,image/jpg,image/png"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                            @error('bukti_pembayaran')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="hideUploadModal()"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                                Batal
                            </button>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showUploadModal(transactionCode) {
            document.getElementById('modal_transaction_code').value = transactionCode;
            document.getElementById('uploadModal').classList.remove('hidden');
        }

        function hideUploadModal() {
            document.getElementById('uploadModal').classList.add('hidden');
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    @include('components.footer')
</body>

</html>
