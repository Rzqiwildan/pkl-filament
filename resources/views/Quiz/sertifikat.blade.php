@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="min-h-screen bg-gray-100 py-6">
    <div
        class="relative w-[800px] h-[800px] mx-auto bg-gradient-to-br from-white to-gray-100 p-10 border-[20px] border-[#1B86B7]">
        <!-- Header Logo -->
        <div class="text-center mb-8">
            <img src="https://sso.undip.ac.id/assets/app/images/logo-undip-mail.png" alt="Logo" class="h-20 mx-auto">
        </div>

        <!-- Title -->
        <div class="text-center mb-6">
            <h1 class="text-5xl text-[#1B86B7] font-serif mb-2">SERTIFIKAT</h1>
            <h2 class="text-2xl text-gray-700">PELATIHAN ONLINE</h2>
        </div>

        <!-- Content -->
        <div class="text-center mb-6">
            <p class="text-lg mb-4">Diberikan kepada:</p>
            <h2 class="text-4xl text-gray-800 font-serif mb-6">{{ $quizAttempt->user->name }}</h2>
            <p class="text-lg leading-relaxed">
                Atas keberhasilan menyelesaikan pelatihan<br>
                <span
                    class="text-2xl font-bold text-[#1B86B7]">{{ $quizAttempt->quiz->bagianPelatihan->pelatihan->name }}</span>
            </p>
        </div>

        <!-- Date -->
        <div class="text-center mb-8">
            <p class="text-base">
                Diberikan pada tanggal
                {{ \Carbon\Carbon::parse($quizAttempt->tanggal)->locale('id')->isoFormat('D MMMM Y') }}
            </p>
        </div>

        <div class="flex justify-between px-16 mt-4">
            <div class="text-center">
                {{-- <div class="">
                    <!-- Space untuk tanda tangan -->
                </div> --}}
                <p class="font-semibold mb-20">Kepala Pelatihan</p>
                <div class="w-44 border-b border-black"></div>
                <p>Nama Kepala</p>
            </div>
            <div class="text-center">
                {{-- <div class=""> --}}
                {{-- <!-- Space untuk tanda tangan --> --}}
                {{-- </div> --}}
                <p class="font-semibold mb-20">Instruktur</p>
                <div class="w-44 border-b border-black"></div>
                <p>Nama Instruktur</p>
            </div>
        </div>
        <!-- Signatures - Di dalam sertifikat -->

        <!-- Watermark -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-45 opacity-10">
            <img src="https://sso.undip.ac.id/assets/app/images/logo-undip-mail.png" alt="Watermark" class="w-96">
        </div>
    </div>

    <!-- Download Button - Tetap di luar sertifikat -->
    <div class="flex justify-center mt-6">
        <a href="{{ route('download.sertifikat', ['quiz_id' => $quizAttempt->quiz_id]) }}"
            class="bg-[#1B86B7] hover:bg-[#156c93] text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
            Unduh Sertifikat
        </a>
    </div>
</div>
