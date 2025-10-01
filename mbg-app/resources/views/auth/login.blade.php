<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login MBG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#176B87] via-[#86B6F6] to-[#EEF5FF] font-sans">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-2xl">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Login Aplikasi MBG</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form id="loginForm" method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <span class="text-red-500 text-sm mt-1 hidden" id="emailError"></span>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <span class="text-red-500 text-sm mt-1 hidden" id="passwordError"></span>
            </div>
            <!-- Submit -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>
        </form>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
