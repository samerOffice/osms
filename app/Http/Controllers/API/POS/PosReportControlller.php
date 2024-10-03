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


    public function sale_report_submit(Request $request){

        $report_type = $request->sale_type;
        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '4';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        if($report_type == 1){

            $current_date = Carbon::now()->toDateString();

            $sales_data = DB::connection('pos')
                        ->table('invoices')
                        ->leftJoin('invoice_items','invoices.id','invoice_items.invoice_id')
                        // ->leftJoin('stocks','sold_stock_id','stocks.id')
                        ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.stocks', 'invoice_items.stock_id', '=', 'stocks.id')
                        ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.products', 'stocks.product_id', '=', 'products.id')
                        // ->leftJoin('products','stocks.products_id','products.id')
                        ->select(
                        'invoice_items.stock_id as sold_stock_id',
                        'invoice_items.invoice_date as selling_date',
                        DB::raw("DATE_FORMAT(invoice_items.created_at, '%r') as selling_time"), // 12-hour format with AM/PM
                        'products.product_name as product_name',
                        'invoice_items.quantity as sold_stock_quantity',
                        'invoice_items.unit_price as purchase_price',
                        'invoice_items.sale_unit_price as selling_price',
                        'invoice_items.sub_total as product_sub_total'
                        )
                        ->where('invoices.company_id',$user_company_id)
                        ->where('invoices.invoice_date', $current_date)
                        ->get();


            $total_due = DB::connection('pos')
                        ->table('invoices')
                        ->where('company_id', $user_company_id)
                        ->where('invoice_date', $current_date)
                        ->sum('due_amount');

        //   dd($sales_data);
        return view('reports.pos_reports.sale_report_data',compact('current_module','sales_data', 'total_due', 'report_type'));

        }elseif($report_type == 2){

            $current_month = Carbon::now()->format('m');
            $current_year = Carbon::now()->format('Y');
            
            $sales_data = DB::connection('pos')
            ->table('invoices')
            ->leftJoin('invoice_items','invoices.id','invoice_items.invoice_id')
            // ->leftJoin('stocks','sold_stock_id','stocks.id')
            ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.stocks', 'invoice_items.stock_id', '=', 'stocks.id')
            ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.products', 'stocks.product_id', '=', 'products.id')
            // ->leftJoin('products','stocks.products_id','products.id')
            ->select(
            'invoice_items.stock_id as sold_stock_id',
            'invoice_items.invoice_date as selling_date',
            DB::raw("DATE_FORMAT(invoice_items.created_at, '%r') as selling_time"), // 12-hour format with AM/PM
            'products.product_name as product_name',
            'invoice_items.quantity as sold_stock_quantity',
            'invoice_items.unit_price as purchase_price',
            'invoice_items.sale_unit_price as selling_price',
            'invoice_items.sub_total as product_sub_total'
            )
            ->where('invoices.company_id',$user_company_id)
            ->whereMonth('invoices.invoice_date', $current_month)
            ->whereYear('invoices.invoice_date', $current_year)
            ->get();


            $total_due = DB::connection('pos')
                        ->table('invoices')
                        ->where('company_id', $user_company_id)
                        ->whereMonth('invoice_date', $current_month)
                        ->whereYear('invoices.invoice_date', $current_year)
                        ->sum('due_amount');

        //  dd($sales_data);
        return view('reports.pos_reports.sale_report_data',compact('current_module','sales_data', 'total_due', 'report_type'));

        }else{

            $current_year = Carbon::now()->format('Y');

            $sales_data = DB::connection('pos')
                        ->table('invoices')
                        ->leftJoin('invoice_items','invoices.id','invoice_items.invoice_id')
                        // ->leftJoin('stocks','sold_stock_id','stocks.id')
                        ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.stocks', 'invoice_items.stock_id', '=', 'stocks.id')
                        ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.products', 'stocks.product_id', '=', 'products.id')
                        // ->leftJoin('products','stocks.products_id','products.id')
                        ->select(
                        'invoice_items.stock_id as sold_stock_id',
                        'invoice_items.invoice_date as selling_date',
                        DB::raw("DATE_FORMAT(invoice_items.created_at, '%r') as selling_time"), // 12-hour format with AM/PM
                        'products.product_name as product_name',
                        'invoice_items.quantity as sold_stock_quantity',
                        'invoice_items.unit_price as purchase_price',
                        'invoice_items.sale_unit_price as selling_price',
                        'invoice_items.sub_total as product_sub_total'
                        )
                        ->where('invoices.company_id',$user_company_id)
                        ->whereYear('invoices.invoice_date', $current_year)
                        ->get();


            $total_due = DB::connection('pos')
                        ->table('invoices')
                        ->where('company_id', $user_company_id)
                        ->whereYear('invoice_date', $current_year)
                        ->sum('due_amount');

            // dd($sales_data);
            return view('reports.pos_reports.sale_report_data',compact('current_module','sales_data', 'total_due', 'report_type'));
        }
        
    }
}
