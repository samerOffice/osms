<?php

namespace App\Http\Controllers\API\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class DueController extends Controller
{
    public function customer_due_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $due_list = DB::connection('pos')
                        ->table('invoices')
                        ->leftJoin('customers', 'invoices.customer_id', '=', 'customers.id')
                        ->select(
                            'customers.customer_name as customer_name',
                            'customers.customer_phone_number as customer_mobile_number',
                            'customers.registration_date as customer_registration_date',
                            DB::raw('SUM(invoices.due_amount) as total_due')
                        )
                        ->where('invoices.company_id', $user_company_id)
                        ->where('invoices.due_amount', '!=', '')
                        ->where('invoices.due_amount', '!=', 0)
                        ->groupBy(
                            'customers.customer_name',
                            'customers.customer_phone_number',
                            'customers.registration_date'
                        )
                        ->get();

    //  dd($due_list);

    return view('dues.index',compact('current_module','due_list'));

    }

    public function due_details($mobile_number){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        
        $customer_details = DB::connection('pos')
                                ->table('customers')
                                ->where('customer_phone_number', $mobile_number)
                                ->first();
                                
        $customer_id = $customer_details->id;


        $total_due_amount = DB::connection('pos')
                            ->table('invoices')
                            ->select(DB::raw('SUM(invoices.due_amount) as total_due'))
                            ->where('customer_id',$customer_id)
                            ->first();
        
        $due_details = DB::connection('pos')
                        ->table('invoices')
                        // ->select('id','invoice_date','invoice_track_id', DB::raw('SUM(invoices.due_amount) as total_due'))
                        ->where('customer_id',$customer_id)
                        ->where('due_amount', '!=', '')
                        ->where('due_amount', '!=', 0)
                        ->get();

        
        
        // dd($due_details);

      
        return view('dues.due_details',compact('current_module','customer_details','total_due_amount','due_details'));
    }
}
