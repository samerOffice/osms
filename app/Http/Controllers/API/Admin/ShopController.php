<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;


class ShopController extends Controller
{
    public function shop_list(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $shops = DB::table('companies')->get();

        return view('shops.index',compact('current_module','shops'));
    }

    public function view_shop($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $shop = DB::table('companies')
                ->leftJoin('divisions','companies.division','divisions.id')
                ->leftJoin('districts','companies.district','districts.id')
                ->select('companies.*','divisions.name as division_name','districts.name as district_name')
                ->where('companies.id',$id)
                ->first();

       return view('shops.view',compact('current_module','shop')); 
    }

    public function shop_details(){
        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        $user_company_id = Auth::user()->company_id;

        $shop = DB::table('companies')
                ->leftJoin('divisions','companies.division','divisions.id')
                ->leftJoin('districts','companies.district','districts.id')
                ->select('companies.*','divisions.name as division_name','districts.name as district_name')
                ->where('companies.id',$user_company_id)
                ->first();

        $divisions = DB::table('divisions')->get();

        return view('shops.edit',compact('current_module','shop','divisions'));
    }



    public function update_shop(Request $request, $id){


        $data = array();
        $data['company_name'] = $request->input('company_name');
        $data['company_email'] = $request->input('company_email');
        $data['contact_no'] = $request->input('contact_no');
        $data['license_no'] = $request->input('license_no');
        $data['company_address'] = $request->input('company_address');
        $data['registration_no'] = $request->input('registration_no');
        $data['division'] = $request->input('division');
        $data['district'] = $request->input('district');

        try {
            // Update the branch record in the database
            $updated = DB::table('companies')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Shop is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Shop update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Shop', 'details' => $e->getMessage()], 500);
        }  
    }
}
