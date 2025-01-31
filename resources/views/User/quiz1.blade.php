<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@include('components.navbar')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Akhir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black">
    <div class="max-w-6xl mx-auto mt-10 p-6">
        <!-- Judul -->
        <h1 class="text-3xl font-bold">Evaluasi Akhir</h1>

        <!-- Kontainer utama -->
        <div class="flex mt-6 gap-6">
            <!-- Kotak soal (¾ dari lebar) -->
            <div class="w-3/4 p-6 border rounded-lg">
                <h2 class="text-xl font-semibold">Soal 1</h2>
                <p class="mt-2">
                    Jika Anda ingin membuat algoritma untuk menentukan bilangan terbesar antara dua angka, langkah mana yang tidak diperlukan?
                </p>

                <!-- Pilihan Jawaban -->
                <div class="mt-4 space-y-3">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="soal1" class="w-5 h-5 border-gray-400">
                        <span>A. Membandingkan kedua angka.</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="soal1" class="w-5 h-5 border-gray-400">
                        <span>B. Menentukan angka mana yang lebih besar.</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="soal1" class="w-5 h-5 border-gray-400">
                        <span>C. Mencetak angka yang lebih besar.</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="soal1" class="w-5 h-5 border-gray-400">
                        <span>D. Menghitung jumlah kedua angka.</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="soal1" class="w-5 h-5 border-gray-400">
                        <span>E. Memasukkan kedua angka sebagai input.</span>
                    </label>
                </div>

                <!-- Tombol navigasi -->
                <div class="flex justify-between items-center mt-10">
                    <button class="px-4 py-2 border rounded-lg flex items-center space-x-2">
                        <span>←</span>
                        <span>Sebelumnya</span>
                    </button>
                    <button class="px-4 py-2 border rounded-lg flex items-center space-x-2">
                        <span>Selanjutnya</span>
                        <span>→</span>
                    </button>
                </div>
            </div>

            <!-- Kotak sidebar (waktu + nomor soal) -->
            <div class="w-1/4">
                <!-- Kotak Waktu Tersisa -->
                <div class="p-3 border rounded-lg text-center mb-4">
                    <span>Waktu tersisa 1:29:00</span>
                </div>

                <!-- Kotak Nomor Soal -->
                <div class="p-4 border rounded-lg">
                    <h3 class="text-lg font-semibold">Soal</h3>
                    <div class="grid grid-cols-5 gap-2 mt-2">
                        <!-- Nomor soal dengan garis di atas -->
                        <template id="soal-template">
                            <div class="relative flex justify-center items-center border p-2 w-10 h-10">
                                <div class="absolute top-0 left-0 w-full border-t"></div>
                                <span></span>
                            </div>
                        </template>

                        <script>
                            const soalContainer = document.querySelector(".grid");
                            for (let i = 1; i <= 20; i++) {
                                const template = document.getElementById("soal-template").content.cloneNode(true);
                                template.querySelector("span").innerText = i;
                                soalContainer.appendChild(template);
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
