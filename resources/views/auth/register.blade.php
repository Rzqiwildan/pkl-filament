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
            <div class="p-4 m-10">
                <div class="m-2 mb-6 relative">
                    <input id="name" name="name" type="text" required
                        class="appearance-none relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:border-indigo-500 sm:text-sm"
                        placeholder="Name">
                </div>
                <div class="m-2 mb-6 relative">
                    <input id="email" name="email" type="email" required
                        class="appearance-none relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:border-indigo-500 sm:text-sm"
                        placeholder="Email address">
                </div>
                <div class="m-2 mb-6 relative">
                    <input id="password" name="password" type="password" required
                        class="appearance-none rounded relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 focus:outline-none focus:border-indigo-500 sm:text-sm"
                        placeholder="Password">
                </div>
                <div class="m-2 mb-6 relative">
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="appearance-none rounded relative block w-full px-3 py-2 pr-10 border placeholder-gray-500 text-gray-900 focus:outline-none focus:border-indigo-500 sm:text-sm"
                        placeholder="Confirm Password">
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

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("password_confirmation");
        const eyeIcon = document.getElementById("eye-icon");
        const eyePath = eyeIcon.querySelector("path");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            confirmPasswordInput.type = "text";
            eyePath.setAttribute("d",
                "M13 10m0 0c0-2-2-4-4-4s-4 2-4 4 2 4 4 4 4-2 4-4zm6-2c0 3.5-4.5 7-8 7s-8-3.5-8-7 4.5-7 8-7 8 3.5 8 7z"
                );
        } else {
            passwordInput.type = "password";
            confirmPasswordInput.type = "password";
            eyePath.setAttribute("d",
                "M15 12m0 0c0 2-2 4-4 4s-4-2-4-4 2-4 4-4 4 2 4 4zm2-1c0 3.5-4.5 7-8 7s-8-3.5-8-7 4.5-7 8-7 8 3.5 8 7z"
                );
        }
    }
</script>
