<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student Registration System') - College of Information Technology</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>body{font-family:'Inter',sans-serif;}</style>
    @endif
</head>
<body class="bg-slate-50 min-h-screen">
    <!-- Mobile sidebar backdrop -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/50 z-20 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-gradient-to-b from-green-800 to-green-900 text-white flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl">
        <!-- Logo -->
        <div class="px-6 py-6 border-b border-green-700/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow">
                    <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <h1 class="font-bold text-sm leading-none">College of IT</h1>
                    <p class="text-green-200 text-xs mt-1">Student Registration</p>
                </div>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">
            <p class="px-3 mb-3 text-xs font-semibold text-green-300 uppercase tracking-wider">Menu</p>
            <a href="{{ route('students.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('students.index') ? 'bg-white text-green-800 shadow' : 'text-green-100 hover:bg-green-700/50 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Students
                <span class="ml-auto text-xs bg-green-700 text-green-100 px-2 py-0.5 rounded-full">{{ \App\Models\Student::count() }}</span>
            </a>
            <a href="{{ route('students.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('students.create') ? 'bg-white text-green-800 shadow' : 'text-green-100 hover:bg-green-700/50 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Register Student
            </a>
            <div class="pt-4 mt-4 border-t border-green-700/50">
                <p class="px-3 mb-2 text-xs font-semibold text-green-300 uppercase tracking-wider">System</p>
                <div class="px-3 py-2 rounded-xl bg-green-900/50 border border-green-700/50">
                    <p class="text-xs text-green-200">Academic Year</p>
                    <p class="text-sm font-semibold text-white">2025 — 2026</p>
                    <p class="text-xs text-green-300 mt-1">College of Information Technology</p>
                </div>
            </div>
        </nav>

        <!-- Footer -->
        <div class="px-4 py-4 border-t border-green-700/50">
            <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-green-700/30">
                <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-green-700 font-bold text-sm">IT</div>
                <div>
                    <p class="text-sm font-medium text-white">Admin Panel</p>
                    <p class="text-xs text-green-200">Registrar</p>
                </div>
            </div>
            <p class="text-center text-xs text-green-400 mt-3">&copy; {{ date('Y') }} CIT</p>
        </div>
    </aside>

    <!-- Main wrapper -->
    <div class="lg:pl-64 flex flex-col min-h-screen">
        <!-- Topbar -->
        <header class="sticky top-0 z-10 bg-white border-b border-slate-200 shadow-sm">
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 py-3">
                <div class="flex items-center gap-3">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl hover:bg-slate-100 text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="hidden sm:block">
                        <h2 class="text-lg font-bold text-slate-800">@yield('page_title', 'Dashboard')</h2>
                        <p class="text-xs text-slate-500 hidden lg:block">Manage student registrations</p>
                    </div>
                    <h2 class="sm:hidden font-bold text-slate-800">@yield('page_title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center gap-2">
                    <span class="hidden sm:inline-flex items-center gap-2 text-xs text-slate-500 bg-slate-100 px-3 py-1.5 rounded-full">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        System Online
                    </span>
                    <a href="{{ route('students.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span class="hidden sm:inline">New Registration</span>
                        <span class="sm:hidden">New</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-4 sm:px-6 lg:px-8 mt-6 space-y-3">
            @if (session('success'))
                <div id="flash-success" class="flex items-start justify-between bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl shadow-sm">
                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Success</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('flash-success').remove()" class="ml-4 text-green-600 hover:text-green-800 p-1 hover:bg-green-100 rounded-lg">&times;</button>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-sm">
                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Please fix the following errors:</p>
                            <ul class="list-disc list-inside text-sm mt-1 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Main -->
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
            @yield('content')
        </main>

        <footer class="bg-white border-t mt-auto">
            <div class="px-4 sm:px-6 lg:px-8 py-4">
                <p class="text-center text-sm text-slate-500">&copy; {{ date('Y') }} College of Information Technology — Student Registration System <span class="hidden sm:inline">• Professional Green Edition with Sidebar</span></p>
            </div>
        </footer>
    </div>

    <script>
        function toggleSidebar() {
            const sb = document.getElementById('sidebar');
            const bd = document.getElementById('sidebar-backdrop');
            sb.classList.toggle('-translate-x-full');
            bd.classList.toggle('hidden');
        }
    </script>
</body>
</html>
