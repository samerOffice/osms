<?php

namespace App\Http\Controllers\API\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class InvoiceController extends Controller
{
    //product category
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

        $response = [
            'success' => true,
            'message' => 'Invoice is added successfully'
        ];

        return response()->json($response,200);
    }
}
