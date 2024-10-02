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
}
