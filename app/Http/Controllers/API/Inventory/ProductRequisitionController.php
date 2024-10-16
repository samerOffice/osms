<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

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


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('product_requisitions.index',compact('current_module','requisition_orders'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('product_requisitions.index',compact('current_module','requisition_orders','permitted_menus_array'));
                }
 
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

        $products = DB::connection('inventory')
        ->table('products')
        ->where('shop_company_id',$user_company_id)
        ->where('product_status',1)
        ->get();


        // $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                    ->where('user_id',$user_id)
                    ->first();
            if($menu_data == null){
                return view('product_requisitions.new_stock',compact('current_module','user_id','user_name','item_categories','suppliers','warehouses','products'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('product_requisitions.new_stock',compact('current_module','user_id','user_name','item_categories','suppliers','warehouses','products','permitted_menus_array'));
                    }

    }



    public function ProductInfoDependancy(Request $request){

        $selectedProductId = $request->input('data');
        $product = DB::connection('inventory')
                    ->table('products')
                    ->where('id',$selectedProductId)
                    ->first();

        if ($product) {
        $response = [
            'product_unit_type' => $product->product_unit_type,
            'product_details' => $product->additional_product_details,
            'product_weight' => $product->product_weight,
            'product_id' => $product->id
        ];
    } else {
        $response = [
            'product_unit_type' => '',
            'product_details' => '',
            'product_weight' => ''
        ];
    }

        return response()->json($response);       
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
                                'total_amount' => $request->total_amount,
                                'due_amount' => $request->due_amount,
                                'paid_amount' => $request->paid_amount
                                ]);

        $requisition =  DB::connection('inventory')
                        ->table('requisition_orders')
                       ->where('id',$requisition_order)
                       ->first();

        $last_requisition_order = $requisition->requisition_order_id;

        $product_track_ids = $request->product_track_id;
        $product_ids = $request->product_id;
        $product_weights = $request->product_weight;
        $product_unit_types = $request->product_unit_type;
        $product_details = $request->product_details;

        $product_mfg_dates = $request->product_mfg_date;
        $product_expiry_dates = $request->product_expiry_date;
        
        $product_quantities = $request->product_quantity;
        $product_unit_prices = $request->product_unit_price;
        $product_subtotals = $request->product_subtotal;


        foreach ($product_track_ids as $key => $product_track_id) {
            $product_id = $product_ids[$key] ?? null;
            $product_weight = $product_weights[$key] ?? null;
            $product_unit_type = $product_unit_types[$key] ?? null; 
            $product_detail = $product_details[$key] ?? null;

            $product_mfg_date = $product_mfg_dates[$key] ?? null;
            $product_expiry_date = $product_expiry_dates[$key] ?? null;

            $product_quantity = $product_quantities[$key] ?? null;
            $product_unit_price = $product_unit_prices[$key] ?? null;
            $product_subtotal = $product_subtotals[$key] ?? null;

            DB::connection('inventory')
                ->table('product_requisitions')
                ->insert([
                'requisition_order_id' => $last_requisition_order,
                'product_track_id' => $product_track_id,
                'product_id' => $product_id,
                'product_weight' => $product_weight,
                'product_unit_type' => $product_unit_type,
                'product_details' => $product_detail,

                'product_mfg_date' => $product_mfg_date,
                'product_expiry_date' => $product_expiry_date,

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

        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                    ->where('user_id',$user_id)
                    ->first();


        $paid_and_due =  DB::connection('inventory')
                            ->table('requisition_orders')
                            ->select('paid_amount','due_amount')
                            ->where('id',$id)
                            ->first();

        $paid = $paid_and_due->paid_amount;
        $due = $paid_and_due->due_amount;

        if($menu_data == null){
            return view('product_requisitions.edit',compact('current_module','id','paid','due'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('product_requisitions.edit',compact('current_module','id','permitted_menus_array','paid','due'));
                } 

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
                            ->leftJoin('products','product_requisitions.product_id','products.id')
                            ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'requisition_orders.requisition_order_by', '=', 'users.id')
                            ->select(
                                'requisition_orders.*',
                                'product_requisitions.product_track_id as product_track_id',
                                'product_requisitions.product_id as requested_product_id',
                                'products.product_name as requested_product_name',
                                'product_requisitions.product_weight as requested_product_weight',
                                'product_requisitions.product_unit_type as requested_product_unit_type',
                                'product_requisitions.product_details as requested_product_details',

                                'product_requisitions.product_mfg_date as requested_product_mfg_date',
                                'product_requisitions.product_expiry_date as requested_product_expiry_date',

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

    }


    public function productList(){
        $user_company_id = Auth::user()->company_id;
        $products = DB::connection('inventory')
                        ->table('products')
                        ->where('shop_company_id',$user_company_id)
                        ->get();

        return response()->json($products);
    }


    public function requisition_update(Request $request, $id){

        $user_company_id = Auth::user()->company_id;
        
        $requisition =  DB::connection('inventory')
                        ->table('requisition_orders')
                       ->where('id',$id)
                       ->first();
        $requisition_order_id = $requisition->requisition_order_id;

        try {
            $product_track_ids = $request->product_track_id;
            $product_ids = $request->product_id;
            $product_weights = $request->product_weight;
            $product_unit_types = $request->product_unit_type;
            $product_details = $request->product_details;

            $product_mfg_dates = $request->product_mfg_date;
            $product_expiry_dates = $request->product_expiry_date;

            $product_quantities = $request->product_quantity;
            $product_unit_prices = $request->product_unit_price;
            $product_subtotals = $request->product_subtotal;

           // Delete existing records for the given requisition_order_id
                DB::connection('inventory')
                ->table('product_requisitions')
                ->where('requisition_order_id', $requisition_order_id)
                ->delete();

            // Insert new records
            foreach ($product_track_ids as $key => $product_track_id) {
                $product_id = $product_ids[$key] ?? null;
                $product_weight = $product_weights[$key] ?? null;
                $product_unit_type = $product_unit_types[$key] ?? null;
                $product_detail = $product_details[$key] ?? null;

                $product_mfg_date = $product_mfg_dates[$key] ?? null;
                $product_expiry_date = $product_expiry_dates[$key] ?? null;

                $product_quantity = $product_quantities[$key] ?? null;
                $product_unit_price = $product_unit_prices[$key] ?? null;
                $product_subtotal = $product_subtotals[$key] ?? null;

                DB::connection('inventory')
                    ->table('product_requisitions')
                    ->insert([
                        'requisition_order_id' => $requisition_order_id,
                        'product_track_id' => $product_track_id,
                        'product_id' => $product_id,
                        'product_weight' => $product_weight,
                        'product_unit_type' => $product_unit_type,
                        'product_details' => $product_detail,

                        'product_mfg_date' => $product_mfg_date,
                        'product_expiry_date' => $product_expiry_date,

                        'product_quantity' => $product_quantity,
                        'product_unit_price' => $product_unit_price,
                        'product_subtotal' => $product_subtotal
                    ]);
            }


            $total_amount_update = DB::connection('inventory')
                                ->table('requisition_orders')
                                ->where('requisition_order_id', $requisition_order_id)
                                ->update([
                                    'total_amount' => $request->total_amount,
                                    'due_amount' => $request->due_amount,
                                    'paid_amount' => $request->paid_amount
                                ]);

            return response()->json(['message' => 'Product Order is updated successfully'], 200);
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Data', 'details' => $e->getMessage()], 500);
        }  

    }


    public function requisition_view($id){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

         $user_id = Auth::user()->id;
         $user_name = Auth::user()->name;
         $user_email = Auth::user()->email;
         $user_company_id = Auth::user()->company_id;

         $requisition_order = DB::connection('inventory')
         ->table('requisition_orders')
         ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'requisition_orders.requisition_order_by', '=', 'users.id')
         ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
         ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.companies', 'requisition_orders.shop_company_id', '=', 'companies.id')
         ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.designations', 'users.designation', '=', 'designations.id')
         ->leftJoin('warehouses', 'requisition_orders.warehouse_id', '=', 'warehouses.id')
         ->select(
             'requisition_orders.*',
             'suppliers.full_name as supplier_name',
             'users.name as requisition_order_by_name',
             'users.email as requisition_order_by_email',
             'suppliers.official_address as supplier_official_address',       
             'suppliers.mobile_number as supplier_mobile_number',
             'companies.company_name as company_name',
             'designations.designation_name as designation_name',
             'warehouses.warehouse_name as warehouse_name',
             )            
         ->where('requisition_orders.id',$id)
         ->first();

         $product_requisitions = DB::connection('inventory')
                                ->table('product_requisitions')
                                ->leftJoin('products','product_requisitions.product_id','products.id')
                                ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                                ->select('product_requisitions.*', 'products.product_name as product_name')
                                ->where('requisition_orders.id',$id)
                                ->get();

        //  dd($product_requisitions);
        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                    ->where('user_id',$user_id)
                    ->first();
            if($menu_data == null){
                return view('product_requisitions.view',compact('current_module','user_name','user_email','requisition_order','product_requisitions','id'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('product_requisitions.view',compact('current_module','user_name','user_email','requisition_order','product_requisitions','id','permitted_menus_array'));
                    }

    }


    public function requisition_order_decline(Request $request){

        $user_id = Auth::user()->id;
        $requisition_id = $request->declined_requisition_id;
        $decline_reason = $request->requisition_decline_reason;
        
        $update = DB::connection('inventory')
        ->table('requisition_orders')
        ->where('id', $requisition_id)
        ->update([
            'requisition_reviewed_by' => $user_id,
            'requisition_status' => 2,
            'requisition_decline_reason' => $decline_reason,
        ]);

        return redirect()->route('requisition_list')->withSuccess('Order is reviewed successfully'); 
    }


    public function requisition_order_receive(Request $request){

        $user_id = Auth::user()->id;
        $requisition_id = $request->approved_requisition_id;
        
        $update = DB::connection('inventory')
                    ->table('requisition_orders')
                    ->where('id', $requisition_id)
                    ->update([
                        'requisition_reviewed_by' => $user_id,
                        'requisition_status' => 3,
                        'requisition_deliver_date' => Carbon::now()->format('Y-m-d')
                    ]);

        $order_track = DB::connection('inventory')
                        ->table('requisition_orders')
                        ->where('id',$requisition_id)
                        ->where('requisition_status',3)
                        ->first();

        $company_id = $order_track->shop_company_id;
        $warehouse_id = $order_track->warehouse_id;
        $requisition_reviewed_by = $order_track->requisition_reviewed_by;
        $product_deliver_date = $order_track->requisition_deliver_date;
        $order_track_id = $order_track->requisition_order_id;



        $purchased_products = DB::connection('inventory')
                            ->table('product_requisitions')
                            ->where('requisition_order_id',$order_track_id)
                            ->get();


        foreach($purchased_products as $purchased_product){
            $stocks = DB::connection('inventory')
                        ->table('stocks')
                        ->insertGetId([
                            'product_id' => $purchased_product->product_id,
                            'company_id' => $company_id,
                            'warehouse_id' => $warehouse_id,
                            'product_mfg_date' => $purchased_product->product_mfg_date,
                            'product_expiry_date' => $purchased_product->product_expiry_date,
                            'quantity' => $purchased_product->product_quantity,
                            'product_unit_price' => $purchased_product->product_unit_price,
                            'product_subtotal' => $purchased_product->product_subtotal,
                            'purchase_date' => $product_deliver_date,
                            'product_stored_by' => $requisition_reviewed_by              
                            ]);
        }
       
        return redirect()->route('requisition_list')->withSuccess('Order is reviewed successfully'); 
    }



    //inventory dashboard chart data
    public function monthlySalesPurchases(){

        $user_company_id = Auth::user()->company_id;
        $current_year = Carbon::now()->format('Y');

        //----purchase sum start
        $purchases_by_month = DB::connection('inventory')
            ->table('requisition_orders')
            ->select(DB::raw('MONTH(requisition_deliver_date) as month'), DB::raw('SUM(total_amount) as total_purchase'))
            ->whereYear('requisition_deliver_date', $current_year)
            ->where('company_id', $user_company_id)
            ->groupBy(DB::raw('MONTH(requisition_deliver_date)'))
            ->orderBy('month')
            ->get();

        // Initialize an array with all months set to 0
        $monthly_purchases = array_fill(1, 12, 0);

        // Populate the array with actual data
        foreach ($purchases_by_month as $purchase) {
            $monthly_purchases[$purchase->month] = $purchase->total_purchase;
        }
        //----purchase sum end


        //----sale sum start
        $sales_by_month = DB::connection('pos')
            ->table('invoices')
            ->select(DB::raw('MONTH(invoice_date) as month'), DB::raw('SUM(paid_amount) as total_sale'))
            ->whereYear('invoice_date', $current_year)
            ->where('company_id', $user_company_id)
            ->groupBy(DB::raw('MONTH(invoice_date)'))
            ->orderBy('month')
            ->get();

        // Initialize an array with all months set to 0
        $monthly_sales = array_fill(1, 12, 0);

        // Populate the array with actual data
        foreach ($sales_by_month as $sale) {
            $monthly_sales[$sale->month] = $sale->total_sale;
        }
        //----sale sum end


        return response()->json([
             'sales' => array_values($monthly_sales),
            'purchases' => array_values($monthly_purchases)
        ]);
    }


    public function totalAvailableProducts(){
        $user_company_id = Auth::user()->company_id;
        
        // Total number of products
        $total_products = DB::connection('inventory')
                            ->table('products')
                            ->where('shop_company_id', $user_company_id)
                            ->count('id');
                            
        // Total number of available products
        $total_available_products = DB::connection('inventory')
                                      ->table('products')
                                      ->where('shop_company_id', $user_company_id)
                                      ->where('product_status', 1)
                                      ->count('id');
    
        // Calculate the percentage of available products
        $percentage = $total_products > 0 ? ($total_available_products / $total_products) * 100 : 0;
    
        return response()->json([
            'percentage' => $percentage,
        ]);
    }


    


    public function totalNearExpiredProducts(){
        $user_company_id = Auth::user()->company_id;
    
        // Get the current date and time
        $today = Carbon::now();
    
        // Calculate the date one month from today
        $oneMonthFromNow = $today->addMonth()->toDateString();
    
        // Reset $today to the current date again, because `addMonth()` modifies the original Carbon instance
        $today = Carbon::now()->toDateString();
    
        // Total number of products
        $total_products = DB::connection('inventory')
                            ->table('stocks')
                            ->where('company_id', $user_company_id)
                            ->count('id');
    
        // Total number of near-expired products
        $total_near_expired_products = DB::connection('inventory')
                                         ->table('stocks')
                                         ->where('company_id', $user_company_id)
                                         ->whereBetween('product_expiry_date', [$today, $oneMonthFromNow])
                                         ->count('id');
    
        // Calculate the percentage of near-expired products
        $percentage = $total_products > 0 ? ($total_near_expired_products / $total_products) * 100 : 0;
    
        return response()->json([
            'percentage' => $percentage,
        ]);
    }

    public function totalDamagedProducts(){
        $user_company_id = Auth::user()->company_id;
    
        // Get the current month
        $current_month = Carbon::now()->format('m');
    
        // Total number of damaged products for the current month
        $total_damaged_products = DB::connection('inventory')
                                    ->table('damage_and_burned_products')
                                    ->where('company_id', $user_company_id)
                                    ->whereMonth('entry_date', $current_month)
                                    ->sum('quantity');
    
        // Total number of products in stock
        $total_products = DB::connection('inventory')
                            ->table('stocks')
                            ->where('company_id', $user_company_id)
                            ->sum('quantity');
    
        // Calculate the percentage of damaged products
        $percentage = $total_products > 0 ? ($total_damaged_products / $total_products) * 100 : 0;
    
        return response()->json([
            'percentage' => $percentage,
        ]);
    }


}
