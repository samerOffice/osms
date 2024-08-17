<?php

namespace App\Http\Controllers\API\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class PosReportControlller extends Controller
{
    public function profit_and_loss_report(){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('reports.pos_reports.profit_and_loss_report',compact('current_module'));

    }

    public function profit_and_loss_report_result(Request $request){

        $year = $request->input('year');
        $month = $request->input('month');

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $total_sale = DB::connection('pos')
                        ->table('invoices')
                        ->where('company_id',$user_company_id)
                        ->whereYear('invoice_date', $year)
                        ->whereMonth('invoice_date', $month)
                        ->sum('paid_amount');


        $total_customer_due = DB::connection('pos')
                        ->table('invoices')
                        ->where('company_id',$user_company_id)
                        ->whereYear('invoice_date', $year)
                        ->whereMonth('invoice_date', $month)
                        ->sum('due_amount');


        $total_purchase = DB::connection('inventory')
                        ->table('requisition_orders')
                        ->where('company_id',$user_company_id)
                        ->whereYear('requisition_deliver_date', $year)
                        ->whereMonth('requisition_deliver_date', $month)
                        ->sum('total_amount');


        $total_rent = DB::table('rents')
                        ->where('company_id',$user_company_id)
                        ->whereYear('rent_pay_date', $year)
                        ->whereMonth('rent_pay_date', $month)
                        ->sum('rent_amount');

        $total_utility = DB::table('utilities')
                        ->where('company_id',$user_company_id)
                        ->whereYear('utility_pay_date', $year)
                        ->whereMonth('utility_pay_date', $month)
                        ->sum('utility_amount');

        $total_salary = DB::table('payrolls as p1')
                        ->join(
                            DB::raw('(SELECT employee, MAX(salary_date) as latest_salary_date 
                                      FROM payrolls 
                                      WHERE company = '.$user_company_id.' 
                                      AND YEAR(salary_date) = '.$year.' 
                                      AND MONTH(salary_date) = '.$month.' 
                                      GROUP BY employee) as p2'),
                            function($join) {
                                $join->on('p1.employee', '=', 'p2.employee')
                                     ->on('p1.salary_date', '=', 'p2.latest_salary_date');
                            }
                        )
                        ->where('p1.company', $user_company_id)
                        ->sum('p1.final_pay_amount');


                    
        $total_damaged_product_value = DB::connection('inventory')
                        ->table('damage_and_burned_products')
                        ->where('company_id',$user_company_id)
                        ->whereYear('entry_date', $year)
                        ->whereMonth('entry_date', $month)
                        ->sum('damage_amount');
                    

          // Return the data as a JSON response
            return response()->json([
                'total_sale' => $total_sale,
                'total_customer_due' => $total_customer_due,
                'total_purchase' => $total_purchase,
                'total_rent' => $total_rent,
                'total_utility' => $total_utility,
                'total_salary' => $total_salary,
                'total_damaged_product_value' => $total_damaged_product_value
            ]);


    }

    public function sale_report(){

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('reports.pos_reports.sale_report',compact('current_module'));

    }
}
