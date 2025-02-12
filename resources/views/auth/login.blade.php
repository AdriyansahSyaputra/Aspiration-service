<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>

<body class="bg-gradient-to-r from-blue-50 via-white to-blue-50 min-h-screen flex items-center justify-center px-4">

    <div class="max-w-md w-full bg-white rounded-lg shadow-xl p-8 space-y-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang!</h1>
            <p class="text-gray-600 mt-2">Masuk ke akun anda</p>
        </div>

        <form action="{{ route('login.login') }}" method="POST" class="space-y-6">
            @csrf
            <div class="relative">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email anda"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password anda"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
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

            @session('error')
                <p class="text-red-500 text-sm">{{ session('error') }}</p>
            @endsession

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label for="remember" class="text-sm text-gray-700">Ingat saya</label>
                </div>

                <div>
                    <a href="/lupa-password" class="text-sm text-blue-500 hover:underline">Lupa Password?</a>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded-md shadow-md focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">Login</button>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-600">Belum memiliki akun? <a href="/register"
                    class="text-blue-500 hover:underline">Register</a></p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
        }
    </script>

</body>


</html>
