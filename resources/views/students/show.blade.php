@extends('layouts.app')

@section('title', $student->full_name)
@section('page_title', 'Student Profile')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <a href="{{ route('students.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-green-600 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Students
        </a>
        <span class="hidden sm:inline text-slate-300">|</span>
        <a href="{{ route('students.create') }}" class="inline-flex items-center gap-2 text-sm text-green-600 hover:text-indigo-700 font-semibold">+ Register Another Student</a>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <!-- Header Banner -->
        <div class="h-32 bg-gradient-to-r from-green-600 to-emerald-600 relative">
            <div class="absolute -bottom-12 left-6 sm:left-8 flex items-end gap-4">
                <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="{{ $student->full_name }}" class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl object-cover border-4 border-white shadow-lg bg-white">
                <div class="pb-2 hidden sm:block">
                    <h2 class="text-xl font-bold text-white drop-shadow">{{ $student->full_name }}</h2>
                    <p class="text-green-100 text-sm font-mono">{{ $student->student_id }}</p>
                </div>
            </div>
        </div>

        <!-- Name for mobile -->
        <div class="pt-16 sm:pt-6 px-6 sm:pl-40 pb-6 sm:pb-6 border-b border-slate-100">
            <div class="sm:hidden">
                <h2 class="text-xl font-bold text-slate-800">{{ $student->full_name }}</h2>
                <p class="text-sm font-mono text-green-600 font-semibold">{{ $student->student_id }}</p>
            </div>
            <div class="hidden sm:flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 sm:hidden">{{ $student->full_name }}</h2>
                    <p class="text-sm text-slate-500">Registered on {{ $student->created_at->format('F j, Y — g:i A') }}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Active</span>
            </div>
            <p class="sm:hidden text-xs text-slate-500 mt-1">Registered on {{ $student->created_at->format('F j, Y') }}</p>
        </div>

        <!-- Details Grid -->
        <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-5">
                <div>
                    <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <span class="w-6 h-6 bg-green-50 rounded-lg flex items-center justify-center"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></span>
                        Personal Information
                    </h3>
                    <dl class="space-y-3">
                        <div class="flex justify-between sm:block">
                            <dt class="text-xs text-slate-500">Student ID</dt>
                            <dd class="text-sm font-mono font-semibold text-slate-800">{{ $student->student_id }}</dd>
                        </div>
                        <div class="flex justify-between sm:block">
                            <dt class="text-xs text-slate-500">Complete Name</dt>
                            <dd class="text-sm font-semibold text-slate-800">{{ $student->full_name }}</dd>
                        </div>
                        <div class="flex justify-between sm:block">
                            <dt class="text-xs text-slate-500">Date of Birth</dt>
                            <dd class="text-sm font-medium text-slate-800">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('F j, Y') }}</dd>
                        </div>
                        <div class="flex justify-between sm:block">
                            <dt class="text-xs text-slate-500">Gender</dt>
                            <dd class="text-sm font-medium text-slate-800"><span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">{{ $student->gender }}</span></dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <span class="w-6 h-6 bg-emerald-50 rounded-lg flex items-center justify-center"><svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></span>
                        Contact Information
                    </h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-xs text-slate-500">Email Address</dt>
                            <dd class="text-sm font-medium text-slate-800 break-all">{{ $student->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-slate-500">Mobile Number</dt>
                            <dd class="text-sm font-medium text-slate-800">{{ $student->mobile_number }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-slate-500">Address</dt>
                            <dd class="text-sm font-medium text-slate-800 leading-relaxed">{{ $student->address }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="md:col-span-2 pt-2">
                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <span class="w-6 h-6 bg-green-50 rounded-lg flex items-center justify-center"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></span>
                    Academic Information
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <p class="text-xs text-slate-500">Program</p>
                        <p class="text-sm font-bold text-slate-800 mt-1">{{ $student->program }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <p class="text-xs text-slate-500">Year Level</p>
                        <p class="text-sm font-bold text-slate-800 mt-1">{{ $student->year_level }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="px-6 sm:px-8 py-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row gap-3 sm:justify-between">
            <a href="{{ route('students.index') }}" class="inline-flex justify-center items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-semibold text-sm hover:bg-white transition">Back to Students</a>
            <a href="{{ route('students.create') }}" class="inline-flex justify-center items-center gap-2 px-5 py-2.5 rounded-xl bg-green-600 text-white font-semibold text-sm hover:bg-green-700 shadow transition">Register Another Student</a>
        </div>
    </div>
</div>
@endsection
