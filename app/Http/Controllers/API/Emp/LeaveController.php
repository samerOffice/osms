<?php

namespace App\Http\Controllers\API\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Models\AddLeaveApplication;
use Auth;
use DB;
use Carbon\Carbon;

class LeaveController extends Controller
{


     // leave submission ways
     public function apply_leave(){

        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('leave_applications.leave_submission_ways', compact('current_module'));
    }



     //leave application list
     public function leave_applications()
     {
         $current_modules = ['module_status' => '2'];
         DB::table('current_modules')->update($current_modules);
         $current_module = DB::table('current_modules')->first();

         $user_company_id = Auth::user()->company_id;
         $user_id = Auth::user()->id;
         $user_role_id = Auth::user()->role_id;

         if($user_role_id == 1){
            $leaveApplications = DB::table('leave_applications')
                                    ->leftJoin('users','leave_applications.user_id','users.id')
                                    ->leftJoin('companies','leave_applications.company_id','companies.id')
                                    ->leftJoin('leave_types','leave_applications.application_type','leave_types.id')
                                    ->select('leave_applications.*',
                                    'users.name as name',
                                    'companies.company_name as company_name',
                                    'leave_types.type_name as leave_type',
                                    )
                                    ->get();
            return view('leave_applications.index', compact('leaveApplications', 'current_module'));
         }elseif($user_role_id == 2){
            $leaveApplications = DB::table('leave_applications')
                                    ->leftJoin('users','leave_applications.user_id','users.id')
                                    ->leftJoin('companies','leave_applications.company_id','companies.id')
                                    ->leftJoin('leave_types','leave_applications.application_type','leave_types.id')
                                    ->select('leave_applications.*',
                                    'users.name as name',
                                    'companies.company_name as company_name',
                                    'leave_types.type_name as leave_type',
                                    )
                                    ->where('leave_applications.company_id',$user_company_id)
                                    ->get();
            return view('leave_applications.index', compact('leaveApplications', 'current_module'));
         }else{

            $leaveApplications = DB::table('leave_applications')
                                    ->leftJoin('users','leave_applications.user_id','users.id')
                                    ->leftJoin('companies','leave_applications.company_id','companies.id')
                                    ->leftJoin('leave_types','leave_applications.application_type','leave_types.id')
                                    ->select('leave_applications.*',
                                    'users.name as name',
                                    'companies.company_name as company_name',
                                    'leave_types.type_name as leave_type',
                                    )
                                    ->where('leave_applications.user_id',$user_id)
                                    ->get();
            return view('leave_applications.index', compact('leaveApplications', 'current_module'));
         }

     }

    

    // ----------- leave types module start ----------------------
    
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

    // ----------- leave types module end ----------------------

    
   




//------- apply for leave (file attachment) start -----------

    public function leave_application_file_attachment(){

        
        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;

        $leave_types = DB::table('leave_types')
                       ->where('company_id',$user_company_id)
                       ->get();

        return view('leave_applications.file_attachment_form', compact('current_module','leave_types'));

    }

    public function leave_application_attach_file_store(Request $request){

        $user_id = Auth::user()->id;
        $user_company_id = Auth::user()->company_id;
        
        $applicationFile = $request->file('attach_leave_application');
        $applicationFileName = date('Ymd') . time() . '.' . $applicationFile->getClientOriginalExtension();
        $directory = 'uploads/leave_applications/';
        $appFile = 'leave_applications/' . $applicationFileName;

            // Ensure the directory exists
        if (!file_exists(public_path($directory))) {
            mkdir(public_path($directory), 0755, true);
        }

        // Move the file to the desired directory
        $applicationFile->move(public_path($directory), $applicationFileName);

        $leave_application = DB::table('leave_applications')
                            ->insertGetId([
                            'user_id' => $user_id,
                            'company_id' => $user_company_id,
                            'application_way' => 1,
                            'application_file' => $appFile,
                            'application_type' => $request->application_type,
                            'application_date' => Carbon::now()->toDateString(),
                            'application_status' => '1'
                            ]);

            $response = [
            'success' => true,
            'message' => 'Leave Application is submitted successfully'
            ];

            return response()->json($response,200);
    }

//------- apply for leave (file attachment) end -----------





  //------- apply for leave (form submission) start -----------

    public function create()
    {
        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;

        $leave_types = DB::table('leave_types')
                           ->where('company_id',$user_company_id)
                           ->get();


        return view('leave_applications.add_leave_application', compact('current_module','leave_types'));
    }

    public function store(Request $request)
    {

        $user_id = Auth::user()->id;
        $user_company_id = Auth::user()->company_id;

        $leaveApplication = new LeaveApplication();
        $leaveApplication->user_id = $user_id;
        $leaveApplication->company_id = $user_company_id;
        $leaveApplication->application_way = 2;
        $leaveApplication->application_type = $request->application_type;
        $leaveApplication->application_msg = $request->application_msg;
        $leaveApplication->application_date = $request->application_date;
        $leaveApplication->application_status = 1;
        $leaveApplication->save();


        return response()->json([
            'message' => 'Leave application added successfully!',
            'data' => $leaveApplication,
        ]);
    }

    public function edit($id)
    {
        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;

        $leave_types = DB::table('leave_types')
                           ->where('company_id',$user_company_id)
                           ->get();

        // $leaveApplication = LeaveApplication::findOrFail($id);

        $leaveApplication = DB::table('leave_applications')
                               ->leftJoin('leave_types','leave_applications.application_type','leave_types.id')
                               ->select('leave_applications.*','leave_types.type_name as leave_type')
                               ->where('leave_applications.id',$id)
                               ->first();

        return view('leave_applications.edit_leave_application', compact('leaveApplication', 'current_module','leave_types'));
    }

    public function update(Request $request, $id)
    {
        $leaveApplication = LeaveApplication::findOrFail($id);
        $leaveApplication->update($request->all());

        return response()->json(['message' => 'Leave application updated successfully']);
    }

    //------- apply for leave (form submission) end ----------------
}
