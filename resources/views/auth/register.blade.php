<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>

<body class="bg-gradient-to-r from-blue-50 via-white to-blue-50 min-h-screen flex items-center justify-center px-4">

    <div class="max-w-md w-full bg-white rounded-lg shadow-xl p-8 space-y-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800">Registrasi</h1>
            <p class="text-gray-600 mt-2">Buat akun anda sekarang!</p>
        </div>

        <form action="{{ route('register.store') }}" method="POST" class="space-y-6">
            @csrf
            {{-- Nama Lengkap --}}
            <div class="relative">
                <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="fullName" name="fullName" value="{{ old('fullName') }}"
                    placeholder="Masukkan Nama Lengkap anda"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('fullName')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="relative">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    placeholder="Masukkan email anda"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">

                <button type="button" id="sendOtpButton"
                    class="absolute right-0 top-7 bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600">Kirim
                    OTP</button>

                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- OTP --}}
            <div class="relative">
                <label for="verification" class="block text-sm font-medium text-gray-700 mb-1">Kode Verifikasi</label>
                <input type="text" id="verification" name="verification"
                    placeholder="Masukkan OTP verifikasi"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('verification')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password anda"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <button type="button" onclick="togglePassword()"
                    class="absolute right-3 top-10 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            {{-- Confirm Password --}}
            <div class="relative">
                <label for="password_confirrmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                    Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Masukkan password anda"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">

                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <button type="button" onclick="toggleConfirmPassword()"
                    class="absolute right-3 top-10 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>


            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded-md shadow-md focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">Register</button>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-600">Sudah punya akun? <a href="/login"
                    class="text-blue-500 hover:underline">Login</a></p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
        }

        function toggleConfirmPassword() {
            const passwordInput = document.getElementById('password_confirmation');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
        }

        //  For Otp
        document.getElementById('sendOtpButton').addEventListener('click', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;

            if (!email) {
                alert('Masukkan email terlebih dahulu.');
                return;
            }

            fetch("{{ route('send.otp') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => alert(data.message))
                .catch(error => alert('Terjadi kesalahan, coba lagi.'));
        });
    </script>

</body>


</html>
