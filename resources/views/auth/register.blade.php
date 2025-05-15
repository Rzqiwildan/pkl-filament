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
                Register
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="mx-10 p-2 bg-red-100 border border-red-400 text-red-700 rounded-md">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="p-4 m-10">
                <div class="m-2 mb-6 relative">
                    <input id="name" name="name" type="text" required
                        class="appearance-none relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
                        placeholder="Name" value="{{ old('name') }}">
                </div>
                <div class="m-2 mb-6 relative">
                    <input id="email" name="email" type="email" required
                        class="appearance-none relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                        placeholder="Email address" value="{{ old('email') }}">
                </div>
                <div class="m-2 mb-6 relative">
                    <input id="password" name="password" type="password" required
                        class="appearance-none rounded relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 focus:outline-none focus:border-indigo-500 sm:text-sm"
                        placeholder="Password">
                    <!-- Ikon mata untuk toggle password visibility -->
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                        onclick="togglePasswordVisibility('password')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 eye-icon"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 eye-slash-icon hidden"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.28 2.22a.75.75 0 00-1.06 1.06l14.5 14.5a.75.75 0 101.06-1.06l-1.745-1.745a10.029 10.029 0 003.3-4.38 1.651 1.651 0 000-1.185A10.004 10.004 0 009.999 3a9.956 9.956 0 00-4.744 1.194L3.28 2.22zM7.752 6.69l1.092 1.092a2.5 2.5 0 013.374 3.373l1.091 1.092a4 4 0 00-5.557-5.557z"
                                clip-rule="evenodd" />
                            <path
                                d="M10.748 13.93l2.523 2.523a9.987 9.987 0 01-3.27.547c-4.258 0-7.894-2.66-9.337-6.41a1.651 1.651 0 010-1.186A10.007 10.007 0 012.839 6.02L6.07 9.252a4 4 0 004.678 4.678z" />
                        </svg>
                    </div>
                </div>
                <div class="m-2 mb-6 relative">
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="appearance-none rounded relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 focus:outline-none focus:border-indigo-500 sm:text-sm"
                        placeholder="Confirm Password">
                    <!-- Ikon mata untuk toggle password confirmation visibility -->
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                        onclick="togglePasswordVisibility('password_confirmation')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 eye-icon"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 eye-slash-icon hidden"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.28 2.22a.75.75 0 00-1.06 1.06l14.5 14.5a.75.75 0 101.06-1.06l-1.745-1.745a10.029 10.029 0 003.3-4.38 1.651 1.651 0 000-1.185A10.004 10.004 0 009.999 3a9.956 9.956 0 00-4.744 1.194L3.28 2.22zM7.752 6.69l1.092 1.092a2.5 2.5 0 013.374 3.373l1.091 1.092a4 4 0 00-5.557-5.557z"
                                clip-rule="evenodd" />
                            <path
                                d="M10.748 13.93l2.523 2.523a9.987 9.987 0 01-3.27.547c-4.258 0-7.894-2.66-9.337-6.41a1.651 1.651 0 010-1.186A10.007 10.007 0 012.839 6.02L6.07 9.252a4 4 0 004.678 4.678z" />
                        </svg>
                    </div>
                </div>
                <!-- Radio button untuk pilihan role -->
                <div class="m-2 mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Register as:</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="role" value="mahasiswa" class="form-radio text-indigo-600"
                                required>
                            <span class="ml-2">Mahasiswa</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="role" value="umum" class="form-radio text-indigo-600"
                                required>
                            <span class="ml-2">Umum</span>
                        </label>
                    </div>
                </div>
                <div class="p-2 m-2">
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border text-sm font-medium rounded-md text-black bg-white hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Register
                    </button>
                    <div class="mt-4">
                        <p class="text-sm">Already have an account?</p>
                        <a href="{{ route('login') }}" class="text-cblue-0 text-sm">Login</a>
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
        const parent = input.parentElement;
        const eyeIcon = parent.querySelector('.eye-icon');
        const eyeSlashIcon = parent.querySelector('.eye-slash-icon');

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
