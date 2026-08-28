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
<body class="bg-slate-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h1 class="text-lg sm:text-xl font-bold leading-none">College of Information Technology</h1>
                        <p class="text-indigo-100 text-xs sm:text-sm">Student Registration System</p>
                    </div>
                </div>
                <nav class="hidden sm:flex items-center gap-2">
                    <a href="{{ route('students.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('students.index') ? 'bg-white text-indigo-600' : 'text-white hover:bg-white/20' }}">Students</a>
                    <a href="{{ route('students.create') }}" class="px-4 py-2 bg-white text-indigo-600 rounded-lg text-sm font-semibold hover:bg-indigo-50 transition shadow">+ Register</a>
                </nav>
                <!-- Mobile menu button -->
                <div class="sm:hidden flex gap-2">
                    <a href="{{ route('students.create') }}" class="px-3 py-2 bg-white text-indigo-600 rounded-lg text-sm font-semibold">+ Register</a>
                </div>
            </div>
            <div class="sm:hidden pb-4">
                <a href="{{ route('students.index') }}" class="text-indigo-100 text-sm underline">View All Students</a>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 mt-6 space-y-3">
        @if (session('success'))
            <div id="flash-success" class="flex items-start justify-between bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl shadow-sm">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('flash-success').remove()" class="ml-4 text-emerald-600 hover:text-emerald-800">&times;</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-sm">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
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
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <p class="text-center text-sm text-slate-500">&copy; {{ date('Y') }} College of Information Technology — Student Registration System</p>
        </div>
    </footer>
</body>
</html>
