<?php

namespace App\Http\Controllers\API\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    

    public function sale_list(){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;

        $sales = DB::connection('pos')
                        ->table('invoices')
                        ->where('company_id',$user_company_id)
                        ->orderBy('id', 'DESC')
                        ->get();


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('invoices.index',compact('current_module','sales'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('invoices.index',compact('current_module','sales','permitted_menus_array'));
                }
  
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

                    
        $menu_data = DB::table('menu_permissions')
                            ->where('user_id',$user_id)
                            ->first();
                            
        if($menu_data == null){
            return view('invoices.create',compact('current_module','user_id','user_name','customers','outlets','products'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('invoices.create',compact('current_module','user_id','user_name','customers','outlets','products','permitted_menus_array'));
                }

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
                            // ->where('stocks.quantity','>', 0)
                            ->first();     

            if ($stock_product) {
            $response = [
                'product_name' => $stock_product->stock_product_name,
                'product_weight' => $stock_product->stock_product_weight,
                'product_unit_type' => $stock_product->stock_product_unit_type,
                'product_details' => $stock_product->stock_product_details,
                'product_mfg_date' => $stock_product->product_mfg_date,
                'product_expiry_date' => $stock_product->product_expiry_date,
                'product_quantity' => $stock_product->quantity,
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



      public function sale_store(Request $request){

        $user_company_id = Auth::user()->company_id;
        $get_customer_id = $request->customer_id;

        $random_number = rand(1000, 9999);
        $membership_id = 'Member-'.$user_company_id.'-'.$random_number;

        if($get_customer_id == 'new'){      
            $customer_id = DB::connection('pos')
                            ->table('customers')
                            ->insertGetId([
                            'company_id' => $user_company_id,
                            'customer_name' => $request->customer_name,
                            'membership_id' => $membership_id,
                            'customer_phone_number' => $request->customer_phone_number,
                            'customer_email' => $request->customer_email,
                            'registration_date' => Carbon::now()->toDateString(),
                            'active_status' => '1',
                            ]);
        }else{
            $customer_id = $get_customer_id;
        }

        $invoice = DB::connection('pos')
                    ->table('invoices')
                    ->insertGetId([
                        'invoice_date' => Carbon::now()->toDateString(),
                        'invoice_track_id' => $request->sale_order_id,
                        'company_id' => $user_company_id,
                        'outlet_id' => $request->outlet_id,
                        'customer_id' => $customer_id,
                        'emp_id' => $request->sale_by,
                        'payment_method_id' => $request->payment_id,
                        'total_amount' => $request->total_amount,
                        'tax_amount' => $request->tax_amount,
                        'discount_amount' => $request->discount_amount,
                        'grand_total' => $request->grand_total,
                        'due_amount' => $request->due_amount,
                        'paid_amount' => $request->paid_amount,
                        'payment_status' => 1,
                        ]);

        // $invoice_data =  DB::connection('pos')
        //                     ->table('invoices')
        //                     ->where('id',$invoice)
        //                     ->first();

        // $invoice_id = $invoice_data->id;

        
        $stock_ids = $request->stock_product_id;   
        $product_quantities = $request->product_quantity;
        $product_unit_prices = $request->product_unit_price;
        $sale_unit_prices = $request->product_unit_price_sale;
        $product_subtotals = $request->product_subtotal;


        foreach ($stock_ids as $key => $stock_id) {
           
            $product_quantity = $product_quantities[$key] ?? null;
            $product_unit_price = $product_unit_prices[$key] ?? null;
            $sale_unit_price = $sale_unit_prices[$key] ?? null;
            $product_subtotal = $product_subtotals[$key] ?? null;

            DB::connection('pos')
                ->table('invoice_items')
                ->insert([
                'invoice_date' => Carbon::now()->toDateString(),
                'invoice_id' => $invoice,
                'stock_id' => $stock_id,
                'quantity' => $product_quantity,
                'unit_price' => $product_unit_price,         
                'sale_unit_price' => $sale_unit_price,         
                'sub_total' => $product_subtotal          
            ]); 
                  
         $latest_stock_quantity = DB::connection('inventory')
                                  ->table('stocks')
                                  ->select('quantity')
                                  ->where('id',$stock_id)
                                  ->first();

        if ($latest_stock_quantity){
        // Calculate the new stock quantity
        $new_stock_quantity = $latest_stock_quantity->quantity - $product_quantity;

        // Update the stock quantity in the stocks table
        DB::connection('inventory')
            ->table('stocks')
            ->where('id', $stock_id)
            ->update(['quantity' => $new_stock_quantity]);
        }

        }

        $response = [
            'success' => true,
            'message' => 'Sale is added successfully',
            'invoice_id' => $invoice
        ];

         return response()->json($response,200);

        // return redirect()->route('invoice_show_data',[
        //     'invoice_id' => $invoice
        //     ]);
    }

      public function invoice_show_data($invoice_id){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        

        $invoice_data = DB::connection('pos')
                            ->table('invoices')
                            ->leftJoin('outlets','invoices.outlet_id','outlets.id')
                            ->leftJoin('customers','invoices.customer_id','customers.id')
                            // ->leftJoin('payment_methods','invoices.payment_method_id','payment_methods.id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.companies', 'invoices.company_id', '=', 'companies.id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.branches', 'invoices.branch_id', '=', 'branches.id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'invoices.emp_id', '=', 'users.id')
                            ->select(
                                'invoices.invoice_date as invoice_date',
                                'invoices.invoice_track_id as invoice_order_number',
                                'invoices.total_amount as invoice_total_amount',
                                'invoices.tax_amount as invoice_tax_amount',
                                'invoices.discount_amount as invoice_discount_amount',
                                'invoices.grand_total as invoice_grand_total',
                                'invoices.due_amount as invoice_due_amount',
                                'invoices.paid_amount as invoice_paid_amount',
                                'invoices.terms_and_conditions as invoice_terms_and_conditions',
                                'invoices.payment_status as invoice_payment_status',
                                'invoices.payment_method_id as payment_method',

                                'users.name as sale_by',

                                'companies.company_name as shop_name',
                                'companies.company_address as shop_address',
                                'companies.contact_no as shop_contact_no',
                                
                                'branches.br_name as branch_name',

                                'outlets.outlet_name as shop_outlet_name',
                                'outlets.outlet_address as shop_outlet_address',

                                'customers.customer_name as buyer_name',
                                'customers.customer_phone_number as buyer_number',
                                'customers.membership_id as membership_number'
                            )

                            ->where('invoices.id', $invoice_id)
                             ->first();
// dd($invoice_data);

        $item_data = DB::connection('pos')
                    ->table('invoice_items')
                    ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.stocks', 'invoice_items.stock_id', '=', 'stocks.id')
                    ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.products', 'stocks.product_id', '=', 'products.id')                   
                    ->select(
                        'invoice_items.*',
                        'products.product_name as sold_product_name'                 
                        )
                    ->where('invoice_id',$invoice_id)
                    ->get();

            
        $user_company_id = Auth::user()->company_id;
        
        $terms_and_conditions = DB::connection('pos')
                                ->table('terms_and_conditions')
                                ->where('company_id',$user_company_id)
                                ->first();
            
        
        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                        ->where('user_id',$user_id)
                        ->first();
        if($menu_data == null){
            return view('invoices.show_invoice',compact('current_module','invoice_data','item_data','terms_and_conditions'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('invoices.show_invoice',compact('current_module','invoice_data','item_data','terms_and_conditions','permitted_menus_array'));
                }
        }




    public function previousAndCurrentMonthSale(){

        $user_company_id = Auth::user()->company_id;

        $current_date = Carbon::now();

        // Get the previous month
        $previous_month = $current_date->subMonth()->format('m');
        
       
        $previous_month_sale = DB::connection('pos')
                                ->table('invoices')
                                ->whereMonth('invoice_date',$previous_month)
                                ->whereYear('invoice_date', $current_date->year) // Ensure it's the previous month of the same year
                                ->where('company_id',$user_company_id)
                                ->sum('paid_amount');



        $current_month = Carbon::now()->format('m');

        $current_month_sale = DB::connection('pos')
                                ->table('invoices')
                                ->whereMonth('invoice_date',$current_month)
                                ->whereYear('invoice_date', $current_date->year) // Ensure it's the current year
                                ->where('company_id',$user_company_id)
                                ->sum('paid_amount');

                            
        return response()->json([
            'previous_month_sale' => $previous_month_sale,
            'current_month_sale' => $current_month_sale
        ]);
    }



    public function currentYearSale()
    {
        $user_company_id = Auth::user()->company_id;
        $current_year = date('Y');
    
        $sales = DB::connection('pos')
            ->table('invoices')
            ->select(DB::raw('MONTH(invoice_date) as month'), DB::raw('SUM(paid_amount) as total_sale'))
            ->whereYear('invoice_date', $current_year)
            ->where('company_id', $user_company_id)
            ->groupBy(DB::raw('MONTH(invoice_date)'))
            ->orderBy('month')
            ->get();
    
        // Initialize an array with all months set to 0
        $months = array_fill(1, 12, 0);
    
        // Populate the array with actual data
        foreach ($sales as $sale) {
            $months[$sale->month] = $sale->total_sale;
        }
    
        // Prepare labels and values for the chart
        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $labels = $monthNames;
        $values = array_values($months);
    
        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }

  
}
