<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class BillController extends Controller
{
    
    
    //--------------- rent start--------------------
      
    public function rent_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $rents = DB::table('rents')->get();
                                          
        return view('bills.rents.index',compact('current_module','rents'));

        }else{
            $rents = DB::table('rents') 
                        ->where('company_id',$user_company_id)
                        ->get();

        return view('bills.rents.index',compact('current_module','rents'));
        }       

    }

    public function add_rent(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('bills.rents.create',compact('current_module'));
        
    }

    public function submit_rent(Request $request){
        $user_company_id = Auth::user()->company_id;
        $rent_eligible_date = Carbon::now()->startOfMonth()->subMonth()->toDateString();
        $rent = DB::table('rents')
                ->insertGetId([
                'company_id'=>$user_company_id,
                'rent_eligible_date'=>$rent_eligible_date,
                'rent_pay_date'=>$request->rent_pay_date,
                'rent_amount'=>$request->rent_amount
                ]);

        $response = [
            'success' => true,
            'message' => 'Rent is added successfully'
        ];

        return response()->json($response,200);
    }


    //for web
    public function edit_rent($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $rent = DB::table('rents')
                    ->where('id',$id)
                    ->first();
 
        return view('bills.rents.edit',compact('current_module','rent'));

    }

    //for api
    public function edit_rent_via_api($id){
        $rent = DB::table('rents')
                    ->leftJoin('companies','rents.company_id','companies.id')
                    ->select('rents.*','companies.company_name as company_name')
                    ->where('rents.id',$id)
                    ->first();
        
        $response = [
        'Company Name' => $rent->company_name,
        'Company Id' => $rent->company_id,
        'Rent Eligible Date' => $rent->rent_eligible_date,
        'Rent Pay Date' => $rent->rent_pay_date,
        'Rent Amount' => $rent->rent_amount
        ];

       return response()->json($response,200);

    }


    public function update_rent(Request $request, $id){    
        $data = array();
        $data['rent_pay_date'] = $request->rent_pay_date;
        $data['rent_amount'] = $request->rent_amount;
          
        try {
            // Update the outlet record in the database
            $updated = DB::table('rents')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Rent is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Rent update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Rent', 'details' => $e->getMessage()], 500);
        }     
    }

    public function delete_rent(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::table('rents')
                        ->where('id', $id)
                        ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Rent is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Rent Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }

    //--------------- rent end--------------------


    //--------------- utility start--------------------

    public function utility_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $utilities = DB::table('utilities')->get();
                                          
        return view('bills.utilities.index',compact('current_module','utilities'));

        }else{
            $utilities = DB::table('utilities') 
                        ->where('company_id',$user_company_id)
                        ->get();

        return view('bills.utilities.index',compact('current_module','utilities'));
        }  
    }


    public function add_utility(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('bills.utilities.create',compact('current_module'));
        
    }


    public function submit_utility(Request $request){
        $user_company_id = Auth::user()->company_id;
        $rent_eligible_date = Carbon::now()->startOfMonth()->subMonth()->toDateString();
        $rent = DB::table('utilities')
                ->insertGetId([
                'company_id'=>$user_company_id,
                'utility_pay_date'=>$request->utility_pay_date,
                'utility_type'=>$request->utility_type,
                'utility_amount'=>$request->utility_amount
                ]);

        $response = [
            'success' => true,
            'message' => 'Utility is added successfully'
        ];

        return response()->json($response,200);
    }


    //for web
    public function edit_utility($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $utility = DB::table('utilities')
                    ->where('id',$id)
                    ->first();
 
        return view('bills.utilities.edit',compact('current_module','utility'));

    }

    //for api
    public function edit_utility_via_api($id){
        $utility = DB::table('utilities')
                    ->leftJoin('companies','utilities.company_id','companies.id')
                    ->select('utilities.*','companies.company_name as company_name')
                    ->where('utilities.id',$id)
                    ->first();
        
        $response = [
        'Company Name' => $utility->company_name,
        'Company Id' => $utility->company_id,
        'Rent Eligible Date' => $utility->rent_eligible_date,
        'Rent Pay Date' => $utility->rent_pay_date,
        'Rent Amount' => $utility->rent_amount
        ];

       return response()->json($response,200);

    }


    public function update_utility(Request $request, $id){    
        $data = array();
        $data['utility_pay_date'] = $request->utility_pay_date;
        $data['utility_type'] = $request->utility_type;
        $data['utility_amount'] = $request->utility_amount;
          
        try {
            // Update the outlet record in the database
            $updated = DB::table('utilities')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Utility is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Utility update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Utility', 'details' => $e->getMessage()], 500);
        }     
    }


    public function delete_utility(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::table('utilities')
                        ->where('id', $id)
                        ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Utility is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Utility Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }

    //--------------- utility end--------------------



    //--------------- daily expense start--------------------
    public function daily_expense_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $daily_expenses = DB::table('expenses')
                                ->where('expense_type', 1)
                                ->get();
                                          
        return view('expenses.daily_expense.index',compact('current_module','daily_expenses'));

        }else{

            $daily_expenses = DB::table('expenses')
                                ->where('expense_type', 1)
                                ->where('company_id',$user_company_id)
                                ->get();
           
        return view('expenses.daily_expense.index',compact('current_module','daily_expenses'));
        }  
    }

    public function add_daily_expense(){
    
            $current_modules = array();
            $current_modules['module_status'] = '1';
            $update_module = DB::table('current_modules')
                        // ->where('id', $request->id)
                            ->update($current_modules);
            $current_module = DB::table('current_modules')->first();
    
            return view('expenses.daily_expense.create',compact('current_module'));
     
    }

    public function submit_daily_expense(Request $request){

        $user_company_id = Auth::user()->company_id;
        $expense_type = 1;
        $expense_names = $request->expense_name;
        $expense_amounts = $request->expense_amount;
        $expense_pay_dates = $request->expense_pay_date;

        foreach ($expense_names as $key => $expense_name) {
           
            $expense_amount = $expense_amounts[$key] ?? null;
            $expense_pay_date = $expense_pay_dates[$key] ?? null;
          
            DB::table('expenses')
                ->insert([
                'company_id' => $user_company_id,
                'expense_type' => $expense_type,
                'expense_name' => $expense_name,
                'expense_amount' => $expense_amount,
                'expense_pay_date' => $expense_pay_date  
            ]);
        }

        $response = [
            'success' => true,
            'message' => 'Expense is added successfully'
        ];

        return response()->json($response,200);
    }


     //for web
     public function edit_daily_expense($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $expense = DB::table('expenses')
                    ->where('id',$id)
                    ->first();
 
        return view('expenses.daily_expense.edit',compact('current_module','expense'));

    }

    //for api
    public function edit_daily_expense_via_api($id){
        $expense = DB::table('expenses')
                    ->leftJoin('companies','expenses.company_id','companies.id')
                    ->select('expenses.*','companies.company_name as company_name')
                    ->where('expenses.id',$id)
                    ->first();
        
        $response = [
        'Company Name' => $expense->company_name,
        'Company Id' => $expense->company_id,
        'Expense Type (1 = Daily, 2 = Monthly, 3 = Yearly)' => $expense->expense_type,
        'Expense Name' => $expense->expense_name,
        'Expense Amount' => $expense->expense_amount,
        'Expense Paid Date' => $expense->expense_pay_date
        ];

       return response()->json($response,200);

    }


    public function update_daily_expense(Request $request, $id){    
        $data = array();
        $data['expense_name'] = $request->expense_name;
        $data['expense_amount'] = $request->expense_amount;
        $data['expense_pay_date'] = $request->expense_pay_date;
          
        try {
            // Update the outlet record in the database
            $updated = DB::table('expenses')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Daily expense is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Daily Expense update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Daily Expense', 'details' => $e->getMessage()], 500);
        }     
    }


    public function delete_daily_expense(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::table('expenses')
                        ->where('id', $id)
                        ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Daily Expense is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Daily Expense Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }

    //--------------- daily expense end--------------------

    //--------------- monthly expense start--------------------
    public function monthly_expense_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $monthly_expenses = DB::table('expenses')
                                ->where('expense_type', 2)
                                ->get();
                                          
        return view('expenses.monthly_expense.index',compact('current_module','monthly_expenses'));

        }else{

            $monthly_expenses = DB::table('expenses')
                                ->where('expense_type', 2)
                                ->where('company_id',$user_company_id)
                                ->get();
           
        return view('expenses.monthly_expense.index',compact('current_module','monthly_expenses'));
        }  
    }

    public function add_monthly_expense(){
    
        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('expenses.monthly_expense.create',compact('current_module'));
 
    }

    public function submit_monthly_expense(Request $request){

        $user_company_id = Auth::user()->company_id;
        $expense_type = 2;
        $expense_names = $request->expense_name;
        $expense_amounts = $request->expense_amount;
        $expense_pay_dates = $request->expense_pay_date;

        foreach ($expense_names as $key => $expense_name) {
           
            $expense_amount = $expense_amounts[$key] ?? null;
            $expense_pay_date = $expense_pay_dates[$key] ?? null;
          
            DB::table('expenses')
                ->insert([
                'company_id' => $user_company_id,
                'expense_type' => $expense_type,
                'expense_name' => $expense_name,
                'expense_amount' => $expense_amount,
                'expense_pay_date' => $expense_pay_date  
            ]);
        }

        $response = [
            'success' => true,
            'message' => 'Expense is added successfully'
        ];

        return response()->json($response,200);
    }


     //for web
     public function edit_monthly_expense($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $expense = DB::table('expenses')
                    ->where('id',$id)
                    ->first();
 
        return view('expenses.monthly_expense.edit',compact('current_module','expense'));

    }

    //for api
    public function edit_monthly_expense_via_api($id){
        $expense = DB::table('expenses')
                    ->leftJoin('companies','expenses.company_id','companies.id')
                    ->select('expenses.*','companies.company_name as company_name')
                    ->where('expenses.id',$id)
                    ->first();
        
        $response = [
        'Company Name' => $expense->company_name,
        'Company Id' => $expense->company_id,
        'Expense Type (1 = Daily, 2 = Monthly, 3 = Yearly)' => $expense->expense_type,
        'Expense Name' => $expense->expense_name,
        'Expense Amount' => $expense->expense_amount,
        'Expense Paid Date' => $expense->expense_pay_date
        ];

       return response()->json($response,200);

    }


    public function update_monthly_expense(Request $request, $id){    
        $data = array();
        $data['expense_name'] = $request->expense_name;
        $data['expense_amount'] = $request->expense_amount;
        $data['expense_pay_date'] = $request->expense_pay_date;
          
        try {
            // Update the outlet record in the database
            $updated = DB::table('expenses')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Monthly expense is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Monthly Expense update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Monthly Expense', 'details' => $e->getMessage()], 500);
        }     
    }


    public function delete_monthly_expense(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::table('expenses')
                        ->where('id', $id)
                        ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Monthly Expense is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Monthly Expense Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }
    //--------------- monthly expense end--------------------

    //--------------- yearly expense start--------------------
    public function yearly_expense_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $yearly_expenses = DB::table('expenses')
                                ->where('expense_type', 3)
                                ->get();
                                          
        return view('expenses.yearly_expense.index',compact('current_module','yearly_expenses'));

        }else{

            $yearly_expenses = DB::table('expenses')
                                ->where('expense_type', 3)
                                ->where('company_id',$user_company_id)
                                ->get();
           
        return view('expenses.yearly_expense.index',compact('current_module','yearly_expenses'));
        }  
    }

    public function add_yearly_expense(){
    
        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('expenses.yearly_expense.create',compact('current_module'));
 
    }

    public function submit_yearly_expense(Request $request){

        $user_company_id = Auth::user()->company_id;
        $expense_type = 3;
        $expense_names = $request->expense_name;
        $expense_amounts = $request->expense_amount;
        $expense_pay_dates = $request->expense_pay_date;

        foreach ($expense_names as $key => $expense_name) {
           
            $expense_amount = $expense_amounts[$key] ?? null;
            $expense_pay_date = $expense_pay_dates[$key] ?? null;
          
            DB::table('expenses')
                ->insert([
                'company_id' => $user_company_id,
                'expense_type' => $expense_type,
                'expense_name' => $expense_name,
                'expense_amount' => $expense_amount,
                'expense_pay_date' => $expense_pay_date  
            ]);
        }

        $response = [
            'success' => true,
            'message' => 'Expense is added successfully'
        ];

        return response()->json($response,200);
    }



     //for web
     public function edit_yearly_expense($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $expense = DB::table('expenses')
                    ->where('id',$id)
                    ->first();
 
        return view('expenses.yearly_expense.edit',compact('current_module','expense'));

    }

    //for api
    public function edit_yearly_expense_via_api($id){
        $expense = DB::table('expenses')
                    ->leftJoin('companies','expenses.company_id','companies.id')
                    ->select('expenses.*','companies.company_name as company_name')
                    ->where('expenses.id',$id)
                    ->first();
        
        $response = [
        'Company Name' => $expense->company_name,
        'Company Id' => $expense->company_id,
        'Expense Type (1 = Daily, 2 = Monthly, 3 = Yearly)' => $expense->expense_type,
        'Expense Name' => $expense->expense_name,
        'Expense Amount' => $expense->expense_amount,
        'Expense Paid Date' => $expense->expense_pay_date
        ];

       return response()->json($response,200);

    }


    public function update_yearly_expense(Request $request, $id){    
        $data = array();
        $data['expense_name'] = $request->expense_name;
        $data['expense_amount'] = $request->expense_amount;
        $data['expense_pay_date'] = $request->expense_pay_date;
          
        try {
            // Update the outlet record in the database
            $updated = DB::table('expenses')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Yearly expense is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Yearly Expense update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Yearly Expense', 'details' => $e->getMessage()], 500);
        }     
    }


    public function delete_yearly_expense(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::table('expenses')
                        ->where('id', $id)
                        ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Yearly Expense is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Yearly Expense Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }
    //--------------- yearly expense end--------------------
}
