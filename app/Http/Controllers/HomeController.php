<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
   //user login ui/ux
   public function index(){     
       return view('auth_login');
    }

    //user registration ui/ux
    public function registration(){
      $divisions = DB::table('divisions')->get();

      $roles = DB::table('roles')
               ->where('id',2)
               ->first();

      $designations = DB::table('designations')->get();
      $business_types = DB::table('business_types')->get();
      return view('auth_register',compact('divisions','roles','designations','business_types'));
    }

    //user dashboard ui/ux
    public function dashboard(){

      $current_modules = array();
      $current_modules['module_status'] = '1';
      $update_module = DB::table('current_modules')
                  // ->where('id', $request->id)
                  ->update($current_modules);
      
      $current_module = DB::table('current_modules')->first();

      $user_company_id = Auth::user()->company_id;

      $total_branch = DB::table('branches')
      ->where('company_id',$user_company_id)
      ->count('id');

      $total_department = DB::table('departments')
            ->where('company_id',$user_company_id)
            ->count('id');


      $total_warehouse = DB::connection('inventory')
              ->table('warehouses')
              ->where('company_id',$user_company_id)
              ->count('id');


      $total_outlet = DB::connection('pos')
              ->table('outlets')
              ->where('company_id',$user_company_id)
              ->count('id');


      return view('dashboard',compact('current_module',
                                      'total_branch',
                                      'total_department',
                                      'total_warehouse',
                                      'total_outlet'
                                    ));
    }


    public function division(Request $request){

      $selectedDivision = $request->input('data');
      $districts = DB::table('districts')
                  ->where('division_id',$selectedDivision)
                  ->get();

    $str="<option value=''>-- Select --</option>";
    foreach ($districts as $district) {
       $str .= "<option value='$district->id'> $district->name </option>";
       
    }
    echo $str;
    }

    public function pos_module_active(){
      // dd( $request->current_module_status);
      $current_modules = array();
      $current_modules['module_status'] = 4;
      $update_module = DB::table('current_modules')
                   ->where('id', 1)
                  ->update($current_modules);
      $current_module = DB::table('current_modules')->first();


      //----------- top seller and top selling information start ----------------------

      $user_role_id = Auth::user()->role_id;
      $user_company_id = Auth::user()->company_id;
      $current_month = Carbon::now()->format('m');
      
      if($user_role_id == 1){

        $top_seller_info = DB::connection('pos')
                ->table('invoices')
                ->select('emp_id', DB::raw('SUM(paid_amount) as total_sales'))
                ->whereMonth('invoice_date', $current_month)
                // ->where('company_id',$user_company_id)
                ->groupBy('emp_id')
                ->orderByDesc('total_sales')
                ->first();

          if($top_seller_info){

            $top_seller_id = $top_seller_info->emp_id;
            $max_selling_amount = $top_seller_info->total_sales;
      
            $top_seller = DB::table('users')
                              ->select('name')
                              ->where('id',$top_seller_id)
                              ->first();
      
            // $top_seller_name = $top_seller->name;
            $top_seller_name = $top_seller ? $top_seller->name : 'N/A';
            
            $designation = DB::table('users')
                                  ->leftJoin('designations','users.designation','designations.id')
                                  ->select('designations.designation_name as seller_designation')
                                  ->where('users.id',$top_seller_id)
                                  ->first();
            // $top_seller_designation = $designation->seller_designation;
            $top_seller_designation = $designation ? $designation->seller_designation : 'N/A';

          }else{

            // Handle the case where $top_seller_info is null
            $top_seller_id = null;
            $max_selling_amount = 0; // Or a default value as needed
            $top_seller_name = 'N/A';
            $top_seller_designation = 'N/A';
          }

        
      }else{

        $top_seller_info = DB::connection('pos')
                        ->table('invoices')
                        ->select('emp_id', DB::raw('SUM(paid_amount) as total_sales'))
                        ->whereMonth('invoice_date', $current_month)
                        ->where('company_id',$user_company_id)
                        ->groupBy('emp_id')
                        ->orderByDesc('total_sales')
                        ->first();


        if($top_seller_info){

          $top_seller_id = $top_seller_info->emp_id;
          $max_selling_amount = $top_seller_info->total_sales;
    
          $top_seller = DB::table('users')
                            ->select('name')
                            ->where('id',$top_seller_id)
                            ->first();
    
          $top_seller_name = $top_seller ? $top_seller->name : 'N/A';
          
          $designation = DB::table('users')
                                ->leftJoin('designations','users.designation','designations.id')
                                ->select('designations.designation_name as seller_designation')
                                ->where('users.id',$top_seller_id)
                                ->first();
                                
         $top_seller_designation = $designation ? $designation->seller_designation : 'N/A';

        }else{
          // Handle the case where $top_seller_info is null
          $top_seller_id = null;
          $max_selling_amount = 0; // Or a default value as needed
          $top_seller_name = 'N/A';
          $top_seller_designation = 'N/A';
        }

       
      }
      
    //----------- top seller and top selling information end ----------------------


    //----------- top selling product information start ----------------------

    if($user_role_id == 1){

      $top_selling = DB::connection('pos')
      ->table('invoice_items')
      ->leftJoin('invoices','invoice_items.invoice_id','invoices.id')
      ->select('invoice_items.stock_id as max_stock_id',
                DB::raw('COUNT(invoice_items.stock_id) as stock_count'))
      ->whereMonth('invoice_items.invoice_date', $current_month)
      ->groupBy('invoice_items.stock_id')
      ->orderByDesc('stock_count')
      // ->where('invoices.company_id', $user_company_id)
      ->first();

      
    // $top_selling_stock_id = $top_selling->max_stock_id;

    // Handle the case where $top_selling is null
    $top_selling_stock_id = $top_selling ? $top_selling->max_stock_id : null;
   
      // Fetch product details if stock ID is found
      if ($top_selling_stock_id) {
          $product = DB::connection('inventory')
                        ->table('stocks')
                        ->leftJoin('products','stocks.product_id','products.id')
                        ->select('products.product_name as product_name', 'products.additional_product_details as product_desc')
                        ->where('stocks.id', $top_selling_stock_id)
                        ->first();

           // Handle the case where $product is null
        $top_selling_product_name = $product ? $product->product_name : 'N/A';
        $top_selling_product_desc = $product ? $product->product_desc : 'N/A';

      }else{
        $top_selling_product_name = 'N/A';
        $top_selling_product_desc = 'N/A';
      }

    }else{
      $top_selling = DB::connection('pos')
                    ->table('invoice_items')
                    ->leftJoin('invoices','invoice_items.invoice_id','invoices.id')
                    ->select('invoice_items.stock_id as max_stock_id',
                              DB::raw('COUNT(invoice_items.stock_id) as stock_count'))
                    ->whereMonth('invoice_items.invoice_date', $current_month)
                    ->groupBy('invoice_items.stock_id')
                    ->orderByDesc('stock_count')
                    ->where('invoices.company_id', $user_company_id)
                    ->first();

    // $top_selling_stock_id = $top_selling->max_stock_id;

    // Handle the case where $top_selling is null
    $top_selling_stock_id = $top_selling ? $top_selling->max_stock_id : null;

    // Fetch product details if stock ID is found
      if ($top_selling_stock_id) {
        $product = DB::connection('inventory')
                      ->table('stocks')
                      ->leftJoin('products', 'stocks.product_id', 'products.id')
                      ->select('products.product_name as product_name', 'products.additional_product_details as product_desc')
                      ->where('stocks.id', $top_selling_stock_id)
                      ->first();

        // Handle the case where $product is null
        $top_selling_product_name = $product ? $product->product_name : 'N/A';
        $top_selling_product_desc = $product ? $product->product_desc : 'N/A';
      } else {
        $top_selling_product_name = 'N/A';
        $top_selling_product_desc = 'N/A';
      }

    }
    
    //----------- top selling product information end ----------------------


      $sales = DB::connection('pos')
                      ->table('invoices')
                      ->where('company_id',$user_company_id)
                      ->get();


      return view('dashboard',compact('current_module',
                                      'sales',
                                      'top_seller_name',
                                      'top_seller_designation',
                                      'max_selling_amount',
                                      'top_selling_product_name',
                                      'top_selling_product_desc'
                                    ));
      
    }




    public function inventory_module_active(){
      // dd( $request->current_module_status);
      $current_modules = array();
      $current_modules['module_status'] = 3;
      $update_module = DB::table('current_modules')
                   ->where('id', 1)
                  ->update($current_modules);
      $current_module = DB::table('current_modules')->first();

      $user_company_id = Auth::user()->company_id;

      $total_item_categories = DB::connection('inventory')
                               ->table('item_categories')
                               ->where('company_id',$user_company_id)
                               ->count('id');

      $total_product_categories = DB::connection('inventory')
                                ->table('product_categories')
                                ->where('company_id',$user_company_id)
                                ->count('id');

      $total_products = DB::connection('inventory')
                        ->table('products')
                        ->where('shop_company_id',$user_company_id)
                        ->count('id');


    $current_month = Carbon::now()->format('m');
    $count_yearly_purchase = DB::connection('inventory')
                            ->table('requisition_orders')
                            ->whereMonth('requisition_deliver_date', $current_month)
                            ->where('company_id',$user_company_id)
                            ->count('total_amount');


   

      return view('dashboard',compact('current_module',
                                      'total_item_categories',
                                      'total_product_categories',
                                      'total_products'
                                    ));
      
    }



    public function emp_module_active(){
      // dd( $request->current_module_status);
      $current_modules = array();
      $current_modules['module_status'] = 2;
      $update_module = DB::table('current_modules')
                   ->where('id', 1)
                  ->update($current_modules);
      $current_module = DB::table('current_modules')->first();

      $user_company_id = Auth::user()->company_id;



        $total_employees = DB::table('users')
                          ->where('company_id',$user_company_id)
                          ->count('id');

        $current_month = Carbon::now()->format('m');
        $total_attendances = DB::table('attendances')
                             ->leftJoin('users','attendances.user_id','users.id')
                             ->whereMonth('attendances.attendance_date', $current_month)
                             ->where('users.company_id', $user_company_id)                            
                             ->count('attendances.id');
        
        
        
        $employees = DB::table('users')
        ->leftJoin('employees','users.id','employees.user_id')
        ->leftJoin('companies','users.company_id','companies.id')
        ->leftJoin('designations','users.designation','designations.id')
        ->leftJoin('branches','users.branch_id','branches.id')
        ->select('employees.*',
        'users.name as emp_name', 
        'users.joining_date as emp_joining_date', 
        'users.email as emp_email', 
        'companies.company_name as emp_company_name',
        'branches.br_name as emp_br_name',
        'designations.designation_name as emp_designation_name')
        ->where('users.company_id', $user_company_id)
        ->where('users.role_id', '3')
        ->get();

      return view('dashboard',compact('current_module','total_employees','total_attendances','employees'));

      
    }
}
