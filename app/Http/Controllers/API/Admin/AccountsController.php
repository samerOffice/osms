<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class AccountsController extends Controller
{
     //------------- ******** purchase_report (start) *********--------------

     public function account_purchase_report(){
        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $user_company_id = Auth::user()->company_id;
        $suppliers = DB::table('suppliers')
                        ->where('company_id',$user_company_id)
                        ->where('active_status',1)
                        ->get();

        return view('accounts.purchase_report',compact('current_module','suppliers'));
    } 

    public function account_purchase_report_submit(Request $request){

        $report_type = $request->purchase_type;
        $supplier = $request->supplier_id;
        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        // daily
        if($report_type == 1){


            if($supplier == ''){
                $current_date = Carbon::now()->toDateString();           
                $purchases_data = DB::connection('inventory')
                            ->table('product_requisitions')
                            ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
                            ->leftJoin('products','product_requisitions.product_id','products.id')
                            ->select(
                            'product_requisitions.*',
                            'suppliers.full_name as supplier_name',
                            'requisition_orders.requisition_order_date as order_date',
                            'requisition_orders.requisition_deliver_date as purchase_receive_date',
                            'products.product_name as product_name'
                            )
                            ->where('requisition_orders.company_id',$user_company_id)
                            ->where('requisition_orders.requisition_status',3)
                            ->where('requisition_orders.requisition_order_date', $current_date)
                            ->get();
    
                $total_paid = DB::connection('inventory')
                            ->table('requisition_orders')
                            ->where('company_id', $user_company_id)
                            ->where('requisition_order_date', $current_date)
                            ->where('requisition_status',3)
                            ->sum('paid_amount');
    
                $total_due = DB::connection('inventory')
                            ->table('requisition_orders')
                            ->where('company_id', $user_company_id)
                            ->where('requisition_order_date', $current_date)
                            ->where('requisition_status',3)
                            ->sum('due_amount');
    
            }else{

                $current_date = Carbon::now()->toDateString();           
                $purchases_data = DB::connection('inventory')
                            ->table('product_requisitions')
                            ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
                            ->leftJoin('products','product_requisitions.product_id','products.id')
                            ->select(
                            'product_requisitions.*',
                            'suppliers.full_name as supplier_name',
                            'requisition_orders.requisition_order_date as order_date',
                            'requisition_orders.requisition_deliver_date as purchase_receive_date',
                            'products.product_name as product_name'
                            )
                            ->where('requisition_orders.company_id',$user_company_id)
                            ->where('requisition_orders.supplier_id',$supplier)
                            ->where('requisition_orders.requisition_status',3)
                            ->where('requisition_orders.requisition_order_date', $current_date)
                            ->get();
    
                $total_paid = DB::connection('inventory')
                            ->table('requisition_orders')
                            ->where('company_id', $user_company_id)
                            ->where('supplier_id',$supplier)
                            ->where('requisition_order_date', $current_date)
                            ->where('requisition_status',3)
                            ->sum('paid_amount');
    
                $total_due = DB::connection('inventory')
                            ->table('requisition_orders')
                            ->where('company_id', $user_company_id)
                            ->where('supplier_id',$supplier)
                            ->where('requisition_order_date', $current_date)
                            ->where('requisition_status',3)
                            ->sum('due_amount');
    
            }

           
        // dd($purchases_data);
        return view('accounts.purchase_report_data',compact('current_module','purchases_data','total_paid','total_due','report_type'));

        // monthly
        }elseif($report_type == 2){

            $current_month = Carbon::now()->format('m');
            $current_year = Carbon::now()->format('Y'); 
            $supplier = $request->supplier_id;
            
            if($supplier == ''){
                $purchases_data = DB::connection('inventory')
                ->table('product_requisitions')
                ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
                ->leftJoin('products','product_requisitions.product_id','products.id')
                ->select(
                'product_requisitions.*',
                'suppliers.full_name as supplier_name',
                'requisition_orders.requisition_order_date as order_date',
                'requisition_orders.requisition_deliver_date as purchase_receive_date',
                'products.product_name as product_name'
                )
                ->where('requisition_orders.company_id',$user_company_id)
                ->where('requisition_orders.requisition_status',3)
                ->whereMonth('requisition_orders.requisition_order_date', $current_month)
                ->whereYear('requisition_orders.requisition_order_date', $current_year)
                ->get();

            $total_paid = DB::connection('inventory')
                        ->table('requisition_orders')
                        ->where('company_id', $user_company_id)
                        ->whereMonth('requisition_order_date', $current_month)
                        ->whereYear('requisition_order_date', $current_year)
                        ->where('requisition_status',3)
                        ->sum('paid_amount');

            $total_due = DB::connection('inventory')
                        ->table('requisition_orders')
                        ->where('company_id', $user_company_id)
                        ->whereMonth('requisition_order_date', $current_month)
                        ->whereYear('requisition_order_date', $current_year)
                        ->where('requisition_status',3)
                        ->sum('due_amount');

            }else{

        $purchases_data = DB::connection('inventory')
                            ->table('product_requisitions')
                            ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                            ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
                            ->leftJoin('products','product_requisitions.product_id','products.id')
                            ->select(
                            'product_requisitions.*',
                            'suppliers.full_name as supplier_name',
                            'requisition_orders.requisition_order_date as order_date',
                            'requisition_orders.requisition_deliver_date as purchase_receive_date',
                            'products.product_name as product_name'
                            )
                            ->where('requisition_orders.company_id',$user_company_id)
                            ->where('requisition_orders.supplier_id',$supplier)
                            ->where('requisition_orders.requisition_status',3)
                            ->whereMonth('requisition_orders.requisition_order_date', $current_month)
                            ->whereYear('requisition_orders.requisition_order_date', $current_year)
                            ->get();

        $total_paid = DB::connection('inventory')
                    ->table('requisition_orders')
                    ->where('company_id', $user_company_id)
                    ->where('supplier_id',$supplier)
                    ->whereMonth('requisition_order_date', $current_month)
                    ->whereYear('requisition_order_date', $current_year)
                    ->where('requisition_status',3)
                    ->sum('paid_amount');

        $total_due = DB::connection('inventory')
                    ->table('requisition_orders')
                    ->where('company_id', $user_company_id)
                    ->where('supplier_id',$supplier)
                    ->whereMonth('requisition_order_date', $current_month)
                    ->whereYear('requisition_order_date', $current_year)
                    ->where('requisition_status',3)
                    ->sum('due_amount');

            }
             
        return view('accounts.purchase_report_data',compact('current_module','purchases_data','total_paid','total_due','report_type'));

        // yearly
        }else{

            $current_year = Carbon::now()->format('Y');
            $supplier = $request->supplier_id;

            if($supplier == ''){
                $purchases_data = DB::connection('inventory')
                                ->table('product_requisitions')
                                ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                                ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
                                ->leftJoin('products','product_requisitions.product_id','products.id')
                                ->select(
                                'product_requisitions.*',
                                'suppliers.full_name as supplier_name',
                                'requisition_orders.requisition_order_date as order_date',
                                'requisition_orders.requisition_deliver_date as purchase_receive_date',
                                'products.product_name as product_name'
                                )
                                ->where('requisition_orders.company_id',$user_company_id)
                                ->where('requisition_orders.requisition_status',3)
                                ->whereYear('requisition_orders.requisition_order_date', $current_year)
                                ->get();

                $total_paid = DB::connection('inventory')
                                ->table('requisition_orders')
                                ->where('company_id', $user_company_id)
                                ->whereYear('requisition_order_date', $current_year)
                                ->where('requisition_status',3)
                                ->sum('paid_amount');

                $total_due = DB::connection('inventory')
                            ->table('requisition_orders')
                            ->where('company_id', $user_company_id)
                            ->whereYear('requisition_order_date', $current_year)
                            ->where('requisition_status',3)
                            ->sum('due_amount');

            }else{
                $purchases_data = DB::connection('inventory')
                                ->table('product_requisitions')
                                ->leftJoin('requisition_orders','product_requisitions.requisition_order_id','requisition_orders.requisition_order_id')
                                ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
                                ->leftJoin('products','product_requisitions.product_id','products.id')
                                ->select(
                                'product_requisitions.*',
                                'suppliers.full_name as supplier_name',
                                'requisition_orders.requisition_order_date as order_date',
                                'requisition_orders.requisition_deliver_date as purchase_receive_date',
                                'products.product_name as product_name'
                                )
                                ->where('requisition_orders.company_id',$user_company_id)
                                ->where('requisition_orders.supplier_id',$supplier)
                                ->where('requisition_orders.requisition_status',3)
                                ->whereYear('requisition_orders.requisition_order_date', $current_year)
                                ->get();

            $total_paid = DB::connection('inventory')
                                ->table('requisition_orders')
                                ->where('company_id', $user_company_id)
                                ->where('supplier_id',$supplier)
                                ->whereYear('requisition_order_date', $current_year)
                                ->where('requisition_status',3)
                                ->sum('paid_amount');

            $total_due = DB::connection('inventory')
                            ->table('requisition_orders')
                            ->where('company_id', $user_company_id)
                            ->where('supplier_id',$supplier)
                            ->whereYear('requisition_order_date', $current_year)
                            ->where('requisition_status',3)
                            ->sum('due_amount');

            }

        return view('accounts.purchase_report_data',compact('current_module','purchases_data', 'total_paid', 'total_due', 'report_type'));
        }
    }

    //------------- ******** purchase_report (end) *********--------------




    //------------- ******** profit and loss report (start) *********--------------

    public function account_profit_and_loss_report(){

        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('accounts.profit_and_loss_report',compact('current_module'));

    }

    public function account_profit_and_loss_report_result(Request $request){

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


        // $total_customer_due = DB::connection('pos')
        //                 ->table('invoices')
        //                 ->where('company_id',$user_company_id)
        //                 ->whereYear('invoice_date', $year)
        //                 ->whereMonth('invoice_date', $month)
        //                 ->sum('due_amount');


        $total_purchase = DB::connection('inventory')
                        ->table('requisition_orders')
                        ->where('company_id',$user_company_id)
                        ->whereYear('requisition_deliver_date', $year)
                        ->whereMonth('requisition_deliver_date', $month)
                        ->sum('total_amount');


        $total_daily_expense = DB::table('expenses')
                               ->where('expense_type',1)
                               ->whereMonth('expense_pay_date',$month)
                               ->whereYear('expense_pay_date', $year)
                               ->sum('expense_amount');

        $total_monthly_other_expense = DB::table('expenses')
                               ->where('expense_type',2)
                               ->whereMonth('expense_pay_date',$month)
                               ->whereYear('expense_pay_date', $year)
                               ->sum('expense_amount');

        $total_yearly_expense = DB::table('expenses')
                               ->where('expense_type',3)
                               ->whereYear('expense_pay_date', $year)
                               ->sum('expense_amount');


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
                // 'total_customer_due' => $total_customer_due,
                'total_purchase' => $total_purchase,
                'total_daily_expense' => $total_daily_expense,
                'total_monthly_other_expense' => $total_monthly_other_expense,
                'total_yearly_expense' => $total_yearly_expense,
                'total_rent' => $total_rent,
                'total_utility' => $total_utility,
                'total_salary' => $total_salary,
                'total_damaged_product_value' => $total_damaged_product_value
            ]);


    }
    //------------- ******** profit and loss report (end) *********--------------


    //------------- ******** balance sheet report (start) *********--------------

    public function add_balance_transaction(){

        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('accounts.create',compact('current_module'));
    }

    public function submit_balance_transaction(Request $request){

        $user_company_id = Auth::user()->company_id;
        
        $balance_transaction = DB::connection('pos')
                                ->table('balance_transactions')
                                ->insertGetId([
                                'company_id'=>$user_company_id,
                                'transaction_date'=>$request->transaction_date,
                                'transaction_name'=>$request->transaction_name,
                                'transaction_type'=>$request->transaction_type,
                                'cost_type'=>$request->cost_type,
                                'cost_less'=>$request->cost_less,
                                'transaction_amount'=>$request->transaction_amount
                                ]);

        $response = [
            'success' => true,
            'message' => 'Transaction is added successfully'
        ];

        return response()->json($response,200);
    }

    public function balance_transaction_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $balance_transactions = DB::connection('pos')
                        ->table('balance_transactions')
                        ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.companies', 'balance_transactions.company_id', '=', 'companies.id')
                        ->select('balance_transactions.*','companies.company_name as company_name')
                        ->get();
                        
            return view('accounts.index',compact('current_module','balance_transactions'));


        }else{

            $balance_transactions = DB::connection('pos')
                        ->table('balance_transactions')
                        ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.companies', 'balance_transactions.company_id', '=', 'companies.id')
                        ->select('balance_transactions.*','companies.company_name as company_name')
                        ->where('balance_transactions.company_id',$user_company_id)
                        ->get();
          
        return view('accounts.index',compact('current_module','balance_transactions'));
        } 
    }

    public function edit_balance_transaction($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $balance_transaction = DB::connection('pos')
                                ->table('balance_transactions')
                                ->where('id',$id)
                                ->first();
    
        return view('accounts.edit',compact('current_module','balance_transaction'));
    }

    //for api
    public function edit_balance_transaction_api($id){

        $balance_transaction = DB::connection('pos')
                                ->table('balance_transactions')
                                ->where('id',$id)
                                ->first();

        $response = [
        'transaction_details' => $balance_transaction
        ];
       return response()->json($response,200);

    }


    public function update_balance_transaction(Request $request, $id){

        $data = array();
        $data['transaction_date'] = $request->input('transaction_date');
        $data['transaction_name'] = $request->input('transaction_name');
        $data['transaction_type'] = $request->input('transaction_type');
        $data['cost_type'] = $request->input('cost_type');
        $data['cost_less'] = $request->input('cost_less');
        $data['transaction_amount'] = $request->input('transaction_amount');


        try {
            // Update the branch record in the database
            $updated = DB::connection('pos')
                        ->table('balance_transactions')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Transaction updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Transaction update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the transaction', 'details' => $e->getMessage()], 500);
        }  
    }

    public function delete_balance_transaction(Request $request, $id){
   
        $deleted = DB::connection('pos')
                    ->table('balance_transactions')
                    ->where('id', $id)
                    ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Transaction is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Transaction Failed To Deleted!']);
                }
    }

   

    public function balance_sheet_report(){

        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('accounts.balance_sheet_report',compact('current_module'));

    }


    public function balance_transaction_report_submit(Request $request){

        $user_company_id = Auth::user()->company_id;
        $year = $request->input('year');


        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        //asset
        $assets = DB::connection('pos')
                           ->table('balance_transactions')
                           ->whereYear('transaction_date',$year)
                           ->where('company_id',$user_company_id)
                           ->where('cost_type','A')
                           ->where('cost_less',2)
                           ->get();
        // dd($year);

        $total_asset_sum_amt = DB::connection('pos')
                                ->table('balance_transactions')
                                ->where('company_id',$user_company_id)
                                ->whereYear('transaction_date',$year)
                                ->where('cost_type','A')
                                ->where('cost_less',2)
                                ->sum('transaction_amount');

        $asset_depriciations = DB::connection('pos')
                                ->table('balance_transactions')
                                ->where('company_id',$user_company_id)
                                ->whereYear('transaction_date',$year)
                                ->where('cost_type','A')
                                ->where('cost_less',1)
                                ->get();

        $total_asset_depriciation_sum_amt = DB::connection('pos')
                                ->table('balance_transactions')
                                ->where('company_id',$user_company_id)
                                ->whereYear('transaction_date',$year)
                                ->where('cost_type','A')
                                ->where('cost_less',1)
                                ->sum('transaction_amount');
        $net_total_asset_sum_amt = $total_asset_sum_amt - $total_asset_depriciation_sum_amt;


        //liability
        $liabilities = DB::connection('pos')
                        ->table('balance_transactions')
                        ->where('company_id',$user_company_id)
                        ->whereYear('transaction_date',$year)
                        ->where('cost_type','L')
                        ->where('cost_less',2)
                        ->get();

        $total_liability_sum_amt = DB::connection('pos')
                    ->table('balance_transactions')
                    ->where('company_id',$user_company_id)
                    ->whereYear('transaction_date',$year)
                    ->where('cost_type','L')
                    ->where('cost_less',2)
                    ->sum('transaction_amount');

        $liability_depriciations = DB::connection('pos')
                    ->table('balance_transactions')
                    ->where('company_id',$user_company_id)
                    ->whereYear('transaction_date',$year)
                    ->where('cost_type','L')
                    ->where('cost_less',1)
                    ->get();

        $total_liability_depriciation_sum_amt = DB::connection('pos')
                    ->table('balance_transactions')
                    ->where('company_id',$user_company_id)
                    ->whereYear('transaction_date',$year)
                    ->where('cost_type','L')
                    ->where('cost_less',1)
                    ->sum('transaction_amount');

        $net_total_liability_sum_amt = $total_liability_sum_amt - $total_liability_depriciation_sum_amt;


        //equity
        $equities = DB::connection('pos')
                        ->table('balance_transactions')
                        ->where('company_id',$user_company_id)
                        ->whereYear('transaction_date',$year)
                        ->where('cost_type','E')
                        ->where('cost_less',2)
                        ->get();

        $total_equity_sum_amt = DB::connection('pos')
                                    ->table('balance_transactions')
                                    ->where('company_id',$user_company_id)
                                    ->whereYear('transaction_date',$year)
                                    ->where('cost_type','E')
                                    ->where('cost_less',2)
                                    ->sum('transaction_amount');

        $equity_depriciations = DB::connection('pos')
                                    ->table('balance_transactions')
                                    ->where('company_id',$user_company_id)
                                    ->whereYear('transaction_date',$year)
                                    ->where('cost_type','E')
                                    ->where('cost_less',1)
                                    ->get();

        $total_equity_depriciation_sum_amt = DB::connection('pos')
                    ->table('balance_transactions')
                    ->where('company_id',$user_company_id)
                    ->whereYear('transaction_date',$year)
                    ->where('cost_type','L')
                    ->where('cost_less',1)
                    ->sum('transaction_amount');

        $net_total_equity_sum_amt = $total_equity_sum_amt - $total_equity_depriciation_sum_amt;


        return view('accounts.balance_sheet_report_data',compact(
            'current_module',

            'assets',
            'total_asset_sum_amt',
            'asset_depriciations',
            'total_asset_depriciation_sum_amt',
            'net_total_asset_sum_amt',

            'liabilities',
            'total_liability_sum_amt',
            'liability_depriciations',
            'total_liability_depriciation_sum_amt',
            'net_total_liability_sum_amt',

            'equities',
            'total_equity_sum_amt',
            'equity_depriciations',
            'total_equity_depriciation_sum_amt',
            'net_total_equity_sum_amt'
        ));

    }
    //------------- ******** balance sheet report (end) *********--------------




    //------------- ******** sale report (start) *********--------------
    public function account_sale_report(){

        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('accounts.sale_report',compact('current_module'));

    }


    public function account_sale_report_submit(Request $request){

        $report_type = $request->sale_type;
        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        //daily
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
        return view('accounts.sale_report_data',compact('current_module','sales_data', 'total_due', 'report_type'));

        //monthly
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
        return view('accounts.sale_report_data',compact('current_module','sales_data', 'total_due', 'report_type'));

        //yearly
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
            return view('accounts.sale_report_data',compact('current_module','sales_data', 'total_due', 'report_type'));
        }
        
    }
    //------------- ******** sale report (end) *********--------------


    //------------- ******** expense report (start) *********--------------
    //daily expense
    public function daily_expense_report(){
        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('accounts.daily_expense_report',compact('current_module'));

    }

    public function daily_expense_report_submit(Request $request){
    
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $expenses_data = DB::table('expenses')
                   ->where('expense_type',1)
                   ->where('company_id',$user_company_id)
                   ->whereBetween('expense_pay_date', [$from_date, $to_date])
                   ->get();
 
     return view('accounts.daily_expense_report_data',compact('current_module','expenses_data', 'from_date', 'to_date'));

    }

    //monthly expense
    public function monthly_expense_report(){
        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('accounts.monthly_expense_report',compact('current_module'));

    }

    public function monthly_expense_report_submit(Request $request){
    
        $year = $request->year;
        $month = $request->month;
        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();



        $rents =  DB::table('rents')
                    ->where('company_id',$user_company_id)
                    ->whereYear('rent_pay_date', $year)
                    ->whereMonth('rent_pay_date', $month)
                    ->get();


        $total_rent = DB::table('rents')
                        ->where('company_id',$user_company_id)
                        ->whereYear('rent_pay_date', $year)
                        ->whereMonth('rent_pay_date', $month)
                        ->sum('rent_amount');

        $utilities = DB::table('utilities')
                        ->where('company_id',$user_company_id)
                        ->whereYear('utility_pay_date', $year)
                        ->whereMonth('utility_pay_date', $month)
                        ->get();

        $total_utility = DB::table('utilities')
                        ->where('company_id',$user_company_id)
                        ->whereYear('utility_pay_date', $year)
                        ->whereMonth('utility_pay_date', $month)
                        ->sum('utility_amount');


        $salaries = DB::table('payrolls as p1')
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
                        // Join users table
                        ->leftJoin('users', 'p1.employee', '=', 'users.id')             
                        // Join designation table
                        ->leftJoin('designations', 'users.designation', '=', 'designations.id')
                         // Join branch table
                         ->leftJoin('branches', 'users.branch_id', '=', 'branches.id')
                        
                        ->where('p1.company', $user_company_id)
                        ->select(
                            'p1.employee as employee_id',
                            'p1.final_pay_amount as final_pay_amount',
                            'p2.latest_salary_date as last_salary_date',
                            'users.name as employee_name',
                            'branches.br_name as employee_branch_name',
                            'designations.designation_name as designation_name')  // Select required fields
                        ->get();
                    

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

        $expenses_data = DB::table('expenses')
                   ->where('expense_type',2)
                   ->where('company_id',$user_company_id)
                   ->whereMonth('expense_pay_date', $month)
                   ->whereYear('expense_pay_date', $year)
                   ->get();

        
 
     return view('accounts.monthly_expense_report_data',compact(
                                                                'current_module',
                                                                'month',
                                                                'year',
                                                                'rents',
                                                                'total_rent',
                                                                'utilities',
                                                                'total_utility',
                                                                'salaries',
                                                                'total_salary',
                                                                'expenses_data'
                                                            ));

    }

    //yearly expense
    public function yearly_expense_report(){
        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('accounts.yearly_expense_report',compact('current_module'));

    }


    public function yearly_expense_report_submit(Request $request){
    
        $year = $request->year;
        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '6';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();



        $expenses_data = DB::table('expenses')
                   ->where('expense_type',3)
                   ->where('company_id',$user_company_id)
                   ->whereYear('expense_pay_date', $year)
                   ->get();

     return view('accounts.yearly_expense_report_data',compact('current_module','expenses_data','year'));

    }

    //------------- ******** expense report (end) *********--------------





 
}
