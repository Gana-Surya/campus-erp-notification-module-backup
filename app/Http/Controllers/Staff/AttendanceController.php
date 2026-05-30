<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\StaffAttendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $staff = Staff::latest()->get();

        $attendanceRecords = StaffAttendance::with('staff')
            ->latest()
            ->get();

        $today = date('Y-m-d');

        $totalStaff = Staff::count();

        $presentToday = StaffAttendance::where(
            'date',
            $today
        )
        ->where(
            'status',
            'PRESENT'
        )
        ->count();

        $absentToday = StaffAttendance::where(
            'date',
            $today
        )
        ->where(
            'status',
            'ABSENT'
        )
        ->count();

        $holidayToday = StaffAttendance::where(
            'date',
            $today
        )
        ->where(
            'status',
            'HOLIDAY'
        )
        ->count();

        $attendancePercentage =
            $totalStaff > 0
                ? round(
                    ($presentToday / $totalStaff) * 100,
                    2
                )
                : 0;

        $monthlyReport = Staff::with('attendance')->get();

        $salaryReport = Staff::with('attendance')->get();

        return view(
            'staff.attendance',
            compact(
                'staff',
                'attendanceRecords',
                'totalStaff',
                'presentToday',
                'absentToday',
                'holidayToday',
                'attendancePercentage',
                'monthlyReport',
                'salaryReport'
            )
        );
    }

    public function store(Request $request)
    {
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
?>
