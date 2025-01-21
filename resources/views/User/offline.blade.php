<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@include('components.navbar')
<body class="bg-gray-100">
    <div class="container mx-auto p-6 mt-24">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Daftar Pelatihan</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Detail Pelatihan -->
        <div class="col-span-2 border rounded-lg p-4" style="border: 1px solid #a2a2a2;">
            <div class="flex items-center justify-between border-b border-gray-400 mb-8">
                <h2 class="text-lg font-bold mb-4">Dasar Pemrograman</h2>
                <div class="text-sm mb-4">
                    <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">Offline</span>
                </div>
            </div>
            
            <div class="flex items-start space-x-4">
                <img src="https://i.pinimg.com/736x/2a/29/bd/2a29bdac0443c22be5023b94cea79e89.jpg" class="w-16 h-20 rounded-md mb-8 mr-8">
                <div>
                    <p class="font-medium mb-4">UPT Perpustakaan dan UNDIP Press</p>
                    <p class="text-sm text-gray-600">
                        Jl. Prof. Soedarto SH, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275
                    </p>
                    <a href="https://maps.app.goo.gl/qbk6nmfRNckJwXEd6" target="_blank" class="text-blue-500 text-sm" style="text-decoration: underline;">Lihat di Google Maps</a>
                </div>
            </div>
        </div>

        <!-- Ringkasan Pendaftaran -->
        <div class="border rounded-lg p-6" style="border: 1px solid #a2a2a2;">
            <h2 class="text-lg font-semibold mb-8">Ringkasan Pendaftaran</h2>
            <div class="flex justify-between items-center mb-4">
                <span>Biaya Pelatihan</span>
                <span class="font-regular text-green-600">Gratis</span>
            </div>
            <div class="flex justify-between items-center mb-4">
                <span class="font-semibold">Total Pembayaran</span>
                <span class="font-semibold text-green-600">Gratis</span>
            </div>
            <button id="registerButton">Daftar Sekarang</button>

            <!-- Overlay gelap -->
            <div id="overlay" style="display: none;"></div>

            <!-- Elemen notifikasi -->
            <div id="notification" style="display: none;">
                <div id="iconContainer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div class="mb-4 mt-4">
                    <p>Anda Berhasil Mendaftar Pelatihan!</p>
                </div>
                <button id="closeButton">Oke</button>
            </div>

            <script>
                // Menambahkan gaya tombol menggunakan JavaScript
                const button = document.getElementById("registerButton");
                button.style.backgroundColor = "#3b82f6"; 
                button.style.color = "white"; 
                button.style.fontWeight = "600"; 
                button.style.width = "100%"; 
                button.style.padding = "0.5rem"; 
                button.style.borderRadius = "0.375rem";
                button.style.border = "none";
                button.style.cursor = "pointer";
                button.style.marginTop = "2rem"; 
                button.style.marginBottom = "1rem"; 

                button.addEventListener("mouseenter", () => {
                    button.style.backgroundColor = "#2563eb";
                });

                button.addEventListener("mouseleave", () => {
                    button.style.backgroundColor = "#3b82f6";
                });

                // Menambahkan gaya overlay
                const overlay = document.getElementById("overlay");
                overlay.style.position = "fixed";
                overlay.style.top = "0";
                overlay.style.left = "0";
                overlay.style.width = "100%";
                overlay.style.height = "100%";
                overlay.style.backgroundColor = "rgba(0, 0, 0, 0.6)";
                overlay.style.zIndex = "1000";

                // Ikon centang
                const iconContainer = document.getElementById("iconContainer");
                iconContainer.style.display = "flex";
                iconContainer.style.justifyContent = "center";
                iconContainer.style.marginBottom = "10px";

                const icon = document.querySelector(".icon");
                icon.style.width = "50px";
                icon.style.height = "50px";
                icon.style.color = "#3b82f6";

                // Menambahkan gaya notifikasi
                const notification = document.getElementById("notification");
                notification.style.position = "fixed";
                notification.style.top = "50%";
                notification.style.left = "50%";
                notification.style.transform = "translate(-50%, -50%)";
                notification.style.backgroundColor = "#f3f4f6";
                notification.style.color = "#333";
                notification.style.padding = "20px";
                notification.style.borderRadius = "15px";
                notification.style.textAlign = "center";
                notification.style.width = "300px";
                notification.style.zIndex = "1010";

                const closeButton = document.getElementById("closeButton");
                closeButton.style.backgroundColor = "#3b82f6";
                closeButton.style.color = "white";
                closeButton.style.border = "none";
                closeButton.style.borderRadius = "5px";
                closeButton.style.padding = "10px";
                closeButton.style.cursor = "pointer";
                closeButton.style.marginTop = "10px";

                closeButton.addEventListener("mouseenter", () => {
                    closeButton.style.backgroundColor = "#2563eb";
                });

                closeButton.addEventListener("mouseleave", () => {
                    closeButton.style.backgroundColor = "#3b82f6";
                });

                // Menambahkan event ketika tombol "Daftar Sekarang" diklik
                button.addEventListener("click", () => {
                    overlay.style.display = "block";
                    notification.style.display = "block";
                });

                // Menambahkan event untuk menutup notifikasi
                closeButton.addEventListener("click", () => {
                    overlay.style.display = "none"; 
                    notification.style.display = "none";
                });
            </script>
        </div>
    </div>

    <!-- Jadwal Pelatihan -->
    <div class="border rounded-lg mt-6 p-6" style="border: 1px solid #a2a2a2;">
        <h2 class="text-lg font-semibold mb-4">Jadwal Pelatihan</h2>
        <div class="flex justify-between items-center bg-blue-50 border mb-4 px-4 py-2 rounded-lg" style="border: 1px solid #1E40AF;">
            <span>14 Jan 2025 - 14 Mar 2025</span>
            <span class="font-semibold">1000 kuota tersedia</span>
        </div>
    </div>
</div>
</body>