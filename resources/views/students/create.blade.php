@extends('layouts.app')

@section('title', 'Register Student')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('students.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-indigo-600 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Students
        </a>
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-3">Student Registration</h2>
        <p class="text-slate-500 text-sm mt-1">Fill in the form below to register a new student. Fields marked with <span class="text-red-500">*</span> are required.</p>
    </div>

    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Personal Information -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center gap-3">
                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-800">Personal Information</h3>
                    <p class="text-xs text-slate-500">Student identity details</p>
                </div>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div class="md:col-span-2">
                    <label for="student_id" class="block text-sm font-medium text-slate-700 mb-1">Student ID <span class="text-red-500">*</span></label>
                    <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}" placeholder="e.g., 2024-0001" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('student_id') ? 'border-red-300 bg-red-50 focus:ring-red-500 focus:border-red-500' : 'border-slate-300 focus:ring-indigo-500 focus:border-indigo-500' }} focus:ring-2 outline-none transition text-sm">
                    @error('student_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="first_name" class="block text-sm font-medium text-slate-700 mb-1">First Name <span class="text-red-500">*</span></label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Juan" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('first_name') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
                    @error('first_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="middle_name" class="block text-sm font-medium text-slate-700 mb-1">Middle Name <span class="text-slate-400 font-normal">(Optional)</span></label>
                    <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" placeholder="Santos" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('middle_name') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
                    @error('middle_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-slate-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Dela Cruz" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('last_name') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
                    @error('last_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-slate-700 mb-1">Date of Birth <span class="text-red-500">*</span></label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('date_of_birth') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
                    @error('date_of_birth')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="md:col-span-2">
                    <label for="gender" class="block text-sm font-medium text-slate-700 mb-1">Gender <span class="text-red-500">*</span></label>
                    <select id="gender" name="gender" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('gender') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm bg-white">
                        <option value="">Select gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-800">Contact Information</h3>
                    <p class="text-xs text-slate-500">How we can reach the student</p>
                </div>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="juan.delacruz@example.com" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
                    @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="mobile_number" class="block text-sm font-medium text-slate-700 mb-1">Mobile Number <span class="text-red-500">*</span></label>
                    <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="09123456789" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('mobile_number') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
                    @error('mobile_number')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-800">Academic Information</h3>
                    <p class="text-xs text-slate-500">Program and year level</p>
                </div>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label for="program" class="block text-sm font-medium text-slate-700 mb-1">Program <span class="text-red-500">*</span></label>
                    <select id="program" name="program" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('program') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm bg-white">
                        <option value="">Select program</option>
                        <option value="BSIT" {{ old('program') == 'BSIT' ? 'selected' : '' }}>BSIT — Bachelor of Science in Information Technology</option>
                        <option value="BSCS" {{ old('program') == 'BSCS' ? 'selected' : '' }}>BSCS — Bachelor of Science in Computer Science</option>
                        <option value="BSIS" {{ old('program') == 'BSIS' ? 'selected' : '' }}>BSIS — Bachelor of Science in Information Systems</option>
                        <option value="ACT" {{ old('program') == 'ACT' ? 'selected' : '' }}>ACT — Associate in Computer Technology</option>
                    </select>
                    @error('program')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="year_level" class="block text-sm font-medium text-slate-700 mb-1">Year Level <span class="text-red-500">*</span></label>
                    <select id="year_level" name="year_level" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('year_level') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm bg-white">
                        <option value="">Select year level</option>
                        <option value="1st Year" {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                        <option value="2nd Year" {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3rd Year" {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4th Year" {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                    </select>
                    @error('year_level')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center gap-3">
                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-800">Address</h3>
                    <p class="text-xs text-slate-500">Complete residential address</p>
                </div>
            </div>
            <div class="p-6">
                <label for="address" class="block text-sm font-medium text-slate-700 mb-1">Complete Address <span class="text-red-500">*</span></label>
                <textarea id="address" name="address" rows="3" placeholder="House No., Street, Barangay, City/Municipality, Province" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('address') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm resize-none">{{ old('address') }}</textarea>
                @error('address')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Profile Picture -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center gap-3">
                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-800">Profile Picture</h3>
                    <p class="text-xs text-slate-500">JPG, JPEG, PNG up to 2MB</p>
                </div>
            </div>
            <div class="p-6">
                <label for="profile_picture" class="block text-sm font-medium text-slate-700 mb-1">Upload Photo <span class="text-red-500">*</span></label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/jpeg,image/png,image/jpg" class="w-full px-3 py-2.5 rounded-xl border {{ $errors->has('profile_picture') ? 'border-red-300 bg-red-50' : 'border-slate-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="mt-2 text-xs text-slate-500">Accepted formats: JPG, JPEG, PNG. Max size: 2MB.</p>
                @error('profile_picture')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
            <button type="reset" class="px-6 py-3 rounded-xl border border-slate-300 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition order-2 sm:order-1">Clear Form</button>
            <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 text-white font-semibold text-sm hover:from-indigo-700 hover:to-blue-700 shadow-lg transition order-1 sm:order-2">Register Student</button>
        </div>
    </form>
</div>
@endsection
