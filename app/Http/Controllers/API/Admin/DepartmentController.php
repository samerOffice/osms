<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class DepartmentController extends Controller
{
    public function department_list(){
        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $departments = DB::table('departments')
                        ->leftJoin('companies','departments.company_id','companies.id')
                        ->leftJoin('branches','departments.branch_id','branches.id')
                        ->select('departments.*','companies.company_name as company_name','branches.br_name as branch_name')
                        ->get();
  
        return view('departments.index',compact('current_module','departments'));

        }else{
            $departments = DB::table('departments')
            ->leftJoin('companies','departments.company_id','companies.id')
            ->leftJoin('branches','departments.branch_id','branches.id')
            ->select('departments.*','companies.company_name as company_name','branches.br_name as branch_name')
            ->where('departments.company_id',$user_company_id)
            ->get();

            return view('departments.index',compact('current_module','departments'));
        }
    }


    public function add_department(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;

        $branches = DB::table('branches')
                    ->where('branches.company_id',$user_company_id)
                    ->get();

        return view('departments.create',compact('current_module','branches'));
    }



    public function branch_warehouse_dependancy(Request $request){

        $selectedBranch = $request->input('data');

        $warehouses = DB::connection('inventory')
                        ->table('warehouses')
                        ->where('branch_id',$selectedBranch)
                        ->get();
  
      $str="<option value=''>-- Select --</option>";
      foreach ($warehouses as $warehouse) {
         $str .= "<option value='$warehouse->id'> $warehouse->warehouse_name </option>";
         
      }
      echo $str;
      }

      public function branch_outlet_dependancy(Request $request){

        $selectedBranch = $request->input('data');

        $outlets = DB::connection('pos')
                        ->table('outlets')
                        ->where('branch_id',$selectedBranch)
                        ->get();
  
      $str="<option value=''>-- Select --</option>";
      foreach ($outlets as $outlet) {
         $str .= "<option value='$outlet->id'> $outlet->outlet_name </option>";
         
      }
      echo $str;
      }

      public function department_store(Request $request){
        $user_company_id = Auth::user()->company_id;
        $outlet = DB::table('departments')
                ->insertGetId([
                'company_id'=>$user_company_id,
                'branch_id'=>$request->branch_id,
                'warehouse_id'=>$request->warehouse_id,
                'outlet_id'=>$request->outlet_id,
                'dept_name'=>$request->dept_name               
                ]);

        $response = [
            'success' => true,
            'message' => 'Department is added successfully'
        ];

        return response()->json($response,200);
    }


    //for web
    public function edit_department($id){

        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $dept = DB::table('departments')
                    ->where('id',$id)
                    ->first();
 
        return view('departments.edit',compact('current_module','dept'));

    }

    //for api
    public function edit_department_via_api($id){
        $dept = DB::table('departments')
        ->where('id',$id)
        ->first();
        
        $response = [
        'department_details' => $dept
        ];

       return response()->json($response,200);

    }


    public function update_department(Request $request, $id){

       
        $data = array();
        $data['dept_name'] = $request->input('dept_name');
       
        try {
            // Update the outlet record in the database
            $updated = DB::table('departments')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Department is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Department update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the department', 'details' => $e->getMessage()], 500);
        }     
    }
}
