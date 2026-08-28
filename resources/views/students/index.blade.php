@extends('layouts.app')

@section('title', 'Registered Students')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Registered Students</h2>
        <p class="text-slate-500 text-sm mt-1">Total: {{ $students->count() }} student(s) registered</p>
    </div>
    <a href="{{ route('students.create') }}" class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-md transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Register New Student
    </a>
</div>

@if ($students->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-12 text-center">
        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <h3 class="text-lg font-semibold text-slate-700">No students yet</h3>
        <p class="text-slate-500 text-sm mt-1">Get started by registering the first student.</p>
        <a href="{{ route('students.create') }}" class="inline-block mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl text-sm font-semibold">Register Now</a>
    </div>
@else
    <!-- Desktop Table -->
    <div class="hidden md:block bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b">
                    <tr class="text-left text-slate-600">
                        <th class="px-6 py-3 font-semibold">Profile</th>
                        <th class="px-6 py-3 font-semibold">Student ID</th>
                        <th class="px-6 py-3 font-semibold">Name</th>
                        <th class="px-6 py-3 font-semibold">Email</th>
                        <th class="px-6 py-3 font-semibold">Program</th>
                        <th class="px-6 py-3 font-semibold">Year</th>
                        <th class="px-6 py-3 font-semibold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($students as $student)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-3">
                                <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="{{ $student->full_name }}" class="w-10 h-10 rounded-full object-cover border border-slate-200">
                            </td>
                            <td class="px-6 py-3 font-mono text-slate-700 font-medium">{{ $student->student_id }}</td>
                            <td class="px-6 py-3 font-medium text-slate-800">{{ $student->full_name }}</td>
                            <td class="px-6 py-3 text-slate-600">{{ $student->email }}</td>
                            <td class="px-6 py-3"><span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">{{ $student->program }}</span></td>
                            <td class="px-6 py-3 text-slate-600">{{ $student->year_level }}</td>
                            <td class="px-6 py-3 text-right">
                                <a href="{{ route('students.show', $student) }}" class="inline-flex items-center gap-1 bg-slate-900 hover:bg-black text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Cards -->
    <div class="md:hidden grid gap-4">
        @foreach ($students as $student)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 flex gap-4">
                <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="{{ $student->full_name }}" class="w-16 h-16 rounded-xl object-cover border border-slate-200 flex-shrink-0">
                <div class="flex-1 min-w-0">
                    <p class="font-mono text-xs text-indigo-600 font-semibold">{{ $student->student_id }}</p>
                    <h3 class="font-semibold text-slate-800 truncate">{{ $student->full_name }}</h3>
                    <p class="text-xs text-slate-500 truncate">{{ $student->email }}</p>
                    <div class="flex items-center gap-2 mt-2 flex-wrap">
                        <span class="px-2 py-1 bg-indigo-50 text-indigo-700 border border-indigo-100 rounded-full text-xs font-medium">{{ $student->program }}</span>
                        <span class="text-xs text-slate-500">{{ $student->year_level }}</span>
                    </div>
                    <a href="{{ route('students.show', $student) }}" class="mt-3 inline-flex text-xs font-semibold text-white bg-slate-900 px-3 py-1.5 rounded-lg">View Profile →</a>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
