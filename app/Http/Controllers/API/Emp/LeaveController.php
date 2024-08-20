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
    
    public function leave_types(){

        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;

        $leave_types = DB::table('leave_types')->where('company_id',$user_company_id)->get();

        return view('leave_types.index', compact('current_module', 'leave_types'));


    }


    public function add_leave_type(){

        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('leave_types.create', compact('current_module'));

    }

    public function submit_leave_tpye(Request $request){

        $user_company_id = Auth::user()->company_id;
        $leave_type = DB::table('leave_types')
                ->insertGetId([
                'company_id'=>$user_company_id,
                'type_name'=>$request->type_name   
                ]);

        $response = [
            'success' => true,
            'message' => 'Leave Type is added successfully'
        ];

        return response()->json($response,200);

    }

    //for web
    public function edit_leave_type($id){

        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $leave_type = DB::table('leave_types')->where('id',$id)->first();

        return view('leave_types.edit', compact('current_module','leave_type'));

    }

    //for api
    public function edit_leave_type_via_api($id){
        $leave_type = DB::table('leave_types')->where('id',$id)->first();
        
        $response = [
        'Leave Type ID' => $leave_type->id,
        'Leave Type Name' => $leave_type->type_name
        ];

       return response()->json($response,200);
    }


    public function update_leave_type(Request $request, $id){    
        $data = array();
        $data['type_name'] = $request->type_name;
       
       
        try {
            // Update the outlet record in the database
            $updated = DB::table('leave_types')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Leave Type is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Leave Type update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the leave type', 'details' => $e->getMessage()], 500);
        }     
    }

    
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
