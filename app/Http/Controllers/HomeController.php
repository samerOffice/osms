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

      $menus = DB::table('menus')
                  ->where('module_type',1)           
                  ->get();
      $groupedMenus = $menus->groupBy('module_type');

      return view('auth_register',compact('divisions','roles','designations','business_types','menus','groupedMenus'));
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

      $shop_info = DB::table('companies')
                     ->where('id',$user_company_id)
                     ->first();

      $shop_name = $shop_info->company_name;

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



      $user_id = Auth::user()->id;

      $menu_data = DB::table('menu_permissions')
              ->where('user_id',$user_id)
              ->first();
      if($menu_data == null){
        return view('dashboard',compact('current_module',
                                      'shop_name',
                                      'total_branch',
                                      'total_department',
                                      'total_warehouse',
                                      'total_outlet'
                                    ));
        }else{
          $permitted_menus = $menu_data->menus;
          $permitted_menus_array = explode(',', $permitted_menus);

                return view('dashboard',compact('current_module',
                'shop_name',
                'total_branch',
                'total_department',
                'total_warehouse',
                'total_outlet',
                'permitted_menus_array'
              ));
            }   
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






    $user_id = Auth::user()->id;
    $menu_data = DB::table('menu_permissions')
                    ->where('user_id',$user_id)
                    ->first();
    if($menu_data == null){
                      return view('dashboard',compact('current_module',
                      'sales',
                      'top_seller_name',
                      'top_seller_designation',
                      'max_selling_amount',
                      'top_selling_product_name',
                      'top_selling_product_desc'
                    ));
        }else{
        $permitted_menus = $menu_data->menus;
        $permitted_menus_array = explode(',', $permitted_menus);
        return view('dashboard',compact('current_module',
                                      'sales',
                                      'top_seller_name',
                                      'top_seller_designation',
                                      'max_selling_amount',
                                      'top_selling_product_name',
                                      'top_selling_product_desc',
                                      'permitted_menus_array'
                                    ));
            } 
      
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


      $user_id = Auth::user()->id;
      $menu_data = DB::table('menu_permissions')
                      ->where('user_id',$user_id)
                      ->first();
      if($menu_data == null){
          return view('dashboard',compact('current_module',
                                      'total_item_categories',
                                      'total_product_categories',
                                      'total_products'
                                    ));
          }else{
          $permitted_menus = $menu_data->menus;
          $permitted_menus_array = explode(',', $permitted_menus);
          return view('dashboard',compact('current_module',
                                      'total_item_categories',
                                      'total_product_categories',
                                      'total_products',
                                      'permitted_menus_array'
                                    ));
              }
      
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

        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();


      if($menu_data == null){
        return view('dashboard',compact('current_module','total_employees','total_attendances','employees'));
        }else{
          $permitted_menus = $menu_data->menus;
          $permitted_menus_array = explode(',', $permitted_menus);

      return view('dashboard',compact('current_module','total_employees','total_attendances','employees','permitted_menus_array'));
           }
            
    }

    
    public function asset_management_module_active(){

      $user_company_id = Auth::user()->company_id;
      $user_role_id = Auth::user()->role_id;
      $user_id = Auth::user()->id;

      $current_modules = array();
      $current_modules['module_status'] = 5;
      $update_module = DB::table('current_modules')
                   ->where('id', 1)
                  ->update($current_modules);
      $current_module = DB::table('current_modules')->first();

      $menu_data = DB::table('menu_permissions')
                      ->where('user_id',$user_id)
                      ->first();
     
      if($user_role_id == 1){
        $assets = DB::table('assets')
                    ->leftJoin('companies','assets.company_id','companies.id')
                    ->leftJoin('branches','assets.branch_id','branches.id')
                    ->leftJoin('departments','assets.department_id','departments.id')
                    ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.warehouses', 'assets.warehouse_id', '=', 'warehouses.id')
                    ->leftJoin(DB::connection('pos')->getDatabaseName() . '.outlets', 'assets.outlet_id', '=', 'outlets.id')
                    ->select(
                        'assets.*',
                        'companies.company_name as company_name',
                        'branches.br_name as branch_name',
                        'departments.dept_name as department_name',
                        'warehouses.warehouse_name as warehouse_name',
                        'outlets.outlet_name as outlet_name'
                        )
                    ->get();

      if($menu_data == null){

          return view('dashboard',compact('current_module','assets'));

          }else{

            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);

          return view('dashboard',compact('current_module','assets', 'permitted_menus_array'));
              }

    }else{

        $assets = DB::table('assets')
                    ->leftJoin('companies','assets.company_id','companies.id')
                    ->leftJoin('branches','assets.branch_id','branches.id')
                    ->leftJoin('departments','assets.department_id','departments.id')
                    ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.warehouses', 'assets.warehouse_id', '=', 'warehouses.id')
                    ->leftJoin(DB::connection('pos')->getDatabaseName() . '.outlets', 'assets.outlet_id', '=', 'outlets.id')
                    ->select(
                        'assets.*',
                        'companies.company_name as company_name',
                        'branches.br_name as branch_name',
                        'departments.dept_name as department_name',
                        'warehouses.warehouse_name as warehouse_name',
                        'outlets.outlet_name as outlet_name'
                        )
                    ->where('assets.company_id',$user_company_id)
                    ->get();

      if($menu_data == null){

        return view('dashboard',compact('current_module','assets'));

        }else{

          $permitted_menus = $menu_data->menus;
          $permitted_menus_array = explode(',', $permitted_menus);

        return view('dashboard',compact('current_module','assets', 'permitted_menus_array'));
            }
    }

    }


    public function accounts_module_active(){

      $user_company_id = Auth::user()->company_id;
      $user_role_id = Auth::user()->role_id;
      $user_id = Auth::user()->id;

      $current_month = Carbon::now()->format('m');
      $current_year = Carbon::now()->format('Y');

      $current_modules = array();
      $current_modules['module_status'] = 6;
      $update_module = DB::table('current_modules')
                   ->where('id', 1)
                  ->update($current_modules);
      $current_module = DB::table('current_modules')->first();

      $menu_data = DB::table('menu_permissions')
                      ->where('user_id',$user_id)
                      ->first();

      $total_product_purchase_amt = DB::connection('inventory')
                                      ->table('requisition_orders')
                                      ->where('company_id',$user_company_id)
                                      ->whereMonth('requisition_order_date', $current_month)
                                      ->whereYear('requisition_order_date', $current_year)
                                      ->where('requisition_status', 3)
                                      ->sum('paid_amount');

      $total_sale_amt = DB::connection('pos')
                            ->table('invoices')
                            ->where('company_id',$user_company_id)
                            ->whereMonth('invoice_date', $current_month)
                            ->whereYear('invoice_date', $current_year)               
                            ->sum('paid_amount');

      $total_asset_purchase_amt = DB::table('assets')
                                      ->where('company_id',$user_company_id)
                                      ->whereMonth('purchase_date', $current_month)
                                      ->whereYear('purchase_date', $current_year)
                                      ->sum('cost');

      $total_rents_amt = DB::table('rents')
                        ->where('company_id',$user_company_id)
                        ->whereMonth('rent_pay_date', $current_month)
                        ->whereYear('rent_pay_date', $current_year)
                        ->sum('rent_amount');

      $total_utilities_amt = DB::table('utilities')
                        ->where('company_id',$user_company_id)
                        ->whereMonth('utility_pay_date', $current_month)
                        ->whereYear('utility_pay_date', $current_year)
                        ->sum('utility_amount');


      $total_salary_amt = DB::table('payrolls as p1')
                        ->join(
                            DB::raw('(SELECT employee, MAX(salary_date) as latest_salary_date 
                                      FROM payrolls 
                                      WHERE company = '.$user_company_id.' 
                                      AND YEAR(salary_date) = '.$current_month.' 
                                      AND MONTH(salary_date) = '.$current_year.' 
                                      GROUP BY employee) as p2'),
                            function($join) {
                                $join->on('p1.employee', '=', 'p2.employee')
                                     ->on('p1.salary_date', '=', 'p2.latest_salary_date');
                            }
                        )
                        ->where('p1.company', $user_company_id)
                        ->sum('p1.final_pay_amount');

      $total_expense_amt = $total_rents_amt + $total_utilities_amt + $total_salary_amt;

        $assets = DB::table('assets')
                    ->leftJoin('companies','assets.company_id','companies.id')
                    ->leftJoin('branches','assets.branch_id','branches.id')
                    ->leftJoin('departments','assets.department_id','departments.id')
                    ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.warehouses', 'assets.warehouse_id', '=', 'warehouses.id')
                    ->leftJoin(DB::connection('pos')->getDatabaseName() . '.outlets', 'assets.outlet_id', '=', 'outlets.id')
                    ->select(
                        'assets.*',
                        'companies.company_name as company_name',
                        'branches.br_name as branch_name',
                        'departments.dept_name as department_name',
                        'warehouses.warehouse_name as warehouse_name',
                        'outlets.outlet_name as outlet_name'
                        )
                    ->where('assets.company_id',$user_company_id)
                    ->get();

        $sales = DB::connection('pos')
                      ->table('invoices')
                      ->where('company_id',$user_company_id)
                      ->get();

      if($menu_data == null){

        return view('dashboard',compact('current_module',
                                        'sales',
                                        'total_product_purchase_amt',
                                        'total_asset_purchase_amt',
                                        'total_sale_amt',
                                        'total_expense_amt',
                                      ));

        }else{

          $permitted_menus = $menu_data->menus;
          $permitted_menus_array = explode(',', $permitted_menus);

        return view('dashboard',compact('current_module',
                                        'sales',
                                        'total_product_purchase_amt',
                                        'total_asset_purchase_amt',
                                        'total_sale_amt',
                                        'total_expense_amt',
                                        'permitted_menus_array'
                                      ));
            }
    

    }
}
