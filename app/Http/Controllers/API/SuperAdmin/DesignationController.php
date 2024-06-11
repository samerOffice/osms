<?php

namespace App\Http\Controllers\API\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class DesignationController extends Controller
{
    public function designation_list(){
        
        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        $designations = DB::table('designations')->get();

        return view('designations.index',compact('designations','current_module'));
    }

    public function add_designation(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        return view('designations.create',compact('current_module'));
    }


    public function designation_store(Request $request){
        $user_company_id = Auth::user()->company_id;
        $outlet = DB::table('designations')
                ->insertGetId([
                'level'=>$request->level,
                'designation_name'=>$request->designation_name
                ]);

        $response = [
            'success' => true,
            'message' => 'Designation is added successfully'
        ];

        return response()->json($response,200);

    }

      //for web
      public function edit_designation($id){
        $user_company_id = Auth::user()->company_id;
        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $designation = DB::table('designations')
                        ->where('id',$id)
                        ->first();    
        return view('designations.edit',compact('current_module','designation'));
    }

    //for api
    public function edit_designation_via_api($id){
        $designation = DB::table('designations')
                        ->where('id',$id)
                        ->first();      
        $response = [
        'designation_details' => $designation
        ];
       return response()->json($response,200);

    }

    public function update_designation(Request $request, $id){
      
        $data = array();
        $data['level'] = $request->input('level');
        $data['designation_name'] = $request->input('designation_name');
        try {
            // Update the outlet record in the database
            $updated = DB::table('designations')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Designation is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Designation update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the designation', 'details' => $e->getMessage()], 500);
        }     
    }



    public function delete_designation(Request $request)
    {
    	$id = $request->id;
        $deleted = DB::table('designations')->where('id', $id)->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Designation is Deleted Successfully !']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Designation Failed To Deleted !']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }
}
