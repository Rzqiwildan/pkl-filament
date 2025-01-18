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
            <div class="p-4 m-10">
                <div class="m-2 mb-6 relative">
                    <input id="email" name="email" type="email" required
                        class="appearance-none relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:border-indigo-500 sm:text-sm"
                        placeholder="Username">
                    <svg class="absolute inset-y-0 right-3 my-auto" width="20" height="20" viewBox="0 0 24 24"
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
                <div class="m-2 mb-6 relative">
                    <input id="password" name="password" type="password" required
                        class="appearance-none rounded relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 focus:outline-none focus:border-indigo-500 sm:text-sm"
                        placeholder="Password">
                    <div class="flex justify-end m-2">
                        <p class="text-cblue-0 text-sm">Forgot Password</p>
                    </div>
                </div>
                <div class="p-2 m-2">
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

<script></script>
