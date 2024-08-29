<?php

namespace App\Http\Controllers\API\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function customer_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $customers = DB::connection('pos')
                            ->table('customers')
                            ->get();

            $user_id = Auth::user()->id;
            $menu_data = DB::table('menu_permissions')
                    ->where('user_id',$user_id)
                    ->first();
            if($menu_data == null){
                return view('customers.index',compact('current_module','customers'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('customers.index',compact('current_module','customers','permitted_menus_array'));
                    }

        }else{
            $customers = DB::connection('pos')
                        ->table('customers') 
                        ->where('company_id',$user_company_id)
                        ->get();

            $user_id = Auth::user()->id;
            $menu_data = DB::table('menu_permissions')
                    ->where('user_id',$user_id)
                    ->first();
            if($menu_data == null){
                return view('customers.index',compact('current_module','customers'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('customers.index',compact('current_module','customers','permitted_menus_array'));
                    }
        }       

    }

    public function add_customer(){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('customers.create',compact('current_module'));
        
    }


    public function customer_store(Request $request){

        $user_company_id = Auth::user()->company_id;

        $random_number = rand(1000, 9999);
        $membership_id = 'Member-'.$user_company_id.'-'.$random_number;

        $customer_id = DB::connection('pos')
                        ->table('customers')
                        ->insertGetId([
                        'company_id' => $user_company_id,
                        'customer_name' => $request->customer_name,
                        'membership_id' => $membership_id,
                        'customer_phone_number' => $request->customer_phone_number,
                        'customer_email' => $request->customer_email,
                        'registration_date' => Carbon::now()->toDateString(),
                        'active_status' => '1',
                        ]);

        $response = [
            'success' => true,
            'message' => 'Customer is added successfully'
        ];

        return response()->json($response,200);
    }

    //for web
    public function edit_customer($id){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $customer = DB::connection('pos')
                        ->table('customers')
                        ->where('id',$id)
                        ->first();


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                        ->where('user_id',$user_id)
                        ->first();
        if($menu_data == null){
            return view('customers.edit',compact('current_module','customer'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('customers.edit',compact('current_module','customer','permitted_menus_array'));
                }

    }

    //for api
    public function edit_customer_via_api($id){
        $customer = DB::connection('pos')
                        ->table('customers')
                        ->where('id',$id)
                        ->first();
        
        $response = [
        'Customer Name' => $customer->customer_name,
        'Mobile Number' => $customer->customer_phone_number,
        'Email Address' => $customer->customer_email,
        'Membership Number' => $customer->membership_id,
        'Registration Date' => $customer->registration_date,
        'Active Status' => $customer->active_status
        ];

       return response()->json($response,200);

    }


    
    public function update_customer(Request $request, $id){    
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone_number'] = $request->customer_phone_number;
        $data['customer_email'] = $request->customer_email;
        $data['active_status'] = $request->active_status;
       
        try {
            // Update the outlet record in the database
            $updated = DB::connection('pos')
                        ->table('customers')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Customer is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Customer update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the customer', 'details' => $e->getMessage()], 500);
        }     
    }


    public function delete_customer(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::connection('pos')
                    ->table('customers')
                    ->where('id', $id)
                    ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Customer is Deleted Successfully !']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Customer Failed To Deleted !']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }

}
