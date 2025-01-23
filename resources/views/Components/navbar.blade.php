@vite(['resources/css/app.css', 'resources/js/app.js'])
<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}">
                    <img class="w-10" src="https://sso.undip.ac.id/assets/app/images/logo-undip-mail.png" alt="Logo">
                </a>
                <div class="h-10 w-0.5 bg-black"></div>
                <div class="flex flex-col">
                    <span class="text-sm font-semibold">Universitas Diponegoro</span>
                    <span class="text-xs font-medium">PKL</span>
                </div>
            </div>

            <!-- Hamburger Menu Button -->
            <button id="menuBtn" aria-expanded="false" aria-controls="navbarLinks"
                class="flex md:hidden flex-col justify-center items-center gap-1 w-8 h-8 text-gray-500 hover:bg-gray-100 rounded-lg focus:ring-2 focus:ring-gray-200 dark:text-gray-400">
                <span class="block w-6 h-0.5 bg-black transform transition duration-300 origin-center"></span>
                <span class="block w-6 h-0.5 bg-black transform transition duration-300 origin-center"></span>
                <span class="block w-6 h-0.5 bg-black transform transition duration-300 origin-center"></span>
            </button>

            <!-- Navbar Links -->
            <div id="navbarLinks"
                class="hidden md:flex flex-col md:flex-row md:items-center md:gap-8 absolute md:static top-16 left-0 w-full md:w-auto bg-white shadow-md md:shadow-none p-4 md:p-0">
                <a href="{{ route('dashboard') }}"
                    class="text-gray-900 hover:text-cgrey-0 px-3 py-2 rounded-md text-sm font-medium">
                    Home
                </a>
                <a href="{{route('user.payment')}}"
                    class="text-gray-900 hover:text-cgrey-0 px-3 py-2 rounded-md text-sm font-medium">
                    Payment
                </a>
                <a href="{{ route('user.course') }}"
                    class="text-gray-900 hover:text-cgrey-0 px-3 py-2 rounded-md text-sm font-medium">
                    MyCourse
                </a>
                <a href="{{route('user.history')}}"
                    class="text-gray-900 hover:text-cgrey-0 px-3 py-2 rounded-md text-sm font-medium">
                    History
                </a>
                <div class="relative">
                <!-- User Profile Dropdown -->
                <div class="relative">
                    <img src="https://i.pinimg.com/736x/2d/9f/8d/2d9f8d4e12b1aceb0d77109f753e46cf.jpg" alt="User" class="w-10 h-10 rounded-full" style="border: 1px solid #000;" id="profileImage">
                    <!-- Dropdown Menu with Inline CSS -->
                    <div id="dropdownMenu" class="hidden absolute top-full right-0 bg-white shadow-lg rounded-lg w-48 z-10 border border-gray-500">
                        <a href="{{route('user.profil')}}" class="flex items-center px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-300 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Profile
                        </a>
                        <a href="http://127.0.0.1:8000/logout" class="flex items-center px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-300 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuBtn = document.getElementById('menuBtn');
        const navbarLinks = document.getElementById('navbarLinks');
        const hamburgerLines = menuBtn.querySelectorAll('span');

        menuBtn.addEventListener('click', function () {
            const expanded = menuBtn.getAttribute('aria-expanded') === 'true' || false;
            menuBtn.setAttribute('aria-expanded', !expanded);
            navbarLinks.classList.toggle('hidden');
            navbarLinks.classList.toggle('flex');

            // Animate Hamburger Button
            hamburgerLines[0].classList.toggle('rotate-45');
            hamburgerLines[0].classList.toggle('translate-y-1.5');
            hamburgerLines[1].classList.toggle('opacity-0');
            hamburgerLines[2].classList.toggle('-rotate-45');
            hamburgerLines[2].classList.toggle('-translate-y-1.5');
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileImage = document.getElementById('profileImage');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Toggling dropdown menu saat gambar profil diklik
        profileImage.addEventListener('click', function () {
            const isVisible = dropdownMenu.style.display === 'block';
            dropdownMenu.style.display = isVisible ? 'none' : 'block';
        });

        // Menutup dropdown jika klik di luar gambar profil
        window.addEventListener('click', function (e) {
            if (!profileImage.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        });
    });
</script>
