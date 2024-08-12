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


    public function damage_product($id){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

       
    
          $damage_product = DB::connection('inventory')
                            ->table('stocks')
                            ->leftJoin('products','stocks.product_id','products.id')
                            ->select(
                                'stocks.*',
                                'products.product_name as stock_product_name',
                                'products.product_weight as stock_product_weight',
                                'products.product_unit_type as stock_product_unit_type',
                                'products.additional_product_details as stock_product_details'      
                                ) 
                            ->where('stocks.id', $id)
                            ->first();
        
         return view('stocks.damage_product',compact('current_module','damage_product'));
    }















    public function update_damage_product(Request $request, $id){    
        
        
        $damage_product_quantity = $request->damage_product;

        $current_product_quantity = DB::connection('inventory')
                                    ->table('stocks')
                                    ->select('quantity')
                                    ->where('id', $id)
                                    ->first();
        
        $current_product_quantity_in_stock = $current_product_quantity->quantity;

        $updated_quantity = ($current_product_quantity_in_stock) - ($damage_product_quantity);

        // Update the stock quantity in the stocks table
       $updated_stock = DB::connection('inventory')
            ->table('stocks')
            ->where('id', $id)
            ->update(['quantity' => $updated_quantity]);

            $user_company_id = Auth::user()->company_id;
            $store_damage_product = DB::connection('inventory')
                                    ->table('damage_and_burned_products')
                                            ->insertGetId([
                                            'entry_date'=>Carbon::now()->toDateString(),
                                            'stock_id'=>$id,                                           
                                            'quantity'=>$damage_product_quantity    
                                            ]);
    
            $response = [
                'success' => true,
                'message' => 'Damaged Product is added successfully'
            ];
    
            return response()->json($response,200);
        
           
    }

















    public function add_barcode(Request $request, $stock_id){
        
        $barcode = $request->input('barcode');
        $user_company_id = Auth::user()->company_id;

        $check = DB::connection('inventory')
                 ->table('barcodes_and_skus')
                 ->select('barcode')
                 ->where('stock_id',$stock_id)
                 ->first();
        

        if($check === null){

            $store = DB::connection('inventory')
                        ->table('barcodes_and_skus')
                        ->insertGetId([
                        'stock_id'=>$stock_id,
                        'company_id'=>$user_company_id,
                        'barcode'=>$barcode   
                        ]);

            $label_data = ['label_status' => 1];   
            $update_labeling = DB::connection('inventory')
                        ->table('stocks')
                        ->where('id', $stock_id)
                        ->update($label_data);

            $response = [
                'success' => true,
                'message' => 'Barcode is added successfully'
            ];
    
            return response()->json($response,200);
        }else{        
            try {

                $data = ['barcode' => $barcode];
                $updated = DB::connection('inventory')
                            ->table('barcodes_and_skus')
                            ->where('stock_id', $stock_id)
                            ->update($data);

                $label_data = ['label_status' => 1];   
                $update_labeling = DB::connection('inventory')
                            ->table('stocks')
                            ->where('id', $stock_id)
                            ->update($label_data);
            
                // Check if the update was successful
                if ($updated) {
                    // Return a success response
                    return response()->json(['message' => 'Barcode is updated successfully'], 200);
                } else {
                    // Return a failure response
                    return response()->json([
                        'message' => 'Barcode update failed or no changes were made'
                    ], 400);
                }
            } catch (\Exception $e) {
                // Catch any exceptions and return an error response
                return response()->json(['error' => 'An error occurred while updating the barcode', 'details' => $e->getMessage()], 500);
            } 
        }
           
    }

    public function delete_barcode(Request $request, $stock_id)
    {
    	// $id = $request->id;
        $deleted = DB::connection('inventory')
                    ->table('barcodes_and_skus')
                    ->where('stock_id', $stock_id)
                    ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Barcode is Deleted Successfully !']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Barcode Failed To Deleted !']);
                }

    }



    public function add_sku(Request $request, $stock_id){
        
        $sku = $request->input('skui');
        $user_company_id = Auth::user()->company_id;

        $check = DB::connection('inventory')
                 ->table('barcodes_and_skus')
                 ->select('sku')
                 ->where('stock_id',$stock_id)
                 ->first();
        

        if($check === null){
            $store = DB::connection('inventory')
                        ->table('barcodes_and_skus')
                        ->insertGetId([
                        'stock_id'=>$stock_id,
                        'company_id'=>$user_company_id,
                        'sku'=>$sku    
                        ]);

            $label_data = ['label_status' => 1];   
            $update_labeling = DB::connection('inventory')
                        ->table('stocks')
                        ->where('id', $stock_id)
                        ->update($label_data);

            $response = [
                'success' => true,
                'message' => 'SKU is added successfully'
            ];
    
            return response()->json($response,200);
        }else{           
            try {

                $data = ['sku' => $sku];
                $updated = DB::connection('inventory')
                            ->table('barcodes_and_skus')
                            ->where('stock_id', $stock_id)
                            ->update($data);

                $label_data = ['label_status' => 1];   
                $update_labeling = DB::connection('inventory')
                            ->table('stocks')
                            ->where('id', $stock_id)
                            ->update($label_data);
            
                // Check if the update was successful
                if ($updated) {
                    // Return a success response
                    return response()->json(['message' => 'SKU is updated successfully'], 200);
                } else {
                    // Return a failure response
                    return response()->json([
                        'message' => 'SKU update failed or no changes were made'
                    ], 400);
                }
            } catch (\Exception $e) {
                // Catch any exceptions and return an error response
                return response()->json(['error' => 'An error occurred while updating the barcode', 'details' => $e->getMessage()], 500);
            } 
        }
           
    }


    public function delete_sku(Request $request, $stock_id)
    {
    	// $id = $request->id;
        $deleted = DB::connection('inventory')
                    ->table('barcodes_and_skus')
                    ->where('stock_id', $stock_id)
                    ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'SKU is Deleted Successfully !']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'SKU Failed To Deleted !']);
                }

    }


}
