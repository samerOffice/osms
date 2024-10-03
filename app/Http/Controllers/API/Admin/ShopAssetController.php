<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class ShopAssetController extends Controller
{
    public function asset_list(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $assets = DB::table('assets')
        ->leftJoin('companies','assets.company_id','companies.id')
        ->leftJoin('branches','assets.branch_id','branches.id')
        ->leftJoin('departments','assets.department_id','departments.id')
        ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.warehouses', 'assets.warehouse_id', '=', 'warehouses.id')
        ->leftJoin(DB::connection('pos')->getDatabaseName() . '.outlets', 'assets.outlet_id', '=', 'outlets.id')
        ->get();

        return view('shop_assets.index',compact('current_module','assets'));
    }

    public function add_asset(){

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

        $departments = DB::table('departments')
                    ->where('departments.company_id',$user_company_id)
                    ->get();

        $warehouses = DB::connection('inventory')
                    ->table('warehouses')
                    ->where('company_id',$user_company_id)
                    ->where('warehouse_status',1)
                    ->get();

        $outlets = DB::connection('pos')
                    ->table('outlets')
                    ->where('company_id',$user_company_id)
                    ->where('outlet_status',1)
                    ->get();


        return view('shop_assets.create',compact('current_module','branches','departments','warehouses','outlets'));
    }

    public function asset_store(Request $request){
        $user_company_id = Auth::user()->company_id;
        
        $asset = DB::table('assets')
        ->insertGetId([
        'asset_name'=>$request->asset_name,
        'asset_type'=>$request->asset_type,
        'purchase_date'=>$request->purchase_date,
        'cost'=>$request->cost,
        'company_id'=>$user_company_id,
        'branch_id'=>$request->branch_id,
        'department_id'=>$request->department_id,
        'warehouse_id'=>$request->warehouse_id,
        'outlet_id'=>$request->outlet_id,
        'depreciation_rate'=>$request->depreciation_rate,
        'notes'=>$request->notes,  
        'status'=>$request->status
        ]);

        $response = [
            'success' => true,
            'message' => 'Asset is added successfully'
        ];

        return response()->json($response,200);
    }


     //for web
     public function edit_asset($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;

        $asset = DB::table('assets')
                  ->leftJoin('branches','assets.branch_id','branches.id')
                  ->leftJoin('departments','assets.department_id','departments.id')
                  ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.warehouses', 'assets.warehouse_id', '=', 'warehouses.id')
                  ->leftJoin(DB::connection('pos')->getDatabaseName() . '.outlets', 'assets.outlet_id', '=', 'outlets.id')
                  ->select(
                    'assets.*',
                    'branches.br_name as branch_name',
                    'departments.dept_name as department_name',
                    'warehouses.warehouse_name as warehouse_name',
                    'outlets.outlet_name as outlet_name'
                    )
                  ->where('assets.id',$id)
                  ->first();


        $branches = DB::table('branches')
                    ->where('branches.company_id',$user_company_id)
                    ->where('br_status',1)
                    ->get();

        $departments = DB::table('departments')
                    ->where('departments.company_id',$user_company_id)
                    ->get();

        $warehouses = DB::connection('inventory')
                    ->table('warehouses')
                    ->where('company_id',$user_company_id)
                    ->where('warehouse_status',1)
                    ->get();

        $outlets = DB::connection('pos')
                    ->table('outlets')
                    ->where('company_id',$user_company_id)
                    ->where('outlet_status',1)
                    ->get();

    return view('shop_assets.edit',compact('current_module','asset','branches','departments','warehouses','outlets'));
    }

  
    //for api
    public function edit_asset_via_api($id){

        $asset = DB::table('assets')
                  ->where('id',$id)
                  ->first();


        $response = [
        'asset_details' => $asset
        ];
       return response()->json($response,200);

    }


    public function update_asset(Request $request, $id){

        $user_company_id = Auth::user()->company_id;

        $data = array();
        $data['asset_name'] = $request->input('asset_name');
        $data['asset_type'] = $request->input('asset_type');
        $data['purchase_date'] = $request->input('purchase_date');
        $data['cost'] = $request->input('cost');
        $data['company_id'] = $user_company_id;
        $data['branch_id'] = $request->input('branch_id');
        $data['department_id'] = $request->input('department_id');
        $data['warehouse_id'] = $request->input('warehouse_id');
        $data['outlet_id'] = $request->input('outlet_id');
        $data['depreciation_rate'] = $request->input('depreciation_rate');
        $data['notes'] = $request->input('notes');
        $data['status'] = $request->input('status');


        try {
            // Update the branch record in the database
            $updated = DB::table('assets')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Asset updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Asset update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the asset', 'details' => $e->getMessage()], 500);
        }  
    }


    
    public function delete_asset(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::table('assets')->where('id', $id)->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Asset is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Asset Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }
}
