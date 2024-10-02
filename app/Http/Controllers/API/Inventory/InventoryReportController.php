<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class InventoryReportController extends Controller
{
    public function damage_report(){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('reports.inventory_reports.damage_report',compact('current_module'));

    }

    public function damage_report_submit(Request $request){

        $report_type = $request->sale_type;
        $user_company_id = Auth::user()->company_id;
        
        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        // return view('reports.inventory_reports.damage_report',compact('current_module'));

        if($report_type == 1){

            $current_date = Carbon::now()->toDateString();

            $damages_data = DB::connection('inventory')
                        ->table('damage_and_burned_products')
                        ->leftJoin('products','damage_and_burned_products.product_id','products.id')
                        ->select(
                        'damage_and_burned_products.*',                  
                        'products.product_name as product_name',
                        )
                        ->where('damage_and_burned_products.company_id',$user_company_id)
                        ->where('damage_and_burned_products.entry_date', $current_date)
                        ->get();

        //   dd($damages_data);
        return view('reports.inventory_reports.damage_report_data',compact('current_module','damages_data', 'report_type'));

        }elseif($report_type == 2){

            $current_month = Carbon::now()->format('m');
            $current_year = Carbon::now()->format('Y');
            
            $damages_data = DB::connection('inventory')
                        ->table('damage_and_burned_products')
                        ->leftJoin('products','damage_and_burned_products.product_id','products.id')
                        ->select(
                        'damage_and_burned_products.*',                  
                        'products.product_name as product_name',
                        )
                        ->where('damage_and_burned_products.company_id',$user_company_id)
                        ->whereMonth('damage_and_burned_products.entry_date', $current_month)
                        ->whereYear('damage_and_burned_products.entry_date', $current_year)
                        ->get();


        //  dd($damages_data);
        return view('reports.inventory_reports.damage_report_data',compact('current_module','damages_data', 'report_type'));

        }else{

            $current_year = Carbon::now()->format('Y');

            $damages_data = DB::connection('inventory')
                        ->table('damage_and_burned_products')
                        ->leftJoin('products','damage_and_burned_products.product_id','products.id')
                        ->select(
                        'damage_and_burned_products.*',                  
                        'products.product_name as product_name',
                        )
                        ->where('damage_and_burned_products.company_id',$user_company_id)
                        ->whereYear('damage_and_burned_products.entry_date', $current_year)
                        ->get();


            // dd($damages_data);
            return view('reports.inventory_reports.damage_report_data',compact('current_module','damages_data', 'report_type'));
        }

    }



    //purchase_report

    public function purchase_report(){
        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('reports.inventory_reports.purchase_report',compact('current_module'));
    } 

    public function purchase_report_submit(Request $request){

        $report_type = $request->purchase_type;
        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        if($report_type == 1){

            $current_date = Carbon::now()->toDateString();

            $purchases_data = DB::connection('inventory')
                        ->table('product_requisitions')
                        ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                        ->leftJoin('products','product_requisitions.product_id','products.id')
                        ->select(
                        'product_requisitions.*',
                        'requisition_orders.requisition_deliver_date as purchase_receive_date',
                        'products.product_name as product_name'
                        )
                        ->where('requisition_orders.company_id',$user_company_id)
                        ->where('requisition_orders.requisition_deliver_date', $current_date)
                        ->get();

        //    dd($purchases_data);
        return view('reports.inventory_reports.purchase_report_data',compact('current_module','purchases_data', 'report_type'));

        }elseif($report_type == 2){

            $current_month = Carbon::now()->format('m');
            $current_year = Carbon::now()->format('Y');
            
           
            $purchases_data = DB::connection('inventory')
                        ->table('product_requisitions')
                        ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                        ->leftJoin('products','product_requisitions.product_id','products.id')
                        ->select(
                        'product_requisitions.*',
                        'requisition_orders.requisition_deliver_date as purchase_receive_date',
                        'products.product_name as product_name'
                        )
                        ->where('requisition_orders.company_id',$user_company_id)
                        ->whereMonth('requisition_orders.requisition_deliver_date', $current_month)
                        ->whereYear('requisition_orders.requisition_deliver_date', $current_year)
                        ->get();

        //   dd($purchases_data);
          return view('reports.inventory_reports.purchase_report_data',compact('current_module','purchases_data', 'report_type'));

        }else{

            $current_year = Carbon::now()->format('Y');

            $purchases_data = DB::connection('inventory')
                                ->table('product_requisitions')
                                ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                                ->leftJoin('products','product_requisitions.product_id','products.id')
                                ->select(
                                'product_requisitions.*',
                                'requisition_orders.requisition_deliver_date as purchase_receive_date',
                                'products.product_name as product_name'
                                )
                                ->where('requisition_orders.company_id',$user_company_id)
                                ->whereYear('requisition_orders.requisition_deliver_date', $current_year)
                                ->get();


            // dd($purchases_data);
            return view('reports.inventory_reports.purchase_report_data',compact('current_module','purchases_data', 'report_type'));
        }
    }
}
