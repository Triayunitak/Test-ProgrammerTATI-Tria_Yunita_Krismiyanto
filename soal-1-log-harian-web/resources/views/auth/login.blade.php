<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Daily Log</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 mx-4">
        
        <div class="flex justify-center mb-6">
            <img src="{{ asset('LOGO ONLY.png') }}" alt="Logo App" class="w-24 h-auto object-contain">
        </div>

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Login</h2>

        @if ($errors->any())
        <div class="mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded text-sm">
            <p>{{ $errors->first() }}</p>
        </div>
        @endif

        <button type="button" class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-lg py-2.5 text-gray-700 font-medium hover:bg-gray-50 transition mb-6">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
            Login with Google
        </button>

        <div class="relative flex items-center justify-center mb-6">
            <hr class="w-full border-gray-200">
            <span class="absolute bg-white px-3 text-xs text-gray-400">or Login with Email</span>
        </div>

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" 
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#5B3AFF] focus:border-[#5B3AFF] outline-none transition text-gray-800 placeholder-gray-400"
                    placeholder="ex. kabid1@example.com" required value="{{ old('email') }}">
            </div>

            <div class="mb-8 relative">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" 
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#5B3AFF] focus:border-[#5B3AFF] outline-none transition text-gray-800 placeholder-gray-400"
                    placeholder="ex. password" required>
                
                <button type="button" onclick="togglePassword()" class="absolute right-3 top-9 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>

            <button type="submit" class="w-full bg-[#5B3AFF] hover:opacity-90 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200">
                Login
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-gray-400">
            &copy; 2025 Daily Log System
        </div>

    </div>

    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>