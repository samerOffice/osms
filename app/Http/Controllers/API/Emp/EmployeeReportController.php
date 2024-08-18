<?php

namespace App\Http\Controllers\API\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class EmployeeReportController extends Controller
{
    public function top_seller_report(){

        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('reports.emp_reports.top_seller_report',compact('current_module'));

    }


    public function top_seller_report_submit(Request $request){

        $report_type = $request->sale_type;
        $user_company_id = Auth::user()->company_id;
        
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        // return view('reports.inventory_reports.damage_report',compact('current_module'));

        if($report_type == 1){

            $current_date = Carbon::now()->toDateString();

            $top_sellers = DB::connection('pos')
                        ->table('invoices')
                        ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'invoices.emp_id', '=', 'users.id')
                        ->select(
                            'users.name as emp_name',
                            DB::raw('SUM(invoices.paid_amount) as total_paid_amount')
                        )
                        ->where('invoices.company_id', $user_company_id)
                        ->where('invoices.invoice_date', $current_date)
                        ->groupBy('invoices.emp_id', 'users.name')
                        ->get();

        //   dd($top_sellers);
        return view('reports.emp_reports.top_seller_report_data',compact('current_module','top_sellers', 'report_type'));

        }elseif($report_type == 2){

            $current_month = Carbon::now()->format('m');
            
            $top_sellers = DB::connection('pos')
                        ->table('invoices')
                        ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'invoices.emp_id', '=', 'users.id')
                        ->select(
                            'users.name as emp_name',
                            DB::raw('SUM(invoices.paid_amount) as total_paid_amount')
                        )
                        ->where('invoices.company_id', $user_company_id)
                        ->whereMonth('invoices.invoice_date', $current_month)
                        ->groupBy('invoices.emp_id', 'users.name')
                        ->get();


        //    dd($top_sellers);
         return view('reports.emp_reports.top_seller_report_data',compact('current_module','top_sellers', 'report_type'));

        }else{

            $current_year = Carbon::now()->format('Y');

            $top_sellers = DB::connection('pos')
                        ->table('invoices')
                        ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.users', 'invoices.emp_id', '=', 'users.id')
                        ->select(
                            'users.name as emp_name',
                            DB::raw('SUM(invoices.paid_amount) as total_paid_amount')
                        )
                        ->where('invoices.company_id', $user_company_id)
                        ->whereYear('invoices.invoice_date', $current_year)
                        ->groupBy('invoices.emp_id', 'users.name')
                        ->get();


            //   dd($top_sellers);
         return view('reports.emp_reports.top_seller_report_data',compact('current_module','top_sellers', 'report_type'));
        }

    }
}
