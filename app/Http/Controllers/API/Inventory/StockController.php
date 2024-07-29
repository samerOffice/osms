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

        $user_company_id = Auth::user()->company_id;
       
        $stocks = DB::connection('inventory')
                            ->table('stocks') 
                            ->leftJoin('products','stocks.product_id','products.id')
                            ->leftJoin('product_requisitions','stocks.product_id','product_requisitions.product_id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'stocks.product_stored_by', '=', 'users.id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.companies', 'stocks.company_id', '=', 'companies.id')
                            ->leftJoin('warehouses', 'stocks.warehouse_id', '=', 'warehouses.id')
                            ->select(
                                'stocks.*',
                                'companies.company_name as company_name',
                                'warehouses.warehouse_name as warehouse_name',
                                'products.product_name as product_name',
                                'users.name as stored_by'
                                )            
                            ->where('stocks.company_id',$user_company_id)
                            ->get();

                            return view('stocks.index',compact('current_module','stocks'));
    }
}
