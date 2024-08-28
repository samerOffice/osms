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


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('leave_applications.leave_submission_ways', compact('current_module'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_applications.leave_submission_ways', compact('current_module','permitted_menus_array'));
                }

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
                                    ->leftJoin('leave_types','leave_applications.leave_type','leave_types.id')
                                    ->select('leave_applications.*',
                                    'users.name as name',
                                    'companies.company_name as company_name',
                                    'leave_types.type_name as leave_type_name',
                                    )
                                    ->orderBy('leave_applications.id','DESC')
                                    ->get();

                                    
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('leave_applications.index', compact('leaveApplications', 'current_module'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_applications.index', compact('leaveApplications', 'current_module','permitted_menus_array'));
                }

            
         }elseif($user_role_id == 2){
            $leaveApplications = DB::table('leave_applications')
                                    ->leftJoin('users','leave_applications.user_id','users.id')
                                    ->leftJoin('companies','leave_applications.company_id','companies.id')
                                    ->leftJoin('leave_types','leave_applications.leave_type','leave_types.id')
                                    ->select('leave_applications.*',
                                    'users.name as name',
                                    'companies.company_name as company_name',
                                    'leave_types.type_name as leave_type_name',
                                    )
                                    ->where('leave_applications.company_id',$user_company_id)
                                    ->orderBy('leave_applications.id','DESC')
                                    ->get();

        $menu_data = DB::table('menu_permissions')
                    ->where('user_id',$user_id)
                    ->first();
            if($menu_data == null){
                return view('leave_applications.index', compact('leaveApplications', 'current_module'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('leave_applications.index', compact('leaveApplications', 'current_module','permitted_menus_array'));
                    }
            
         }else{

            $leaveApplications = DB::table('leave_applications')
                                    ->leftJoin('users','leave_applications.user_id','users.id')
                                    ->leftJoin('companies','leave_applications.company_id','companies.id')
                                    ->leftJoin('leave_types','leave_applications.leave_type','leave_types.id')
                                    ->select('leave_applications.*',
                                    'users.name as name',
                                    'companies.company_name as company_name',
                                    'leave_types.type_name as leave_type_name',
                                    )
                                    ->where('leave_applications.user_id',$user_id)
                                    ->orderBy('leave_applications.id','DESC')
                                    ->get();

            $menu_data = DB::table('menu_permissions')
                    ->where('user_id',$user_id)
                    ->first();
            if($menu_data == null){
                return view('leave_applications.index', compact('leaveApplications', 'current_module'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('leave_applications.index', compact('leaveApplications', 'current_module','permitted_menus_array'));
                    }

         }

     }

    

    // ----------- leave types module start ----------------------
    
    public function leave_types(){

        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;

        $leave_types = DB::table('leave_types')->where('company_id',$user_company_id)->get();

        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
        ->where('user_id',$user_id)
        ->first();
        if($menu_data == null){
            return view('leave_types.index', compact('current_module', 'leave_types'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_types.index', compact('current_module', 'leave_types','permitted_menus_array'));
                }
    }

    public function add_leave_type(){

        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
        ->where('user_id',$user_id)
        ->first();
        if($menu_data == null){
            return view('leave_types.create', compact('current_module'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_types.create', compact('current_module','permitted_menus_array'));
                }
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

        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
        ->where('user_id',$user_id)
        ->first();
        if($menu_data == null){
            return view('leave_types.edit', compact('current_module','leave_type'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_types.edit', compact('current_module','leave_type','permitted_menus_array'));
                }
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


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('leave_applications.file_attachment_form', compact('current_module','leave_types'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_applications.file_attachment_form', compact('current_module','leave_types','permitted_menus_array'));
                }    

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
                            'application_type' => 1,
                            'application_file' => $appFile,
                            'leave_type' => $request->leave_type,
                            'application_date' => Carbon::now()->toDateString(),
                            'application_from' => $request->application_from,
                            'application_to' => $request->application_to,
                            'duration' => $request->duration,
                            'application_status' => '1'
                            ]);

            $response = [
            'success' => true,
            'message' => 'Leave Application is submitted successfully'
            ];

            return response()->json($response,200);
    }


    public function edit_file_attachment($id)
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
                               ->leftJoin('leave_types','leave_applications.leave_type','leave_types.id')
                               ->select('leave_applications.*','leave_types.type_name as leave_type_name')
                               ->where('leave_applications.id',$id)
                               ->first();


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                        ->where('user_id',$user_id)
                        ->first();
        if($menu_data == null){
            return view('leave_applications.edit_file_attachment', compact('leaveApplication', 'current_module','leave_types'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_applications.edit_file_attachment', compact('leaveApplication', 'current_module','leave_types','permitted_menus_array'));
                }

        // dd($leaveApplication);

    }



    public function update_with_attachment(Request $request, $id){

       
            $leave_data = DB::table('leave_applications')
                                ->where('id', $id)
                                ->first();

            $application_file_from_db = $leave_data->application_file;
           
            $application_file = $request->file('attach_leave_application');

            if (!empty($application_file)) {

                if(!empty($application_file_from_db)){
                    $filePath = public_path('uploads/' . $application_file_from_db);
                        unlink($filePath);
                    }

                $applicationFileName = date('Ymd') . time() . '.' . $application_file->getClientOriginalExtension();
                $directory = 'uploads/leave_applications/';
                $appFile = 'leave_applications/' . $applicationFileName;


                // Ensure the directory exists
                if (!file_exists(public_path($directory))) {
                    mkdir(public_path($directory), 0755, true);
                }

                // Move the file to the desired directory
                $application_file->move(public_path($directory), $applicationFileName);


                $data = array();
                $data['leave_type'] = $request->leave_type;
                $data['application_from'] = $request->application_from;
                $data['application_to'] = $request->application_to;
                $data['duration'] = $request->duration;
                $data['application_file'] = $appFile;

                try {   
                    $updated = DB::table('leave_applications')->where('id', $id)->update($data);
                
                    // Check if the update was successful
                    if ($updated) {
                        // Return a success response
                        return response()->json(['message' => 'Leave Application is updated successfully'], 200);
                    } else {
                        // Return a failure response
                        return response()->json(['message' => 'Leave Application update failed or no changes were made'], 400);
                    }
                } catch (\Exception $e) {
                    // Catch any exceptions and return an error response
                    return response()->json(['error' => 'An error occurred while updating the leave application', 'details' => $e->getMessage()], 500);
                } 
            }else{

                $data = array();
                $data['leave_type'] = $request->leave_type;
                $data['application_from'] = $request->application_from;
                $data['application_to'] = $request->application_to;
                $data['duration'] = $request->duration;
                // $data['application_file'] = $appFile;

                try {   
                    $updated = DB::table('leave_applications')->where('id', $id)->update($data);
                
                    // Check if the update was successful
                    if ($updated) {
                        // Return a success response
                        return response()->json(['message' => 'Leave Application is updated successfully'], 200);
                    } else {
                        // Return a failure response
                        return response()->json([
                            'message' => 'Leave Application update failed or no changes were made'
                        ], 400);
                    }
                } catch (\Exception $e) {
                    // Catch any exceptions and return an error response
                    return response()->json(['error' => 'An error occurred while updating the leave application', 'details' => $e->getMessage()], 500);
                } 

            }
            
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


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('leave_applications.add_leave_application', compact('current_module','leave_types'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_applications.add_leave_application', compact('current_module','leave_types','permitted_menus_array'));
                }
        
    }

    public function store(Request $request)
    {

        $user_id = Auth::user()->id;
        $user_company_id = Auth::user()->company_id;

        $leaveApplication = new LeaveApplication();
        $leaveApplication->user_id = $user_id;
        $leaveApplication->company_id = $user_company_id;
        $leaveApplication->application_type = 2;
        $leaveApplication->leave_type = $request->leave_type;
        $leaveApplication->application_msg = $request->application_msg;
        $leaveApplication->application_date = $request->application_date;
        $leaveApplication->application_from = $request->application_from;
        $leaveApplication->application_to = $request->application_to;
        $leaveApplication->duration = $request->duration;
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
                               ->leftJoin('leave_types','leave_applications.leave_type','leave_types.id')
                               ->select('leave_applications.*','leave_types.type_name as leave_type_name')
                               ->where('leave_applications.id',$id)
                               ->first();


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                        ->where('user_id',$user_id)
                        ->first();
        if($menu_data == null){
            return view('leave_applications.edit_leave_application', compact('leaveApplication', 'current_module','leave_types'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_applications.edit_leave_application', compact('leaveApplication', 'current_module','leave_types','permitted_menus_array'));
                }
   
    }

    public function update(Request $request, $id)
    {
        $leaveApplication = LeaveApplication::findOrFail($id);
        $leaveApplication->update($request->all());

        return response()->json(['message' => 'Leave application updated successfully']);
    }

    //------- apply for leave (form submission) end ----------------



    //------- leave approval start -----------
    public function leave_application_approval_list(){

        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();
            
         $user_company_id = Auth::user()->company_id;
         $user_id = Auth::user()->id;

         $leaveApplications = DB::table('leave_applications')
         ->leftJoin('users','leave_applications.user_id','users.id')
         ->leftJoin('companies','leave_applications.company_id','companies.id')
         ->leftJoin('leave_types','leave_applications.leave_type','leave_types.id')
         ->select('leave_applications.*',
         'users.name as name',
         'companies.company_name as company_name',
         'leave_types.type_name as leave_type_name',
         )
         ->where('leave_applications.company_id',$user_company_id)
         ->orderBy('leave_applications.id','DESC')
         ->get();


        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('leave_applications.approval_list', compact('leaveApplications', 'current_module'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_applications.approval_list', compact('leaveApplications', 'current_module','permitted_menus_array'));
                }

    }


    public function review_leave($id){

        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $leaveApplication = DB::table('leave_applications')
                                ->leftJoin('users','leave_applications.user_id','users.id')
                                ->leftJoin('leave_types','leave_applications.leave_type','leave_types.id')
                                ->select('leave_applications.*',
                                'users.name as name',
                                'leave_types.type_name as leave_type_name',
                                )
                                ->where('leave_applications.id',$id)
                                ->first();
        
        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                        ->where('user_id',$user_id)
                        ->first();
        if($menu_data == null){
            return view('leave_applications.review_leave', compact('leaveApplication', 'current_module'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('leave_applications.review_leave', compact('leaveApplication', 'current_module','permitted_menus_array'));
                }

    }

    public function approve_leave(Request $request){

        $user_id = Auth::user()->id;
        $leave_application_id = $request->leave_application_id;
        
        $update = DB::table('leave_applications')
                    ->where('id', $leave_application_id)
                    ->update([
                        'application_status' => 2,
                        'approved_duration' => $request->approved_duration,
                        'application_approved_user_id' => $user_id,
                        'application_approved_date' => Carbon::now()->format('Y-m-d')
                    ]);

        return redirect()->route('leave_application_approval_list')->withSuccess('Leave Application is approved'); 
    }

    public function decline_leave(Request $request){

        $user_id = Auth::user()->id;
        $leave_application_id = $request->leave_application_id;
        
        $update = DB::table('leave_applications')
                    ->where('id', $leave_application_id)
                    ->update([
                        'application_status' => 3,
                        'application_approved_user_id' => $user_id,
                        'application_decline_date' => Carbon::now()->format('Y-m-d')
                    ]);

        return redirect()->route('leave_application_approval_list')->withSuccess('Leave Application is approved'); 
    }

    //------- leave approval end -----------
}
