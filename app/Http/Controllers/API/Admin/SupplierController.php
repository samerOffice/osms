<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class SupplierController extends Controller
{
    public function supplier_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $suppliers = DB::table('suppliers')->get();
                                          
        return view('suppliers.index',compact('current_module','suppliers'));

        }else{
            $suppliers = DB::table('suppliers') 
                        ->where('company_id',$user_company_id)
                        ->get();

        return view('suppliers.index',compact('current_module','suppliers'));
        }       

    }

    public function add_supplier(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('suppliers.create',compact('current_module'));
        
    }
}
