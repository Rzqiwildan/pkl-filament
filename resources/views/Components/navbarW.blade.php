<link rel="shortcut icon" href="https://digilib.undip.ac.id/wp-content/uploads/2020/11/cropped-Ikon-Undip-32x32.png"
    type="image/x-icon">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center gap-4">
                <a href="{{ route('welcome') }}">
                    <img class="w-10" src="https://sso.undip.ac.id/assets/app/images/logo-undip-mail.png"
                        alt="Logo">
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
                <a href="{{ route('welcome') }}"
                    class="text-gray-900 hover:text-cgrey-0 px-3 py-2 rounded-md text-sm font-medium">
                    Home
                </a>
                <a href="{{ route('login') }}"
                    class="text-gray-900 hover:text-cgrey-0 px-3 py-2 rounded-md text-sm font-medium">
                    Payment
                </a>
                <a href="{{ route('login') }}"
                    class="text-gray-900 hover:text-cgrey-0 px-3 py-2 rounded-md text-sm font-medium">
                    MyCourse
                </a>
                <a href="{{ route('login') }}"
                    class="text-gray-900 hover:text-cgrey-0 px-3 py-2 rounded-md text-sm font-medium">
                    History
                </a>
                <!-- Login & Register Buttons -->
                <div class="flex flex-col md:flex-row gap-2 md:gap-4 mt-4 md:mt-0">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 text-sm font-medium text-cblack-0 bg-white hover:bg-slate-100 border rounded-lg">Register</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.getElementById('menuBtn');
        const navbarLinks = document.getElementById('navbarLinks');
        const hamburgerLines = menuBtn.querySelectorAll('span');

        menuBtn.addEventListener('click', function() {
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
    document.addEventListener('DOMContentLoaded', function() {
        const profileImage = document.getElementById('profileImage');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Toggling dropdown menu saat gambar profil diklik
        profileImage.addEventListener('click', function() {
            const isVisible = dropdownMenu.style.display === 'block';
            dropdownMenu.style.display = isVisible ? 'none' : 'block';
        });

        // Menutup dropdown jika klik di luar gambar profil
        window.addEventListener('click', function(e) {
            if (!profileImage.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        });
    });
</script>
