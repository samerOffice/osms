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
       
        $requisition_orders = DB::connection('inventory')
                            ->table('requisition_orders') 
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'requisition_orders.requisition_order_by', '=', 'users.id')
                            ->select(
                                'requisition_orders.*',
                                'suppliers.full_name as supplier_name',
                                'users.name as order_by'
                                )            
                            ->where('requisition_orders.company_id',$user_company_id)
                            ->get();

        return view('product_requisitions.index',compact('current_module','requisition_orders'));
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
                        ->where('active_status',1)
                        ->get();

        $warehouses = DB::connection('inventory')
                        ->table('warehouses')
                        ->where('company_id',$user_company_id)
                        ->where('warehouse_status',1)
                        ->get();

        return view('product_requisitions.new_stock',compact('current_module','user_id','user_name','item_categories','suppliers','warehouses'));
    }

    public function requisition_store(Request $request){

        $user_company_id = Auth::user()->company_id;
        $get_supplier_id = $request->supplier_id;

        if($get_supplier_id == 'new'){       
            $supplier_id = DB::table('suppliers')
            ->insertGetId([
            'company_id' => $user_company_id,
            'full_name' => $request->full_name,
            'mobile_number' => $request->mobile_number,
            'official_address' => $request->official_address,
            'active_status' => '1',
            ]);
        }else{
            $supplier_id = $get_supplier_id;
        }

        $requisition_order = DB::connection('inventory')
                            ->table('requisition_orders')
                            ->insertGetId([
                                'company_id' => $user_company_id,
                                'requisition_type' => 1,
                                'requisition_order_id' => $request->requisition_order_id,
                                'requisition_order_date' => $request->requisition_order_date,
                                'shop_company_id' => $user_company_id,
                                'warehouse_id' => $request->warehouse_id,
                                'requisition_order_by' => $request->requisition_order_by,
                                'supplier_id' => $supplier_id,
                                'requisition_status' => 1,
                                'total_amount' => $request->total_amount
                                ]);

        $requisition =  DB::connection('inventory')
                        ->table('requisition_orders')
                       ->where('id',$requisition_order)
                       ->first();

        $last_requisition_order = $requisition->requisition_order_id;

        $product_track_ids = $request->product_track_id;
        $product_names = $request->product_name;
        $product_weights = $request->product_weight;
        $product_unit_types = $request->product_unit_type;
        $product_details = $request->product_details;
        $product_quantities = $request->product_quantity;
        $product_unit_prices = $request->product_unit_price;
        $product_subtotals = $request->product_subtotal;


        foreach ($product_track_ids as $key => $product_track_id) {
            $product_name = $product_names[$key] ?? null;
            $product_weight = $product_weights[$key] ?? null;
            $product_unit_type = $product_unit_types[$key] ?? null; 
            $product_detail = $product_details[$key] ?? null;
            $product_quantity = $product_quantities[$key] ?? null;
            $product_unit_price = $product_unit_prices[$key] ?? null;
            $product_subtotal = $product_subtotals[$key] ?? null;

            DB::connection('inventory')
                ->table('product_requisitions')
                ->insert([
                'requisition_order_id' => $last_requisition_order,
                'product_track_id' => $product_track_id,
                'product_name' => $product_name,
                'product_weight' => $product_weight,
                'product_unit_type' => $product_unit_type,
                'product_details' => $product_detail,
                'product_quantity' => $product_quantity,
                'product_unit_price' => $product_unit_price,          
                'product_subtotal' => $product_subtotal          
            ]);        
        }
        $response = [
            'success' => true,
            'message' => 'Order is added successfully'
        ];

        return response()->json($response,200);
    }


    public function requisition_edit_data($id){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        return view('product_requisitions.edit',compact('current_module','id'));
    }

    
    public function requisition_edit($id){

        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $requisition_order = DB::connection('inventory')
                            ->table('product_requisitions')
                            ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'requisition_orders.requisition_order_by', '=', 'users.id')
                            ->select(
                                'requisition_orders.*',
                                'product_requisitions.product_track_id as product_track_id',
                                'product_requisitions.product_name as requested_product_name',
                                'product_requisitions.product_weight as requested_product_weight',
                                'product_requisitions.product_unit_type as requested_product_unit_type',
                                'product_requisitions.product_details as requested_product_details',
                                'product_requisitions.product_quantity as requested_product_quantity',
                                'product_requisitions.product_unit_price as requested_product_unit_price',
                                'product_requisitions.product_subtotal as requested_product_subtotal',                                
                                'suppliers.full_name as supplier_name',
                                'users.name as order_by'
                                )               
                            ->where('requisition_orders.id',$id)
                            ->get();


            //  dd($requisition_order);

             return response()->json($requisition_order, 200);

        // $response = [
        //     'requisition_order_details' => $item_category
        //     ];
        //    return response()->json($response,200);

    }


    public function requisition_update($id){
        
    }




}
