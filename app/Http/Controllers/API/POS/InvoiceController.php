<?php

namespace App\Http\Controllers\API\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    

    public function product_and_price_dependancy(Request $request){

        $selectedProductId = $request->input('data');
        $product = DB::connection('inventory')
                    ->table('products')
                    ->where('id',$selectedProductId)
                    ->first();

        $product_price = $product->product_single_price;
  
    //   $str="<option value=''>-- Select --</option>";
    //   foreach ($product_categories as $product_category) {
    //      $str .= "<option value='$product_category->id'> $product_category->name </option>";
         
    //   }
      echo $product_price;
      }



      public function new_invoice(){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $user_company_id = Auth::user()->company_id;


        // $item_categories = DB::connection('inventory')
        // ->table('item_categories')
        // ->where('company_id',$user_company_id)
        // ->get();

        $customers = DB::connection('pos')
                        ->table('customers')
                        ->where('company_id',$user_company_id)
                        ->where('active_status',1)
                        ->get();

        $outlets = DB::connection('pos')
                        ->table('outlets')
                        ->where('company_id',$user_company_id)
                        ->where('outlet_status',1)
                        ->get();

        $products = DB::connection('inventory')
                    ->table('products')
                    ->where('shop_company_id',$user_company_id)
                    ->where('product_status',1)
                    ->get();

        return view('invoices.create',compact('current_module','user_id','user_name','customers','outlets','products'));
    }



    public function SkuProductInfoDependancy(Request $request){

            $selectedSku = $request->input('data');
            $stock = DB::connection('inventory')
                        ->table('barcodes_and_skus')
                        ->select('stock_id')
                        ->where('sku',$selectedSku)
                        ->first();

            $stock_id = $stock->stock_id;

            $stock_product = DB::connection('inventory')
                            ->table('stocks')
                            ->leftJoin('products','stocks.product_id','products.id')
                            ->select('stocks.*',
                            'products.product_name as stock_product_name',
                            'products.product_weight as stock_product_weight',
                            'products.product_unit_type as stock_product_unit_type',                           
                            'products.additional_product_details as stock_product_details'                           
                            )
                            ->where('stocks.id',$stock_id)
                            ->first();     

            if ($stock_product) {
            $response = [
                'product_name' => $stock_product->stock_product_name,
                'product_weight' => $stock_product->stock_product_weight,
                'product_unit_type' => $stock_product->stock_product_unit_type,
                'product_details' => $stock_product->stock_product_details,
                'product_mfg_date' => $stock_product->product_mfg_date,
                'product_expiry_date' => $stock_product->product_expiry_date,
                'product_unit_price' => $stock_product->product_unit_price,
                'product_subtotal' => $stock_product->product_subtotal,
                'stock_id' => $stock_product->id
            ];
        } else {
            $response = [
                'product_name' => '',
                'product_weight' => '',
                'product_unit_type' => '',
                'product_details' => '',
                'product_mfg_date' => '',
                'product_expiry_date' => '',
                'product_unit_price' => '',
                'stock_id' => ''
            ];
        }

            return response()->json($response);       
      }




    public function add_invoice(){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $user_company_id = Auth::user()->company_id;

        $products = DB::connection('inventory')
                           ->table('products')
                           ->where('shop_company_id',$user_company_id)
                           ->get();

        return view('invoices.create',compact('current_module','products'));
    }

     ///// note :: must be update after 22/05/2024 
     public function submit_invoice(Request $request){
        $user_id = Auth::user()->id;
        $user_company_id = Auth::user()->company_id;
       
        $item_category = DB::connection('pos')
                        ->table('invoices')
                        ->insertGetId([
                        'invoice_date' =>$request->invoice_date,
                        'product_id' =>$request->product_id,
                        'emp_id' =>$user_id,
                        'payment_method_id' =>$request->payment_method_id,
                        'sub_total' =>$request->sub_total,
                        'discount_amount' =>$request->discount_amount,
                        'total_amount' =>$request->total_amount,
                        'company_id' =>$user_company_id                
                        ]);

        // $response = [
        //     'success' => true,
        //     'message' => 'Invoice is added successfully'
        // ];

        // return response()->json($response,200);


        return redirect()->route('invoice_show_data');
    }


    public function invoice_show_data(){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $last_inserted_data = DB::connection('pos')
                             ->table('invoices')
                             ->orderBy('id', 'desc')
                             ->first();

        $last_inserted_id = $last_inserted_data->id;


        $result = DB::connection('pos')
                    ->table('invoices')
                    ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.products', 'invoices.product_id', '=', 'products.id')
                    ->select('products.product_name','invoices.*')
                    ->where('invoices.id',$last_inserted_id)
                    ->first();

        // dd($result);


          $result = (array) $result;
          $filteredData = array_filter($result, function($value) {
            return $value != 0;
        });


        // $member_name = $filteredData['member_name'] ?? null;
        // $member_id = $filteredData['member_id'] ?? null;
        // $member_designation_name = $filteredData['member_designation_name'] ?? null;
        // $member_br_name = $filteredData['member_br_name'] ?? null;
     

        // Pass the filtered data to the Blade view
        return view('invoices.show_invoice',compact('filteredData','current_module','last_inserted_id'));
    }
}
