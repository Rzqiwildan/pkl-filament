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
    <div class="container mx-auto py-10 mt-16">
        <div class="rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kiri: Konten utama -->
                <div class="col-span-2">
                    <!-- Header -->
                    <div class="flex justify-between items-center pb-4 border-b border-gray-400">
                        <div>
                            <h1 class="text-2xl font-semibold mb-8">{{ $pelatihans->name }}</h1>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span class="text-gray-600 text-sm">{{ $pelatihans->remaining_time }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                    </svg>
                                    <span class="text-gray-600 text-sm">Tingkat: {{ $pelatihans->kesulitan }}</span>
                                </div>
                                <p class="text-sm text-gray-600 flex items-center">
                                    <span class="mr-2">Kuota: {{ $pelatihans->kapasitas }} Peserta</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-600 mb-14">
                            <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full"
                                style="border: 1px solid #1E40AF">{{ $pelatihans->jenis }}</span>
                        </div>
                    </div>

                    <!-- Tentang Pelatihan -->
                    <div class="mb-8 mt-8">
                        <h2 class="text-lg font-semibold mb-2">Tentang Pelatihan</h2>
                        <p class="text-gray-600">
                            {{ $pelatihans->deskripsi }}
                        </p>
                    </div>

                    <!-- Detail -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-black">Kemampuan Dasar</h3>
                        <p class="text-gray-600">-</p>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-black">Pengalaman Kerja</h3>
                        <p class="text-gray-600">-</p>
                    </div>
                </div>

                <!-- Kanan: Sidebar -->
                <div class="col-span-1 ml-8">
                    <div class="p-4 rounded-lg border" style="border: 1px solid #a2a2a2;">
                        <div class="mb-8">
                            <p class="text-lg font-medium">Harga</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($pelatihans->harga, 0, ',', '.') }}</p>
                        </div>
                        @if ($pelatihans->jenis === 'offline')
                            <!-- Jika kuota masih tersedia -->
                            @if ($pelatihans->kapasitas > 0)
                                <a href="{{ route('offline.show', $pelatihans->id) }}">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-4 py-2 w-full rounded-lg mb-8">
                                        Ikuti Pelatihan
                                    </button>
                                </a>
                            @else
                                <!-- Jika kuota habis -->
                                <button
                                    class="bg-gray-400 text-white text-sm font-semibold px-4 py-2 w-full rounded-lg mb-8 cursor-not-allowed"
                                    disabled>
                                    Kuota Habis
                                </button>
                            @endif
                        @else
                            <!-- Form untuk pelatihan online -->
                            <button id="registerButton" type="button"
                                class="{{ $isRegistered ? 'disabled' : 'bg-blue-500 hover:bg-blue-600' }} text-white text-sm font-semibold px-4 py-2 w-full rounded-lg"
                                {{ $isRegistered ? 'disabled' : '' }}>
                                {{ $isRegistered ? 'Anda telah terdaftar!' : 'Daftar Sekarang' }}
                            </button>
                        @endif

                        <p class="text-sm text-gray-600 mb-2">Program ini sudah termasuk:</p>
                        <ul class="text-sm text-gray-600 list-disc list-inside mb-4">
                            <li>Sertifikat Mengikuti Pelatihan</li>
                            <li>Bahasa Pengantar: Bahasa Indonesia</li>
                        </ul>
                    </div>
                    <div class="rounded-lg border mt-8" style="border: 1px solid #a2a2a2;">
                        <button
                            class="hover:border-blue-400 border-2 text-grey-400 text-sm font-semibold px-4 py-2 w-full rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                            </svg>
                            Bagikan
                        </button>
                    </div>
                </div>

                <!-- Modal Pop-up Pembayaran -->
                <div id="modalPembayaran"
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full"
                    style="z-index: 1000;">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3">
                            <h3 class="text-xl font-semibold text-center mb-4">Konfirmasi Pembayaran</h3>

                            <form action="{{ route('user.proses.pembayaran') }}" method="POST">
                                @csrf
                                <input type="hidden" name="pelatihan_id" value="{{ $pelatihans->id }}">
                                <input type="hidden" name="transaction_code" value="{{ $transactionCode }}">

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Kode Transaksi</label>
                                    <input type="text" id="transaction_code" name="transaction_code"
                                        value="{{ $transactionCode }}" class="mt-1 p-2 w-full border rounded-md"
                                        readonly>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Pelatihan</label>
                                    <input type="text" value="{{ $pelatihans->name }}"
                                        class="mt-1 p-2 w-full border rounded-md" readonly>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                                    <div class="space-y-2 mt-1">
                                        <button type="button"
                                            class="tombol-metode-pembayaran w-full p-2 border rounded-md text-left flex items-center"
                                            data-metode="BRI">
                                            <img src="{{ asset('img/BRI.svg') }}" class="h-6 mr-2" alt="BRI">
                                        </button>
                                        <button type="button"
                                            class="tombol-metode-pembayaran w-full p-2 border rounded-md text-left flex items-center"
                                            data-metode="Mandiri">
                                            <img src="{{ asset('img/MANDIRI.svg.webp') }}" class="h-6 mr-2"
                                                alt="Mandiri">
                                        </button>
                                        <button type="button"
                                            class="tombol-metode-pembayaran w-full p-2 border rounded-md text-left flex items-center"
                                            data-metode="BCA">
                                            <img src="{{ asset('img/BCA.svg') }}" class="h-6 mr-2" alt="BCA">
                                        </button>
                                    </div>
                                    <input type="hidden" name="metode_pembayaran" id="metode_pembayaran_terpilih">
                                </div>

                                <div class="flex justify-between mt-4">
                                    <button type="button" id="tutupModal"
                                        class="px-4 py-2 bg-red-500 text-white rounded-md">
                                        BATAL
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">
                                        KONFIRMASI
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const button = document.getElementById("registerButton");
        const modalPembayaran = document.getElementById('modalPembayaran');
        const tutupModal = document.getElementById('tutupModal');
        const tombolMetodePembayaran = document.querySelectorAll('.tombol-metode-pembayaran');

        button.addEventListener("click", function() {
            modalPembayaran.classList.remove('hidden');
        });

        tutupModal.addEventListener('click', function() {
            modalPembayaran.classList.add('hidden');
        });

        tombolMetodePembayaran.forEach(tombol => {
            tombol.addEventListener('click', function() {
                tombolMetodePembayaran.forEach(t => t.classList.remove('border-blue-500'));
                this.classList.add('border-blue-500');
                document.getElementById('metode_pembayaran_terpilih').value = this.dataset
                    .metode;
            });
        });
    });
</script>

</html>
