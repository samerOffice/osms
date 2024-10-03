<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class BranchController extends Controller
{
    
    
    public function branch_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $branches = DB::table('branches')
                        ->leftJoin('companies','branches.company_id','companies.id')
                        ->select('branches.*','companies.company_name as company_name')
                        ->get();
                        
  
        return view('branches.index',compact('current_module','branches'));

        }else{
            $branches = DB::table('branches')
            ->leftJoin('companies','branches.company_id','companies.id')
            ->select('branches.*','companies.company_name as company_name')
            ->where('branches.company_id',$user_company_id)
            ->get();

        return view('branches.index',compact('current_module','branches'));
        }       

    }


    public function branch_list_for_api(Request $request)
    {
          
        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;
    
        // Retrieve the search query from the request
        $search = $request->input('search'); // Default to an empty string if no search parameter is provided

        // Build the query based on user role and search query
        $query = DB::table('branches')
            ->leftJoin('companies', 'branches.company_id', '=', 'companies.id')
            ->select('branches.*', 'companies.company_name as company_name');
    
        // Apply search filter
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('branches.br_name', 'like', "%$search%")
                  ->orWhere('companies.company_name', 'like', "%$search%");
            });
        }
    
        // Apply company filter based on user role
        if ($user_role_id != 1) {
            $query->where('branches.company_id', $user_company_id);
        }
    
        // Paginate the results
        $branches = $query->paginate(10);
    
        // Return the response as JSON with pagination data
        return response()->json([
            'branches' => $branches,
        ]);
    }
    

    public function add_branch(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('branches.create',compact('current_module'));
        
    }

    public function branch_store(Request $request){
        $user_company_id = Auth::user()->company_id;
        
        $branch = DB::table('branches')
        ->insertGetId([
        'company_id'=>$user_company_id,
        'br_name'=>$request->br_name,
        'br_address'=>$request->br_address,
        'br_type'=>$request->br_type,
        'br_status'=>$request->br_status
        ]);

        $response = [
            'success' => true,
            'message' => 'Branch is added successfully'
        ];

        return response()->json($response,200);
    }


    //for web
    public function edit_branch($id){
        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $branch = DB::table('branches')
                  ->where('id',$id)
                  ->first();

    return view('branches.edit',compact('current_module','branch'));
    }

  
    //for api
    public function edit_branch_via_api($id){

        $branch = DB::table('branches')
                  ->where('id',$id)
                  ->first();


        $response = [
        'branch_details' => $branch
        ];
       return response()->json($response,200);

    }


    public function update_branch(Request $request, $id){

        $user_company_id = Auth::user()->company_id;

        $data = array();
        $data['company_id'] = $user_company_id;
        $data['br_name'] = $request->input('br_name');
        $data['br_address'] = $request->input('br_address');
        $data['br_type'] = $request->input('br_type');
        $data['br_status'] = $request->input('br_status');


        try {
            // Update the branch record in the database
            $updated = DB::table('branches')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Branch updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Branch update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the branch', 'details' => $e->getMessage()], 500);
        }  
    }


    
    public function delete_branch(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::table('branches')->where('id', $id)->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Branch is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Branch Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }
    
}
