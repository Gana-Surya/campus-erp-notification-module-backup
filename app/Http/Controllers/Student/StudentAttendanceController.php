<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\StudentAttendance;

use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    /**
     * Display attendance dashboard.
     */
    public function index()
    {
        $students = Student::latest()->get();

        $attendanceRecords = StudentAttendance::with('student')
            ->latest()
            ->get();

        return view(
            'students.attendance',
            compact(
                'students',
                'attendanceRecords'
            )
        );
    }

    /**
     * Store attendance record.
     */
    public function store(Request $request)
    {
        $request->validate([

            'student_id' => [
                'required',
                'exists:students,id'
            ],

            'date' => [
                'required',
                'date'
            ],

            'status' => [
                'required',
                'in:PRESENT,ABSENT,HOLIDAY'
            ]
        ]);

        StudentAttendance::create([

            'student_id' => $request->student_id,

            'date' => $request->date,

            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Attendance marked successfully.'
        );
    }
}