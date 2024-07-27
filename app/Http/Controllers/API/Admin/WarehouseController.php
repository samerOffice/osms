<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class WarehouseController extends Controller
{
    public function warehouse_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){     
            $warehouses = DB::connection('inventory')
            ->table('warehouses')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.companies', 'warehouses.company_id', '=', 'companies.id')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.branches', 'warehouses.branch_id', '=', 'branches.id')
            ->select('warehouses.*','companies.company_name as company_name', 'branches.br_name as branch_name')
            ->get();
     
            return view('warehouses.index',compact('current_module','warehouses'));

        }else{
           
            $warehouses = DB::connection('inventory')
            ->table('warehouses')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.companies', 'warehouses.company_id', '=', 'companies.id')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.branches', 'warehouses.branch_id', '=', 'branches.id')
            ->select('warehouses.*','companies.company_name as company_name', 'branches.br_name as branch_name')
            ->where('warehouses.company_id',$user_company_id)
            ->get();

            return view('warehouses.index',compact('current_module','warehouses'));
        }
    }


    public function add_warehouse(){
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

        return view('warehouses.create',compact('current_module','branches'));
    }

    public function warehouse_store(Request $request){
        $user_company_id = Auth::user()->company_id;
        $outlet = DB::connection('inventory')
                ->table('warehouses')
                ->insertGetId([
                'company_id'=>$user_company_id,
                'branch_id'=>$request->branch_id,
                'warehouse_name'=>$request->warehouse_name,
                'warehouse_address'=>$request->warehouse_address,
                'warehouse_status'=>$request->warehouse_status
                ]);

        $response = [
            'success' => true,
            'message' => 'Warehouse is added successfully'
        ];

        return response()->json($response,200);
    }


    //for web
    public function edit_warehouse($id){

        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $warehouse = DB::connection('inventory')
            ->table('warehouses')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.branches', 'warehouses.branch_id', '=', 'branches.id')
            ->select('warehouses.*','branches.br_name as branch_name','branches.id as branch_id')
            ->where('warehouses.id',$id)
            ->first();

        $branches = DB::table('branches')
        ->where('branches.company_id',$user_company_id)
        ->where('br_status',1)
        ->get();

        // dd($warehouse);   
        return view('warehouses.edit',compact('current_module','warehouse','branches'));
    }



    //for api
    public function edit_warehouse_via_api($id){

        $warehouse = DB::connection('inventory')
            ->table('warehouses')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.branches', 'warehouses.branch_id', '=', 'branches.id')
            ->select('warehouses.*','branches.br_name as branch_name','branches.id as branch_id')
            ->where('warehouses.id',$id)
            ->first();
        
        $response = [
        'warehouse_details' => $warehouse
        ];

        return response()->json($response,200);
    }




    public function update_warehouse(Request $request, $id){

        $user_company_id = Auth::user()->company_id;

        // return ($request->all());
        $data = array();
        $data['company_id'] = $user_company_id;
        $data['branch_id'] = $request->input('branch_id');
        $data['warehouse_name'] = $request->input('warehouse_name');
        $data['warehouse_address'] = $request->input('warehouse_address');
        $data['warehouse_status'] = $request->input('warehouse_status');

        try {
            // Update the outlet record in the database
            $updated = DB::connection('inventory')
                        ->table('warehouses')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Warehouse is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Warehouse update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the warehouse', 'details' => $e->getMessage()], 500);
        }     
    }
}
