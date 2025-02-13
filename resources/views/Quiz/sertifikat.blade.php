<div class="container mx-auto mt-10 px-4 py-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold text-center mb-6">Sertifikat Pelatihan</h1>

   
            <p class="text-center mb-4">
                Selamat! Anda telah berhasil menyelesaikan pelatihan <strong>{{ $quizAttempt->quiz->pelatihan->name }}</strong>.
            </p>

            <div class="text-center mb-6">
                <img src="{{ asset('images/sertifikat_template.jpg') }}" alt="Sertifikat" class="w-full h-auto">
            </div>

            <p class="text-center mb-6">Nama Peserta: <strong>{{ $quizAttempt->user->name }}</strong></p>
            <p class="text-center mb-6">Tanggal: <strong>{{ $quizAttempt->completed_at->format('d M Y') }}</strong></p>

            <div class="flex justify-center gap-4">
                <a href="{{ route('download.sertifikat', ['user_id' => $quizAttempt->user_id, 'quiz_id' => $quizAttempt->quiz_id]) }}" 
                   class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Unduh Sertifikat
                </a>
            </div>
        
    </div>
</div>
