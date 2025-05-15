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
                Login
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Pesan error kredensial -->
            @if ($errors->any())
                <div class="mx-10 text-center bg-red-100 border border-red-400 text-red-700 rounded">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Notifikasi resend verifikasi email -->
            @if (session('resend'))
                <div class="mx-10 p-2 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded">
                    <p>Anda perlu memverifikasi email terlebih dahulu. Silakan cek email Anda.</p>
                    <form action="{{ route('verification.send') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="text-blue-500 text-sm underline">
                            Kirim ulang link verifikasi
                        </button>
                    </form>
                </div>
            @endif

            <div class="p-4 m-10">
                <div class="m-2 mb-6 relative">
                    <input id="email" name="email" type="email" required
                        class="appearance-none relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:border-indigo-500 sm:text-sm"
                        placeholder="Username">
                    <svg class="absolute inset-y-0 right-2 my-auto" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_10096)">
                            <path
                                d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z"
                                fill="#6B7280" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_10096">
                                <rect width="24" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="m-2 mb-2 relative"> <!-- Ubah mb-6 menjadi mb-2 untuk menjaga spasi dengan link Forgot Password -->
                    <input id="password" name="password" type="password" required
                        class="appearance-none rounded relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 focus:outline-none focus:border-indigo-500 sm:text-sm"
                        placeholder="Password">
                    <!-- Perbaikan posisi ikon mata -->
                    <button type="button" class="absolute inset-y-0 right-2 flex items-center" onclick="togglePasswordVisibility('password')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 eye-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 eye-slash-icon hidden" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.28 2.22a.75.75 0 00-1.06 1.06l14.5 14.5a.75.75 0 101.06-1.06l-1.745-1.745a10.029 10.029 0 003.3-4.38 1.651 1.651 0 000-1.185A10.004 10.004 0 009.999 3a9.956 9.956 0 00-4.744 1.194L3.28 2.22zM7.752 6.69l1.092 1.092a2.5 2.5 0 013.374 3.373l1.091 1.092a4 4 0 00-5.557-5.557z" clip-rule="evenodd" />
                            <path d="M10.748 13.93l2.523 2.523a9.987 9.987 0 01-3.27.547c-4.258 0-7.894-2.66-9.337-6.41a1.651 1.651 0 010-1.186A10.007 10.007 0 012.839 6.02L6.07 9.252a4 4 0 004.678 4.678z" />
                        </svg>
                    </button>
                </div>
                <div class="flex justify-end mx-2">
                    <a href="{{ route('password.request') }}" class="text-cblue-0 text-sm">Forgot Password</a>
                </div>
                <div class="p-2 m-2 mt-4"> <!-- Tambahkan mt-4 untuk jarak yang lebih baik -->
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border text-sm font-medium rounded-md text-black bg-white hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Login
                    </button>
                    <div class="">
                        <p class="text-sm">Don't have an account?</p>
                        <a href="{{ route('register') }}" class="text-cblue-0 text-sm">Register now!</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk toggle password visibility -->
<script>
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        const button = input.nextElementSibling;
        const eyeIcon = button.querySelector('.eye-icon');
        const eyeSlashIcon = button.querySelector('.eye-slash-icon');
        
        // Toggle type between password and text
        if (input.type === 'password') {
            input.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeSlashIcon.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeSlashIcon.classList.add('hidden');
        }
    }
</script>