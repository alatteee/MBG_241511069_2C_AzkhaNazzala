<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MBG Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-white">

    <div class="flex h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-white flex flex-col">
            <div class="p-6 font-bold text-2xl text-[#176B87]">MBG</div>
            <nav class="flex-1 p-4 space-y-2 text-gray-600">

                {{-- Menu Gudang --}}
                @if (auth()->user()->role === 'gudang')
                    <a href="{{ route('dashboard.gudang') }}"
                        class="flex items-center px-4 py-3 rounded-full transition shadow-sm
                        {{ request()->routeIs('dashboard.gudang') ? 'bg-[#176B87] text-white shadow-md' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-house mr-3"></i> Dashboard
                    </a>
                    <a href="{{ route('bahan.index') }}"
                        class="flex items-center px-4 py-3 rounded-full transition shadow-sm
                        {{ request()->routeIs('bahan.*') ? 'bg-[#176B87] text-white shadow-md' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-box mr-3"></i> Kelola Bahan
                    </a>
                    <a href="{{ route('admin.permintaan.index') }}"
                        class="flex items-center px-4 py-3 rounded-full transition shadow-sm
                        {{ request()->routeIs('admin.permintaan.*') ? 'bg-[#176B87] text-white shadow-md' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-list-check mr-3"></i> Permintaan Dapur
                    </a>
                @endif

                {{-- Menu Dapur --}}
                @if (auth()->user()->role === 'dapur')
                    <a href="{{ route('dashboard.dapur') }}"
                        class="flex items-center px-4 py-3 rounded-full transition shadow-sm
                        {{ request()->routeIs('dashboard.dapur') ? 'bg-[#176B87] text-white shadow-md' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-house mr-3"></i> Dashboard
                    </a>
                    <a href="{{ route('permintaan.index') }}"
                        class="flex items-center px-4 py-3 rounded-full transition shadow-sm
                        {{ request()->routeIs('permintaan.*') ? 'bg-[#176B87] text-white shadow-md' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-cart-plus mr-3"></i> Permintaan Bahan
                    </a>
                @endif

            </nav>
        </aside>

        {{-- Main --}}
        <div class="flex-1 flex flex-col">

            {{-- Topbar --}}
            <header class="flex items-center justify-between bg-white px-6 py-4">
                <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                <div class="relative">
                    <button id="adminUserMenu" class="flex items-center space-x-2 px-4 py-2 rounded hover:bg-gray-100">
                        <div class="text-right">
                            <div class="font-semibold">{{ auth()->user()->name }}</div>
                            <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
                        </div>
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="adminDropdown" class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg hidden">
                        <button type="button" onclick="openLogoutModal()"
                            class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-50">
                            Logout
                        </button>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="p-6 flex-1 overflow-y-auto">
                @if (session('success'))
                    <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-700 border border-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-700 border border-red-300">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Modal Konfirmasi Logout --}}
    <div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Logout</h2>
            <p class="text-gray-600 mb-6">Apakah kamu yakin ingin keluar dari akun ini?</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeLogoutModal()"
                    class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Batal
                </button>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>


    <script>
        const dropdownBtn = document.getElementById("adminUserMenu");
        const dropdown = document.getElementById("adminDropdown");

        dropdownBtn?.addEventListener("click", () => {
            dropdown.classList.toggle("hidden");
        });

        function openLogoutModal() {
            document.getElementById("logoutModal").classList.remove("hidden");
        }

        function closeLogoutModal() {
            document.getElementById("logoutModal").classList.add("hidden");
        }
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
