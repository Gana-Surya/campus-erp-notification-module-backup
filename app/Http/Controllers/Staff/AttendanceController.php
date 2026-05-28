<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Staff;

use App\Models\StaffAttendance;

class AttendanceController extends Controller
{
    /**
     * Display attendance dashboard
     */
    public function index()
    {
        // Get all staff members
        $staff = Staff::latest()->get();

        // Get attendance history
        $attendanceRecords = StaffAttendance::with('staff')
            ->latest()
            ->get();

        return view(
            'staff.attendance',
            compact(
                'staff',
                'attendanceRecords'
            )
        );
    }

    /**
     * Store attendance record
     */
    public function store(Request $request)
    {
        // Validate attendance form
        $request->validate([

            'staff_id' => [
                'required',
                'exists:staff,id'
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

        // Create attendance record
        StaffAttendance::create([

            'staff_id' => $request->staff_id,

            'date' => $request->date,

            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Attendance marked successfully.'
        );
    }
}