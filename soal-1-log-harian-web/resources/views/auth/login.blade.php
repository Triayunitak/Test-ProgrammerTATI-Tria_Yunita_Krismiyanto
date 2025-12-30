<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Daily Log System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <div class="flex justify-center mb-6">
            <div class="bg-purple-600 p-3 rounded-full">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
        </div>
        
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Sign in to your account</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email_user" class="block text-sm font-medium text-gray-700">Email address</label>
                <div class="mt-1">
                    <input id="email_user" name="email_user" type="email" autocomplete="email" required 
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                        value="{{ old('email_user') }}">
                </div>
                @error('email_user')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1">
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" 
                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-purple-600 hover:text-purple-500">Forgot your password?</a>
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Sign in
                </button>
            </div>
        </form>

        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>

            <div class="mt-6">
                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <span class="sr-only">Sign in with Google</span>
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                         <path d="M21.35 11.1H12v2.8h5.36c-.23 1.2-1.07 2.22-2.28 2.87v2.39h3.7c2.16-2 3.4-4.94 3.4-8.06 0-.8-.07-1.57-.19-2.31z" fill="#4285F4" />
                         <path d="M12 21c2.6 0 4.79-.86 6.38-2.34l-3.7-2.39c-.86.58-1.96.92-3.18.92-2.45 0-4.52-1.66-5.26-3.88H2.43v2.44C4.04 18.96 7.74 21 12 21z" fill="#34A853" />
                         <path d="M6.74 13.31c-.19-.57-.3-1.18-.3-1.81s.11-1.24.3-1.81V7.25H2.43c-.87 1.73-1.37 3.69-1.37 5.75s.5 4.02 1.37 5.75l4.31-2.44z" fill="#FBBC05" />
                         <path d="M12 4.75c1.42 0 2.7.49 3.7 1.44l2.79-2.79C16.79 1.63 14.6 0 12 0 7.74 0 4.04 2.04 2.43 5.25l4.31 2.44c.74-2.22 2.81-3.88 5.26-3.88z" fill="#EA4335" />
                    </svg>
                    <span class="ml-2">Google</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
