<?php

namespace App\Http\Controllers\API\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Models\AddLeaveApplication;
use Auth;
use DB;

class LeaveController extends Controller
{
    public function leave_applications()
    {
        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        $leaveApplications = LeaveApplication::all();
        return view('leave_applications.index', compact('leaveApplications', 'current_module'));
    }

    public function edit($id)
    {
        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $leaveApplication = LeaveApplication::findOrFail($id);
        return view('leave_applications.edit_leave_application', compact('leaveApplication', 'current_module'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|string',
            'application_type' => 'required|string',
            'application_date' => 'required|date',
            'application_status' => 'required|in:0,1,2',
            'application_approved_user_id' => 'nullable|string',
            'application_approved_date' => 'nullable|date',
        ]);

        $leaveApplication = LeaveApplication::findOrFail($id);
        $leaveApplication->update($request->all());

        return response()->json(['message' => 'Leave application updated successfully']);
    }

    public function create()
    {
        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('leave_applications.add_leave_application', compact('current_module'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'application_type' => 'required|string',
            'application_date' => 'required|date',
            'application_status' => 'required|in:0,1,2',
            'application_approved_user_id' => 'nullable|string',
            'application_approved_date' => 'nullable|date',
        ]);

        $leaveApplication = LeaveApplication::create($request->all());

        return response()->json([
            'message' => 'Leave application added successfully!',
            'data' => $leaveApplication,
        ]);
    }
}
