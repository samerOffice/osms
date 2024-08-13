<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class SupplierController extends Controller
{
    public function supplier_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $suppliers = DB::table('suppliers')->get();
                                          
        return view('suppliers.index',compact('current_module','suppliers'));

        }else{
            $suppliers = DB::table('suppliers') 
                        ->where('company_id',$user_company_id)
                        ->get();

        return view('suppliers.index',compact('current_module','suppliers'));
        }       

    }

    public function add_supplier(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('suppliers.create',compact('current_module'));
        
    }

    public function supplier_store(Request $request){
        $user_company_id = Auth::user()->company_id;
        $supplier = DB::table('suppliers')
                ->insertGetId([
                'company_id'=>$user_company_id,
                'full_name'=>$request->full_name,
                'mobile_number'=>$request->mobile_number,
                'official_address'=>$request->official_address,
                'active_status'=>$request->active_status      
                ]);

        $response = [
            'success' => true,
            'message' => 'Supplier is added successfully'
        ];

        return response()->json($response,200);
    }


    //for web
    public function edit_supplier($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $supplier = DB::table('suppliers')
                    ->where('id',$id)
                    ->first();
 
        return view('suppliers.edit',compact('current_module','supplier'));

    }

    //for api
    public function edit_supplier_via_api($id){
        $supplier = DB::table('suppliers')
        ->where('id',$id)
        ->first();
        
        $response = [
        'Supplier Name' => $supplier->full_name,
        'Mobile Number' => $supplier->mobile_number,
        'Official Address' => $supplier->official_address,
        'Active Status' => $supplier->active_status
        ];

       return response()->json($response,200);

    }


    public function update_supplier(Request $request, $id){    
        $data = array();
        $data['full_name'] = $request->full_name;
        $data['mobile_number'] = $request->mobile_number;
        $data['official_address'] = $request->official_address;
        $data['active_status'] = $request->active_status;
       
        try {
            // Update the outlet record in the database
            $updated = DB::table('suppliers')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Supplier is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Supplier update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the supplier', 'details' => $e->getMessage()], 500);
        }     
    }


    public function delete_supplier(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::table('suppliers')->where('id', $id)->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Supplier is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Supplier Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }



}
