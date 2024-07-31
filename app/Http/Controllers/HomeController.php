<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
      return view('dashboard',compact('current_module'));
      
    }

    public function emp_module_active(Request $request){
      // dd( $request->current_module_status);
      $current_modules = array();
      $current_modules['module_status'] = $request->current_module_status;
      $update_module = DB::table('current_modules')
                   ->where('id', 1)
                  ->update($current_modules);
      $current_module = DB::table('current_modules')->first();
      return view('dashboard',compact('current_module'));

      
    }
}
