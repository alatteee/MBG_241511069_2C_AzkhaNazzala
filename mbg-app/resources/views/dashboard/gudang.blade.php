<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Gudang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-100 p-6">

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">
        <h1 class="text-2xl font-bold mb-4">Halo, {{ $user->name }} 👋</h1>
        <p class="mb-4">Anda login sebagai <span class="font-semibold text-blue-600">Petugas Gudang</span>.</p>

        <ul class="list-disc ml-6 mb-6">
            <li><a href="{{ route('bahan.index') }}" class="text-blue-500 hover:underline">Kelola Bahan Baku</a></li>
            <li><a href="{{ route('permintaan.index') }}" class="text-blue-500 hover:underline">Lihat Permintaan
                    Dapur</a></li>
        </ul>

        <form id="logoutForm" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Logout
            </button>
        </form>
    </div>
    <!-- Modal Logout -->
    <div id="logoutModal" class="hidden fixed inset-0 bg-gray-900/60 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Konfirmasi Logout</h2>
            <p class="mb-4">Apakah Anda yakin ingin logout?</p>
            <div class="flex justify-end space-x-2">
                <button id="cancelLogout" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button id="confirmLogout"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Logout</button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
