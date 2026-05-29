<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use App\Http\Requests\Student\StoreStudentRequest;

use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display student dashboard.
     */
    public function index()
    {
        // Fetch latest students first
        $students = Student::latest()->get();

        return view(
            'students.index',
            compact('students')
        );
    }

    /**
     * Store a new student.
     */
    public function store(
        StoreStudentRequest $request
    ) {

        Student::create([

            'admission_number' =>
                $request->admission_number,

            'name' =>
                $request->name,

            'stream' =>
                $request->stream,

            'course' =>
                $request->course,

            'semester' =>
                $request->semester,

            'category' =>
                $request->category,

            'email' =>
                $request->email,

            'phone' =>
                $request->phone
        ]);

        return back()->with(
            'success',
            'Student added successfully.'
        );
    }
}