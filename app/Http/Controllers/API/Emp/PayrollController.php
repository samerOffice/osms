<?php

namespace App\Http\Controllers\API\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class PayrollController extends Controller
{
    
    public function create()
    {
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $user_company_id = Auth::user()->company_id;

        $members = DB::table('users')
        ->select(
        'users.name as member_name',
        'users.id as member_id',
        'users.joining_date as member_joining_date')
        ->where('users.company_id', $user_company_id)
        ->get();


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
        ->where('user_id',$user_id)
        ->first();
        if($menu_data == null){
            return view('payrolls.create',compact('members','current_module'));
        }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);

            return view('payrolls.create',compact('members','current_module','permitted_menus_array'));
      }

    }
    
    
    public function index()
    {
        
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        $memeber_company_id = Auth::user()->company_id;

        $payrolls = DB::table('users')
                    ->leftJoin('companies','users.company_id','companies.id')
                    ->leftJoin('designations','users.designation','designations.id')
                    ->leftJoin('payrolls','users.id','payrolls.employee')
                    ->select(
                        'users.name as member_name',
                        'users.joining_date as member_joining_date',
                        'companies.company_name as member_company_name',
                        'designations.designation_name as member_desingation_name',
                        'payrolls.*'
                        )
                    ->where('company',$memeber_company_id)
                    ->get();


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
        ->where('user_id',$user_id)
        ->first();
        if($menu_data == null){
            return view('payrolls.index',compact('payrolls','current_module'));
        }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);

            return view('payrolls.index',compact('payrolls','current_module','permitted_menus_array'));
        }   
        
    }

    public function member_details_dependancy(Request $request){
        $selectedMemberId = $request->input('data');

        $employeeInfo = DB::table('users')
                            ->leftJoin('employees','users.id','employees.user_id')
                            ->leftJoin('designations','users.designation','designations.id')
                            ->select('users.*','employees.monthly_salary as emp_monthly_salary','designations.designation_name as member_designation')
                            ->where('users.id',$selectedMemberId)
                            ->first();

            $joining_date = $employeeInfo->joining_date;
            $member_designation = $employeeInfo->member_designation;
            $employee_monthly_salary = $employeeInfo->emp_monthly_salary;
            $joining_month = Carbon::parse($joining_date)->format('m');

            $per_day_salary = ceil($employee_monthly_salary / 26);


            $current_date = Carbon::now()->format('Y-m-d');
            $previous_month = Carbon::now()->subMonth()->format('Y-m-d');

            $leave = DB::table('leave_applications')
                         ->where('user_id',$selectedMemberId)
                         ->whereMonth('application_date',Carbon::parse($previous_month)->month)
                         ->whereYear('application_date',Carbon::parse($previous_month)->year)
                         ->sum('approved_duration');


    
            $data = [
                'joining_date' => $employeeInfo->joining_date,
                'member_designation' => $member_designation,
                'joining_month' => $joining_month,
                'employee_monthly_salary' => $employeeInfo->emp_monthly_salary,
                'per_day_salary' => $per_day_salary,
                'total_leave_day' => $leave
            ];

            return $data;

    }

    
    public function store_payroll(Request $request)
    {
        
        $payroll = DB::table('payrolls')
        ->insertGetId([
        'employee'=>$request->employee,
        'company'=>Auth::user()->company_id,
        'salary_date'=>$request->salary_date,
        'joining_date'=>$request->joining_date,
        'per_day_salary'=>$request->per_day_salary,
        // 'emp_total_bonus_day'=>$request->emp_total_bonus_day,
        // 'emp_total_bonus_amount'=>$request->emp_total_bonus_amount,     
        // 'bonus_eligible_month'=>$request->bonus_eligible_month,
        // 'bonus_pay_month'=>$request->bonus_pay_month,
        // 'bonus_pay_amount'=>$request->bonus_pay_amount,
        'total_working_day'=>$request->total_working_day,
        'total_leave'=>$request->total_leave,
        'total_number_of_pay_day'=>$request->total_number_of_pay_day,
        'monthly_salary'=>$request->monthly_salary,
        'monthly_holiday_bonus'=>$request->monthly_holiday_bonus,
        'total_daily_allowance'=>$request->total_daily_allowance,
        'total_travel_allowance'=>$request->total_travel_allowance,
        'rental_cost_allowance'=>$request->rental_cost_allowance,
        'hospital_bill_allowance'=>$request->hospital_bill_allowance,
        'insurance_allowance'=>$request->insurance_allowance,
        'sales_commission'=>$request->sales_commission,
        'retail_commission'=>$request->retail_commission,
        'total_others'=>$request->total_others,
        'total_salary'=>$request->total_salary,
        'yearly_bonus'=>$request->yearly_bonus,
        'total_payable_salary'=>$request->total_payable_salary,
        'advance_less'=>$request->advance_less,
        'any_deduction'=>$request->any_deduction,
        'final_pay_amount'=>$request->final_pay_amount,
        // 'loan_advance'=>$request->loan_advance
        ]);


        //  return redirect()->route('payroll_show_data');

        $response = [
            'success' => true,
            'message' => 'Payroll is added successfully',
            'payroll_id' => $payroll
        ];

         return response()->json($response,200);

    }


    public function payroll_show_data($payroll_id){

        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $member_payroll_info = DB::table('payrolls')
                               ->where('id',$payroll_id)
                               ->first();

        $employee_id = $member_payroll_info->employee;
        $company_id = $member_payroll_info->company;

        $employee_info = DB::table('users')
                            ->where('id',$employee_id)
                            ->first();

        $employee_name = $employee_info->name;
        $designation_id = $employee_info->designation;
        $branch_id = $employee_info->branch_id;
        $warehouse_id = $employee_info->warehouse_id;
        $outlet_id = $employee_info->outlet_id;


        $designation = DB::table('designations')
                        ->where('id',$designation_id)
                        ->first();
        $designation_name = $designation->designation_name;
        
        $company = DB::table('companies')
                    ->where('id',$company_id)
                    ->first();
        $shop_name = $company->company_name;


        $branch = DB::table('branches')
                    ->where('id',$branch_id)
                    ->first();
      


        $warehouse = DB::connection('inventory')
                        ->table('warehouses')
                        ->where('id',$warehouse_id)
                        ->first();
       


        $outlet = DB::connection('pos')
                    ->table('outlets')
                    ->where('id',$outlet_id)
                    ->first();


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
        ->where('user_id',$user_id)
        ->first();
        if($menu_data == null){
            return view('payrolls.show_data',compact('current_module',
                                                'member_payroll_info',
                                                'employee_name',
                                                'designation_name',
                                                'shop_name',
                                                'branch',
                                                'warehouse',
                                                'outlet',
                                                'payroll_id'));
        }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);

            return view('payrolls.show_data',compact('current_module',
                                                'member_payroll_info',
                                                'employee_name',
                                                'designation_name',
                                                'shop_name',
                                                'branch',
                                                'warehouse',
                                                'outlet',
                                                'payroll_id',
                                                'permitted_menus_array'
                                            ));
        }
       
         

    }


    // public function payroll_show_data($payroll_id){

    //     $current_modules = array();
    //     $current_modules['module_status'] = '2';
    //     $update_module = DB::table('current_modules')
    //                     ->update($current_modules);
    //     $current_module = DB::table('current_modules')->first();


    //     $payroll_info = DB::table('payrolls')
    //                     ->where('id',$payroll_id)
    //                     ->first();

    //     $payroll_id = $payroll_info->id;

    //     $member_payroll_info = DB::table('users')
    //                             ->leftJoin('designations','users.designation','designations.id')
    //                             ->leftJoin('branches','users.branch_id','branches.id')
    //                             ->leftJoin('payrolls','users.id','payrolls.employee')
    //                             ->select(
    //                             'users.name as member_name',
    //                             'payrolls.*',
    //                             'users.id as member_id',
    //                             'users.joining_date as member_joining_date',
    //                             'branches.br_name as member_br_name',
    //                             'designations.designation_name as member_designation_name')
    //                             ->where('payrolls.id', $payroll_id)
    //                             ->first();
     

    //       $member_payroll_info = (array) $member_payroll_info;
    //       $filteredData = array_filter($member_payroll_info, function($value) {
    //         return $value != 0;
    //     });


    //     $member_name = $filteredData['member_name'] ?? null;
    //     $member_id = $filteredData['member_id'] ?? null;
    //     $member_designation_name = $filteredData['member_designation_name'] ?? null;
    //     $member_br_name = $filteredData['member_br_name'] ?? null;
     
       
    //     return view('payrolls.show_data',compact('filteredData','member_name','member_id','member_designation_name','member_br_name','current_module','payroll_id'));
    // }



    public function generateCsv(Request $request)
    {
        $id = $request->payroll;
        $fileName = 'payroll_data.csv';

        // $payrolls = Payroll::all();

        $payroll = DB::table('payrolls')
                    ->leftJoin('users','payrolls.employee','=','users.id')
                    ->leftJoin('companies','payrolls.company','=','companies.id')
                    ->select('payrolls.*','users.name as member_name','users.joining_date as member_joining_date','companies.company_name as member_company_name')
                    ->where('payrolls.id',$id)
                    ->first();

        // Define the headers for the CSV file
        $headers = [
            'Company Name', 
            'Employee Name', 
            'Salary Date',
            'Joining Date',
            'Per Day Salary',
            'Total Bonus Day',
            'Total Bonus Amount',
            'Bonus Eligible Month',
            'Bonus Payable Month',
            'Bonus Pay Amount',
            'Total Working Days',
            'Total Leave',
            'Total Number of Payable Days',
            'Monthly Salary',
            'Monthly Holiday Bonus',
            'Total Daily Allowance',
            'Total Travel Allowance',
            'Rental Cost Allowance',
            'Hospital Bill Allowance',
            'Insurance Allowance',
            'Sales Commission',
            'Retail Commission',
            'Total Others',
            'Total Salary',
            'Yearly Bonus',
            'Total Payable Salary',
            'Advance Less',
            'Any Deduction',
            'Final Payment Amount',
            'Loan Advance'
        ];

        // Open output stream
        $file = fopen('php://output', 'w');
     
        // Set the headers for the CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        // Write the header row to the CSV file
        fputcsv($file, $headers);

            fputcsv($file, [
                $payroll->member_company_name,
                $payroll->member_name,
                $payroll->salary_date,
                $payroll->member_joining_date,
                $payroll->per_day_salary,
                $payroll->emp_total_bonus_day,
                $payroll->emp_total_bonus_amount,
                $payroll->bonus_eligible_month,
                $payroll->bonus_pay_month,
                $payroll->bonus_pay_amount,
                $payroll->total_working_day,
                $payroll->total_leave,
                $payroll->total_number_of_pay_day,
                $payroll->monthly_salary,
                $payroll->monthly_holiday_bonus,
                $payroll->total_daily_allowance,
                $payroll->total_travel_allowance,
                $payroll->rental_cost_allowance,
                $payroll->hospital_bill_allowance,
                $payroll->insurance_allowance,
                $payroll->sales_commission,
                $payroll->retail_commission,
                $payroll->total_others,
                $payroll->total_salary,
                $payroll->yearly_bonus,
                $payroll->total_payable_salary,
                $payroll->advance_less,
                $payroll->any_deduction,
                $payroll->final_pay_amount,
                $payroll->loan_advance
            ]);
        
        // Close the output stream
        fclose($file);
        exit();
    }



   

   


}
