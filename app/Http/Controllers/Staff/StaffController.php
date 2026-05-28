<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;

use App\Http\Requests\Staff\StoreStaffRequest;

use App\Models\Staff;

class StaffController extends Controller
{
    /**
     * Display staff listing
     */
    public function index()
    {
        $staff = Staff::latest()->get();

        return view(
            'staff.index',
            compact('staff')
        );
    }

    /**
     * Store new staff member
     */
    public function store(
        StoreStaffRequest $request
    ) {

        Staff::create([

            'name' => $request->name,

            'type' => $request->type,

            'subject' => $request->subject,

            'role' => $request->role,

            'salary' => $request->salary,

            'email' => $request->email,

            'phone' => $request->phone
        ]);

        return back()->with(
            'success',
            'Staff member added successfully.'
        );
    }
}