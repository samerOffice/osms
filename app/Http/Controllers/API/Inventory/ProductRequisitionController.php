<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class ProductRequisitionController extends Controller
{
    public function requisition_list(){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;
       
        $product_categories = DB::connection('inventory')
        ->table('product_categories')  
        ->leftJoin('item_categories','product_categories.item_category_id','item_categories.id')
        ->select('product_categories.*','item_categories.name as item_category_name')            
        ->where('product_categories.company_id',$user_company_id)
        ->get();

        return view('product_requisitions.index',compact('current_module','product_categories'));
    }

    public function new_stock(){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $user_company_id = Auth::user()->company_id;


        $item_categories = DB::connection('inventory')
        ->table('item_categories')
        ->where('company_id',$user_company_id)
        ->get();

        $suppliers = DB::table('suppliers')
                        ->where('company_id',$user_company_id)
                        ->get();

        $warehouses = DB::connection('inventory')
                        ->table('warehouses')
                        ->where('company_id',$user_company_id)
                        ->get();


        return view('product_requisitions.new_stock',compact('current_module','user_id','user_name','item_categories','suppliers','warehouses'));
    }
}
