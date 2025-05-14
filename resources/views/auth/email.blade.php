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
                Forgot Password
            </h2>
        </div>
        
        @if (session('status'))
            <div class="m-4 p-2 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('status') }}
            </div>
        @endif
        
        <form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="p-4 m-10">
                <div class="m-2 mb-6 relative">
                    <input id="email" name="email" type="email" required
                        class="appearance-none relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                        placeholder="Email Address" value="{{ old('email') }}">
                    <svg class="absolute inset-y-0 right-3 my-auto" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_10096)">
                            <path
                                d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z"
                                fill="#6B7280" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_10096">
                                <rect width="24" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-8 p-2 m-2">
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border text-sm font-medium rounded-md text-black bg-white hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Send Password Reset Link
                    </button>
                    <div class="mt-4 text-center">
                        <a href="{{ route('login') }}" class="text-cblue-0 text-sm">Back to Login</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>