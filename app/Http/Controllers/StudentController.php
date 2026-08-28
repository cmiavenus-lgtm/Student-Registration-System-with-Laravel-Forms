<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:students,email',
            'mobile_number' => 'required|numeric',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'program' => 'required|string',
            'year_level' => 'required|string',
            'address' => 'required|string',
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'student_id.required' => 'Student ID is required.',
            'student_id.unique' => 'This Student ID is already registered.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'mobile_number.numeric' => 'Mobile number must be numeric.',
            'profile_picture.image' => 'Profile picture must be an image.',
            'profile_picture.mimes' => 'Profile picture must be JPG, JPEG, or PNG.',
            'profile_picture.max' => 'Profile picture must not exceed 2MB.',
        ]);

        // Secure file upload: store in storage/app/public/profile_pictures, only path saved to DB
        // Requires `php artisan storage:link` so files are accessible via /storage URL
        // Validation above ensures only JPG/JPEG/PNG up to 2MB are accepted
        if (!$request->hasFile('profile_picture') || !$request->file('profile_picture')->isValid()) {
            return back()->withErrors(['profile_picture' => 'Invalid file upload. Please try again.'])->withInput();
        }
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $validated['profile_picture'] = $path;

        $student = Student::create($validated);

        return redirect()->route('students.show', $student->id)
            ->with('success', 'Student registered successfully!');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }
}
