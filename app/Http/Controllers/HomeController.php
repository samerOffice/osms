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


      return view('dashboard',compact('current_module'));
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

    public function pos_module_active(Request $request){
      // dd( $request->current_module_status);
      $current_modules = array();
      $current_modules['module_status'] = $request->current_module_status;
      $update_module = DB::table('current_modules')
                   ->where('id', 1)
                  ->update($current_modules);
      $current_module = DB::table('current_modules')->first();
      return view('dashboard',compact('current_module'));
      
    }

    public function inventory_module_active(Request $request){
      // dd( $request->current_module_status);
      $current_modules = array();
      $current_modules['module_status'] = $request->current_module_status;
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

      return view('dashboard',compact('current_module','total_item_categories','total_product_categories','total_products'));
      
    }



    public function emp_module_active(Request $request){
      // dd( $request->current_module_status);
      $current_modules = array();
      $current_modules['module_status'] = $request->current_module_status;
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
