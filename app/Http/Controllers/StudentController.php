<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of registered students.
     */
    public function index()
    {
        $students = Student::latest()->get();

        return view('students.index', compact('students'));
    }

    /**
     * Show the student registration form.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Validate, store profile picture, and save student record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:students,email',
            'mobile_number' => ['required', 'regex:/^09[0-9]{9}$/', 'digits:11'],
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'program' => 'required',
            'year_level' => 'required',
            'address' => 'required|string',
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'mobile_number.regex' => 'Mobile number must be 11 digits starting with 09.',
            'mobile_number.digits' => 'Mobile number must be exactly 11 digits.',
        ]);

        // Secure file upload: store in storage/app/public/profile_pictures
        if (!$request->hasFile('profile_picture') || !$request->file('profile_picture')->isValid()) {
            return back()->withErrors(['profile_picture' => 'Invalid file upload. Please try again.'])->withInput();
        }

        $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');

        $student = Student::create($validated);

        return redirect()->route('students.show', $student->id)
            ->with('success', 'Student registered successfully!');
    }

    /**
     * Display the specified student's profile.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }
}
