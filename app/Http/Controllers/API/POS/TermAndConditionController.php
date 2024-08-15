<?php

namespace App\Http\Controllers\API\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class TermAndConditionController extends Controller
{
    public function add_terms_and_conditions(){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('terms_and_conditions.create',compact('current_module'));

    }

    public function terms_and_conditions(){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        $user_company_id = Auth::user()->company_id;

        $terms_and_conditions = DB::connection('pos')
                                 ->table('terms_and_conditions')
                                 ->where('company_id',$user_company_id)
                                 ->first();

        return view('terms_and_conditions.index',compact('current_module','terms_and_conditions'));

    }

    public function store_terms_and_conditions(Request $request){

        $user_company_id = Auth::user()->company_id;
        
        $branch = DB::connection('pos')
                     ->table('terms_and_conditions')
                    ->insertGetId([
                    'company_id'=>$user_company_id,
                    'descriptions'=>$request->descriptions
                    ]);

        $response = [
            'success' => true,
            'message' => 'Terms And Conditions is added successfully'
        ];

        return response()->json($response,200);

    }


    public function update_terms_and_conditions(Request $request, $id){

        $user_company_id = Auth::user()->company_id;

        $data = array();
        $data['company_id'] = $user_company_id;
        $data['descriptions'] = $request->input('descriptions');
        try {
            // Update the branch record in the database
            $updated = DB::connection('pos')
                        ->table('terms_and_conditions')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Terms And Conditions are updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Terms And Conditions update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Terms And Conditions', 'details' => $e->getMessage()], 500);
        }  
    }
}
