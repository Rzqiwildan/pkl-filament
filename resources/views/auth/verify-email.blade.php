<link rel="shortcut icon" href="https://digilib.undip.ac.id/wp-content/uploads/2020/11/cropped-Ikon-Undip-32x32.png"
    type="image/x-icon">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="min-h-screen flex items-center justify-center bg-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-1 bg-white shadow-md rounded">
        <div class="mt-2">
            <div class="flex justify-center">
                <img src="https://sso.undip.ac.id/assets/app/images/logo-undip.png" alt="" class="pt-4"
                    style="width: 150px">
            </div>
            <h2 class="mt-6 text-center text-3xl font-medium text-gray-900">
                Verifikasi Email
            </h2>
        </div>
        
        @if (session('status'))
            <div class="m-4 p-2 text-center bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('status') }}
            </div>
        @endif
        
        <div class="p-4 m-10">
            <div class="mb-6 text-center">
                <p class="text-gray-600">Email verifikasi telah dikirim ke alamat email Anda.</p>
                <p class="text-gray-600 mt-2">Silakan periksa kotak masuk email Anda dan klik tautan verifikasi.</p>
                <p class="text-gray-600 mt-2">Jika Anda tidak menerima email, klik tombol di bawah ini untuk mengirim ulang.</p>
            </div>
            
            <form action="{{ route('verification.send') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border text-sm font-medium rounded-md text-black bg-white hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kirim Ulang Link Verifikasi
                </button>
            </form>
            
            <div class="mt-4 text-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-blue-500 text-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>