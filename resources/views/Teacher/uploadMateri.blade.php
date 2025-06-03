<title>{{ $pelatihan->name }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('components.navbarTeacher')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mx-auto px-4 py-8 mt-16">
    <h1 class="text-3xl font-bold">{{ $pelatihan->name }}</h1>
    <p class="text-gray-600 mt-2">{{ $pelatihan->deskripsi }}</p>

    <!-- Form Tambah Pertemuan -->
    <div class="bg-white p-4 rounded-lg shadow-md w-full">
        <h2 class="text-xl font-semibold mb-3">Tambah Pertemuan</h2>
        <form action="{{ route('teacher.storeBagian', ['pelatihanId' => $pelatihan->id]) }}" method="POST">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Pertemuan</label>
                <input type="text" name="nama_bagian" class="w-full p-2 border rounded-md" required>
            </div>
            <button type="submit"
                class="bg-green-600 text-white px-4 py-2 mt-2 rounded-md hover:bg-green-700 transition w-full">
                Tambah Pertemuan
            </button>
        </form>
    </div>

    <!-- List Pertemuan -->
    @if ($pelatihan->jenis === 'online')
        @foreach ($pelatihan->bagianPelatihans as $bagian)
            <div x-data="{ open: false }" class="mb-4 bg-white rounded-lg border shadow-md mt-4">
                <button @click="open = !open"
                    class="w-full text-left px-4 py-3 text-lg font-semibold hover:bg-gray-200 rounded-lg flex justify-between items-center">
                    <div>{{ $bagian->nama_bagian }}</div>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 15.75-7.5-7.5-7.5 7.5" />
                    </svg>
                </button>

                <div x-show="open" x-transition x-cloak class="px-4 py-2 space-y-2">
                    <!-- Form Upload Materi -->
                    <form action="{{ route('teacher.storeMateri', $bagian->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Judul Materi</label>
                            <input type="text" name="name" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Upload File (PDF/PPT)</label>
                            <input type="file" name="file" class="w-full p-2 border rounded-md"
                                accept=".pdf,.ppt,.pptx">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Link YouTube
                                (Opsional)
                            </label>
                            <input type="url" name="link" class="w-full p-2 border rounded-md"
                                placeholder="https://youtube.com/...">
                        </div>
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            Unggah Materi
                        </button>
                    </form>

                    <!-- Quiz Section -->
                    <h3 class="text-lg font-semibold mt-4">Quiz:</h3>
                    <ul class="space-y-2">
                        @forelse ($bagian->quizzes as $quiz)
                            <li class="flex items-center justify-between p-2 border rounded-md">
                                <a href="{{ route('teacher.showQuiz', $quiz->id) }}"
                                    class="text-blue-600 underline">{{ $quiz->title }}</a>
                                <button onclick="confirmDelete('{{ route('teacher.deleteQuiz', $quiz->id) }}')"
                                    class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </li>
                        @empty
                            <li class="text-gray-500 text-center">Belum ada quiz</li>
                        @endforelse
                    </ul>

                    <a href="{{ route('teacher.createQuiz', $bagian->id) }}"
                        class="block bg-green-600 text-white text-center px-4 py-2 mt-2 rounded-md hover:bg-green-700 transition">
                        Tambah Quiz
                    </a>
                    <!-- List Materi -->
                    <h3 class="text-lg font-semibold mt-4">Daftar Materi:</h3>
                    <ul class="space-y-2">
                        @forelse ($bagian->materis as $materi)
                            <li class="flex items-center justify-between p-2 border rounded-md">
                                <!-- Nama materi di sebelah kiri -->
                                <div class="flex items-center space-x-1">
                                    <span class="font-medium">{{ $materi->name }}</span>
                                </div>
                                <button onclick="deleteMateri('{{ route('teacher.deleteMateri', $materi->id) }}')"
                                    class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </li>
                        @empty
                            <li class="text-gray-500 text-center">Belum ada materi</li>
                        @endforelse
                    </ul>

                    <!-- Tombol Hapus Bagian -->
                    <button onclick="confirmDelete('{{ route('teacher.deleteBagian', $bagian->id) }}')"
                        class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition w-full mt-4">
                        Hapus Bagian Ini
                    </button>
                </div>
            </div>
        @endforeach
    @endif
</div>

<script>
    function confirmDelete(url) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Semua materi di dalam bagian ini akan terhapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement("form");
                form.action = url;
                form.method = "POST";

                let csrf = document.createElement("input");
                csrf.type = "hidden";
                csrf.name = "_token";
                csrf.value = "{{ csrf_token() }}";

                let method = document.createElement("input");
                method.type = "hidden";
                method.name = "_method";
                method.value = "DELETE";

                form.appendChild(csrf);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function deleteMateri(url) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Materi ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement("form");
                form.action = url;
                form.method = "POST";

                let csrf = document.createElement("input");
                csrf.type = "hidden";
                csrf.name = "_token";
                csrf.value = "{{ csrf_token() }}";

                let method = document.createElement("input");
                method.type = "hidden";
                method.name = "_method";
                method.value = "DELETE";

                form.appendChild(csrf);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@include('components.footer')
