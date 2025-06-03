<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pelatihans->name }}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('components.navbar')
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6 mt-16">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Pelatihan</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Detail Pelatihan -->
            <div class="col-span-2 border rounded-lg p-4" style="border: 1px solid #a2a2a2;">
                <div class="flex items-center justify-between border-b border-gray-400 mb-8">
                    <h2 class="text-lg font-semibold mb-4">{{ $pelatihans->name }}</h2>
                    <div class="text-sm mb-4">
                        <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full"
                            style="border: 1px solid #1E40AF">{{ $pelatihans->jenis }}</span>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <img src="{{ Storage::url($jadwalPelatihan->image) }}" class="w-20 h-20 rounded-md mb-8 mr-8">
                    <div>
                        <p class="font-medium mb-4">{{ $jadwalPelatihan->location_name }}</p>
                        <p class="text-sm text-gray-600">
                            {{ $jadwalPelatihan->address }}
                        </p>
                    </div>
                </div>
                <div class="maps w-full">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.4377353773596!2d110.4381257741071!3d-7.048600869476866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708c3e6c1a6d05%3A0xa5f69b96fddc3e51!2sUPT%20Perpustakaan%20dan%20UNDIP%20Press!5e0!3m2!1sid!2sid!4v1706698660243!5m2!1sid!2sid"
                        class="w-full h-[400px] rounded-lg" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Ringkasan Pendaftaran -->
            <div class="border rounded-lg p-6" style="border: 1px solid #a2a2a2;">
                <h2 class="text-lg font-semibold mb-8">Ringkasan Pendaftaran</h2>
                <div class="flex justify-between items-center mb-4">
                    <span>Biaya Pelatihan</span>
                    <span class="font-regular text-green-600">Rp
                        {{ number_format($pelatihans->harga, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <span class="font-semibold">Total Pembayaran</span>
                    <span class="font-semibold text-green-600">Rp
                        {{ number_format($pelatihans->harga, 0, ',', '.') }}</span>
                </div>

                @php
                    $isExpired = $pelatihans->jadwalPelatihan->end_date < now(); // Cek apakah pelatihan sudah berakhir
                    $isRegistered = $isRegistered ?? false;
                    $hasApprovedTransaction = Auth::check() ? 
                        \App\Models\Transaksi::where('user_id', Auth::id())
                            ->where('pelatihan_id', $pelatihans->id)
                            ->where('status_pembayaran', 'approved')
                            ->exists() : false;
                @endphp

                @if ($isExpired)
                    <button type="button" disabled
                        class="w-full px-4 py-2 font-semibold text-white rounded-md border-none cursor-not-allowed mt-8 mb-4 bg-gray-400">
                        Pelatihan Sudah Berakhir
                    </button>
                @elseif($hasApprovedTransaction)
                    <button type="button" disabled
                        class="w-full px-4 py-2 font-semibold text-white rounded-md border-none cursor-not-allowed mt-8 mb-4 bg-green-500">
                        Pembayaran Sudah Diverifikasi
                    </button>
                @elseif($pelatihans->harga == 0)
                    @if($isRegistered)
                        <button type="button" disabled
                            class="w-full px-4 py-2 font-semibold text-white rounded-md border-none cursor-not-allowed mt-8 mb-4 bg-gray-400">
                            Anda telah terdaftar!
                        </button>
                    @else
                        <form id="form-ikut-pelatihan" action="{{ route('ikut.pelatihan') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pelatihan_id" value="{{ $pelatihans->id }}">
                            <button id="registerButton" type="submit"
                                class="w-full px-4 py-2 font-semibold text-white rounded-md border-none cursor-pointer mt-8 mb-4 transition duration-300 bg-blue-500 hover:bg-blue-600">
                                Daftar Sekarang
                            </button>
                        </form>
                    @endif
                @else
                    @php
                        $hasPendingTransaction = Auth::check() ? 
                            \App\Models\Transaksi::where('user_id', Auth::id())
                                ->where('pelatihan_id', $pelatihans->id)
                                ->where('status_pembayaran', 'pending')
                                ->exists() : false;
                    @endphp
                    
                    @if($hasPendingTransaction)
                        <button type="button"
                            onclick="window.location.href='{{ route('user.payment') }}'"
                            class="bg-yellow-500 text-white font-semibold w-full px-4 py-2 rounded-md border-none cursor-pointer mt-8 mb-4 transition duration-300 hover:bg-yellow-600">
                            Lanjutkan Pembayaran
                        </button>
                    @else
                        <button id="daftarBayarButton" type="button"
                            class="bg-blue-500 text-white font-semibold w-full px-4 py-2 rounded-md border-none cursor-pointer mt-8 mb-4 transition duration-300 hover:bg-blue-600">
                            Daftar dan Bayar
                        </button>
                    @endif
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Jadwal Pelatihan -->
        <div class="border rounded-lg mt-6 p-6" style="border: 1px solid #a2a2a2;">
            <h2 class="text-lg font-semibold mb-4">Jadwal Pelatihan</h2>
            <div class="flex justify-between items-center bg-blue-50 border mb-4 px-4 py-2 rounded-lg"
                style="border: 1px solid #1E40AF;">
                <span>
                    {{ \Carbon\Carbon::parse($jadwalPelatihan->start_date)->format('d M Y') }} -
                    {{ \Carbon\Carbon::parse($jadwalPelatihan->end_date)->format('d M Y') }}
                </span>
                @if (!$isExpired)
                    <span class="font-semibold">{{ $pelatihans->kapasitas }} kuota tersedia</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal Pembayaran --}}
    <div id="modalPembayaran"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full"
        style="z-index: 1000;">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-xl font-semibold text-center mb-4">Konfirmasi Pembayaran</h3>

                <form action="{{ route('user.proses.pembayaran') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pelatihan_id" value="{{ $pelatihans->id }}">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pelatihan</label>
                        <input type="text" value="{{ $pelatihans->name }}"
                            class="mt-1 p-2 w-full border rounded-md" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis</label>
                        <input type="text" value="{{ ucfirst($pelatihans->jenis) }}"
                            class="mt-1 p-2 w-full border rounded-md" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="text" value="Rp {{ number_format($pelatihans->harga, 0, ',', '.') }}"
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

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const daftarBayarButton = document.getElementById("daftarBayarButton");
            const modalPembayaran = document.getElementById('modalPembayaran');
            const tutupModal = document.getElementById('tutupModal');
            const tombolMetodePembayaran = document.querySelectorAll('.tombol-metode-pembayaran');

            if (daftarBayarButton) {
                daftarBayarButton.addEventListener("click", function() {
                    modalPembayaran.classList.remove('hidden');
                });
            }

            if (tutupModal) {
                tutupModal.addEventListener('click', function() {
                    modalPembayaran.classList.add('hidden');
                });
            }

            tombolMetodePembayaran.forEach(tombol => {
                tombol.addEventListener('click', function() {
                    tombolMetodePembayaran.forEach(t => t.classList.remove('border-blue-500'));
                    this.classList.add('border-blue-500');
                    document.getElementById('metode_pembayaran_terpilih').value = this.dataset.metode;
                });
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === modalPembayaran) {
                    modalPembayaran.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>