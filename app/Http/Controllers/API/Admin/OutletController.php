<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class OutletController extends Controller
{      
    public function outlet_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){     
            $outlets = DB::connection('pos')
            ->table('outlets')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.companies', 'outlets.company_id', '=', 'companies.id')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.branches', 'outlets.branch_id', '=', 'branches.id')
            ->select('outlets.*','companies.company_name as company_name', 'branches.br_name as branch_name')
            ->get();
     
            return view('outlets.index',compact('current_module','outlets'));

        }else{
           
            $outlets = DB::connection('pos')
            ->table('outlets')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.companies', 'outlets.company_id', '=', 'companies.id')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.branches', 'outlets.branch_id', '=', 'branches.id')
            ->select('outlets.*','companies.company_name as company_name', 'branches.br_name as branch_name')
            ->where('outlets.company_id',$user_company_id)
            ->get();

            return view('outlets.index',compact('current_module','outlets'));
        }
    }
          
    public function add_outlet(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;

        $branches = DB::table('branches')
                    ->where('branches.company_id',$user_company_id)
                    ->where('br_status',1)
                    ->get();

        return view('outlets.create',compact('current_module','branches'));
    }

    public function outlet_store(Request $request){
        $user_company_id = Auth::user()->company_id;
        $outlet = DB::connection('pos')
                ->table('outlets')
                ->insertGetId([
                'company_id'=>$user_company_id,
                'branch_id'=>$request->branch_id,
                'outlet_name'=>$request->outlet_name,
                'outlet_address'=>$request->outlet_address,
                'outlet_status'=>$request->outlet_status
                ]);

        $response = [
            'success' => true,
            'message' => 'Outlet is added successfully'
        ];

        return response()->json($response,200);

    }


     //for web
     public function edit_outlet($id){

        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $outlet = DB::connection('pos')
            ->table('outlets')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.branches', 'outlets.branch_id', '=', 'branches.id')
            ->select('outlets.*','branches.br_name as branch_name','branches.id as branch_id')
            ->where('outlets.id',$id)
            ->first();

        $branches = DB::table('branches')
        ->where('branches.company_id',$user_company_id)
        ->where('br_status',1)
        ->get();

        // dd($outlet);   
        return view('outlets.edit',compact('current_module','outlet','branches'));

    }

  
    //for api
    public function edit_outlet_via_api($id){

        $outlet = DB::connection('pos')
            ->table('outlets')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.branches', 'outlets.branch_id', '=', 'branches.id')
            ->select('outlets.*','branches.br_name as branch_name','branches.id as branch_id')
            ->where('outlets.id',$id)
            ->first();
        
        $response = [
        'outlet_details' => $outlet
        ];

       return response()->json($response,200);

    }


    public function update_outlet(Request $request, $id){

        $user_company_id = Auth::user()->company_id;

        // return ($request->all());
        $data = array();
        $data['company_id'] = $user_company_id;
        $data['branch_id'] = $request->input('branch_id');
        $data['outlet_name'] = $request->input('outlet_name');
        $data['outlet_address'] = $request->input('outlet_address');
        $data['outlet_status'] = $request->input('outlet_status');

        try {
            // Update the outlet record in the database
            $updated = DB::connection('pos')
                        ->table('outlets')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Outlet is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Outlet update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the outlet', 'details' => $e->getMessage()], 500);
        }     
    }


    public function delete_outlet(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::connection('pos')
                        ->table('outlets')
                        ->where('id', $id)
                        ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Outlet is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Outlet Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }
}
