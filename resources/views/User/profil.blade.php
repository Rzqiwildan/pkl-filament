<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D-STEP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function enableEditing() {
            document.querySelectorAll('input').forEach(input => {
                input.removeAttribute('disabled');
                input.classList.add('border-blue-500');
            });
            document.getElementById('change-btn').removeAttribute('disabled');
        }

        function saveData() {
            document.querySelectorAll('input').forEach(input => {
                input.setAttribute('disabled', 'true');
                input.classList.remove('border-blue-500');
                input.classList.add('border-gray-300');
            });
            document.getElementById('change-btn').setAttribute('disabled', 'true');
        }

        function triggerFileInput() {
            document.getElementById('file-input').click();
        }

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    cropImage(e.target.result);
                }
                reader.readAsDataURL(file);
            }
        }

        function cropImage(imageSrc) {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const img = new Image();
            img.src = imageSrc;
            img.onload = function() {
                const size = Math.min(img.width, img.height);
                canvas.width = 128;
                canvas.height = 128;
                ctx.drawImage(img, (img.width - size) / 2, (img.height - size) / 2, size, size, 0, 0, 128, 128);
                document.getElementById('profile-img').src = canvas.toDataURL();
            }
        }
    </script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Profile Section -->
    <main class="flex-1 flex items-center justify-center py-16">
        <div class="bg-white shadow-lg rounded-lg p-6 w-[90%] max-w-[600px] mx-auto mt-12">
            <h2 class="text-2xl font-semibold mb-6 text-center">Profile</h2>
            <div class="flex flex-col items-center">
                <img id="profile-img" class="w-32 h-32 rounded-full object-cover" 
                     src="https://i.pinimg.com/736x/2d/9f/8d/2d9f8d4e12b1aceb0d77109f753e46cf.jpg" alt="Profile">
                <input type="file" id="file-input" class="hidden" accept="image/*" onchange="previewImage(event)">
                <button id="change-btn" class="mt-4 px-4 py-1 border border-gray-300 rounded-lg text-sm" onclick="triggerFileInput()" disabled>Change</button>
            </div>
            <div class="mt-6">
                <div class="flex flex-col space-y-4">
                    <div class="flex-1">
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-sm font-medium w-24">NIK</label>
                        <input type="text" class="flex-1 border border-gray-300 rounded-lg p-2" value="{{ $nik }}" placeholder="Masukkan NIK Anda" disabled>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-sm font-medium w-24">Nama</label>
                        <input type="text" class="flex-1 border border-gray-300 rounded-lg p-2" value="Lisa Doe" placeholder="Masukkan Nama Anda" disabled>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-sm font-medium w-24">Email</label>
                        <input type="email" class="flex-1 border border-gray-300 rounded-lg p-2" value="support@gmail.com" placeholder="Masukkan Email Anda" disabled>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-sm font-medium w-24">No Telepon</label>
                        <input type="text" class="flex-1 border border-gray-300 rounded-lg p-2" value="+1 928 56 66 777" placeholder="Masukkan No Telpon Anda" disabled>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-sm font-medium w-24">Tanggal Lahir</label>
                        <input type="date" class="flex-1 border border-gray-300 rounded-lg p-2" placeholder="Masukkan Tanggal Lahir Anda" disabled>
                    </div>

                    <div class="mt-6 flex justify-end space-x-2">
                        <button onclick="enableEditing()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Edit</button>
                        <button onclick="saveData()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Save</button>
                    </div>
                    </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('components.footer')
</body>
</html>
