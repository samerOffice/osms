<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class StockController extends Controller
{
    public function stock_list(){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_role_id =  Auth::user()->role_id;
        $user_company_id = Auth::user()->company_id;
        $user_warehouse_id = Auth::user()->warehouse_id;
       
        if($user_role_id == 1 || $user_role_id == 2){
            $stocks = DB::connection('inventory')
            ->table('stocks') 
            ->leftJoin('products','stocks.product_id','products.id')
            ->select(
                'stocks.product_id',
                'products.product_name',
                DB::raw('SUM(stocks.quantity) as total_quantity')
                )            
            ->where('stocks.company_id',$user_company_id)
            ->groupBy(
                'stocks.product_id',
                'products.product_name'
                    )
            ->get();
            return view('stocks.index',compact('current_module','stocks'));

        }else{
            $stocks = DB::connection('inventory')
            ->table('stocks') 
            ->leftJoin('products','stocks.product_id','products.id')
            ->select(
                'stocks.product_id',
                'products.product_name',
                DB::raw('SUM(stocks.quantity) as total_quantity')
                )            
            ->where('stocks.company_id',$user_company_id)
            ->where('stocks.warehouse_id',$user_warehouse_id)
            ->groupBy(
                'stocks.product_id',
                'products.product_name'
                    )
            ->get();
            return view('stocks.index',compact('current_module','stocks'));
        }
     
    }

    public function view_stock($id){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_role_id =  Auth::user()->role_id;
        $user_company_id = Auth::user()->company_id;
        $user_branch_id = Auth::user()->branch_id;
        $user_warehouse_id = Auth::user()->warehouse_id;


        $company = DB::table('companies')
                    ->select('company_name')
                    ->where('id',$user_company_id)
                    ->first();
        $company_name = $company->company_name;

        $branch = DB::table('branches')
                    ->select('br_name')
                    ->where('id',$user_branch_id)
                    ->first();
        $branch_name = $branch->br_name;

      
        if($user_role_id == 1 || $user_role_id == 2){
            $stocks = DB::connection('inventory')
            ->table('stocks') 
            ->leftJoin('products','stocks.product_id','products.id')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'stocks.product_stored_by', '=', 'users.id')
            ->leftJoin('warehouses', 'stocks.warehouse_id', '=', 'warehouses.id')
            ->select(
                'stocks.*',
                'products.product_name as stock_product_name',
                'products.product_weight as stock_product_weight',
                'products.product_unit_type as stock_product_unit_type',
                'products.additional_product_details as stock_product_details',
                // 'companies.company_name as company_name',
                'warehouses.warehouse_name as warehouse_name',              
                'users.name as purchased_by',              
                )            
            ->where('stocks.company_id',$user_company_id)
            ->where('stocks.product_id',$id)
            ->get();

            return view('stocks.view',compact('current_module','stocks','company_name','branch_name','id'));
        }else{
            $stocks = DB::connection('inventory')
            ->table('stocks') 
            ->leftJoin('products','stocks.product_id','products.id')
            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'stocks.product_stored_by', '=', 'users.id')
            ->leftJoin('warehouses', 'stocks.warehouse_id', '=', 'warehouses.id')
            ->select(
                'stocks.*',
                'products.product_name as stock_product_name',
                'products.product_weight as stock_product_weight',
                'products.product_unit_type as stock_product_unit_type',
                'products.additional_product_details as stock_product_details',
                // 'companies.company_name as company_name',
                'warehouses.warehouse_name as warehouse_name',             
                'users.name as purchased_by',              
                )            
            ->where('stocks.company_id',$user_company_id)
            ->where('stocks.warehouse_id',$user_warehouse_id)
            ->where('stocks.product_id',$id)
            ->get();

            return view('stocks.view',compact('current_module','stocks','company_name','branch_name','id'));
        }
 
    }


    public function add_label($id){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

       
        $user_company_id = Auth::user()->company_id;

        $label = DB::connection('inventory')
                   ->table('stocks')
                   ->leftJoin('products','stocks.product_id','products.id')
                   ->select(
                    'stocks.*',
                    'products.product_name as stock_product_name',
                    'products.product_weight as stock_product_weight',
                    'products.product_unit_type as stock_product_unit_type',
                    'products.additional_product_details as stock_product_details'      
                    )  
                   ->where('stocks.id',$id)
                   ->first();

        // dd($label);

        return view('stocks.add_label',compact('current_module','label'));
       

    }

}
