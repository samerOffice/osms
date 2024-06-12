<?php

namespace App\Http\Controllers\API\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class BusinessTypeController extends Controller
{
    public function business_type_list(){
      
        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $business_types = DB::table('business_types')->get();

        return view('business_types.index', compact('current_module','business_types'));
    }

    public function add_business_type(){
        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        return view('business_types.create',compact('current_module'));
    }

    public function business_type_store(Request $request){

        $designation = DB::table('business_types')
        ->insertGetId([
        'business_type'=>$request->business_type,
        'business_status'=>$request->business_status
        ]);

        $response = [
            'success' => true,
            'message' => 'Business Type is added successfully'
        ];

        return response()->json($response,200);
    }


     //for web
     public function edit_business_type($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $business_type = DB::table('business_types')
                        ->where('id',$id)
                        ->first();    
        return view('business_types.edit',compact('current_module','business_type'));
    }

    //for api
    public function edit_business_type_via_api($id){
        $business_type = DB::table('business_types')
                        ->where('id',$id)
                        ->first();      
        $response = [
        'business_type_details' => $business_type
        ];
       return response()->json($response,200);
    }

    public function update_business_type(Request $request, $id){
      
        $data = array();
        $data['business_type'] = $request->input('business_type');
        $data['business_status'] = $request->input('business_status');
        try {
            // Update the outlet record in the database
            $updated = DB::table('business_types')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Business Type is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Business Type update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the designation', 'details' => $e->getMessage()], 500);
        }     
    }
}
