<?php

namespace App\Http\Controllers\API\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use DB;
use Auth;

class EmpController extends Controller
{
    
    
    public function password_reset(){
        
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        return view('employees.password_reset',compact('current_module'));
    }



        public function new_password_set(Request $request){
            $user = Auth::user();

            $validator = \Validator::make($request->all(),[
                    'current_password' => 'required',
                    'new_password' => [
                        'required',
                        'string',
                        'min:8',
                        
                        function ($attribute, $value, $fail) use ($user) {
                            if (Hash::check($value, $user->password)) {
                                $fail('The new password must be different from the current password.');
                            }
                        },
                    ],
                ]);


                if ($validator->fails()) {
                    // \Log::info('Validation failed.', ['errors' => $validator->errors()]);
                    return response()->json($validator->errors(), 422);
                }

                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json(['error' => 'Current password is incorrect'], 422);
                }

                $user->password = Hash::make($request->new_password);
                $user->save();

                Auth::guard('web')->logout();
                auth()->user()->tokens()->delete();

                return response()->json(['message' => 'Password is changed successfully!']);
        }

  
    
    public function employee_list(){
         
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $user_company_id = Auth::user()->company_id;
        
        $employees = DB::table('users')
                    ->leftJoin('employees','users.id','employees.user_id')
                    ->leftJoin('companies','users.company_id','companies.id')
                    ->leftJoin('designations','users.designation','designations.id')
                    ->leftJoin('branches','users.branch_id','branches.id')
                    ->select('employees.*',
                    'users.name as emp_name', 
                    'users.joining_date as emp_joining_date', 
                    'users.email as emp_email', 
                    'companies.company_name as emp_company_name',
                    'branches.br_name as emp_br_name',
                    'designations.designation_name as emp_designation_name')
                    ->where('users.company_id', $user_company_id)
                    ->where('users.role_id', '3')
                    ->get();

        // dd($employees);
        return view('employees.index',compact('employees','current_module'));
    }



    public function view_employee_details($id){

        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $employee = DB::table('employees')
                        ->leftJoin('designations','employees.designation_id','designations.id')
                        ->leftJoin('users','employees.user_id','users.id')
                        ->leftJoin('branches','users.branch_id','branches.id')
                        // ->leftJoin('warehouses','users.warehouse_id','warehouses.id')
                        // ->leftJoin('outlets','users.outlet_id','outlets.id')
                        ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.warehouses', 'users.warehouse_id', '=', 'warehouses.id')
                        ->leftJoin(DB::connection('pos')->getDatabaseName() . '.outlets', 'users.outlet_id', '=', 'outlets.id')                        
                       ->select(
                            'users.name as emp_name',
                            'users.email as emp_email',
                            'users.joining_date as emp_joining_date',
                            'employees.mobile_number as emp_mobile_number',
                            'designations.designation_name as emp_designation_name',
                            // 'employees.joining_date as emp_joining_date',
                            'employees.monthly_salary as emp_monthly_salary', 

                            'employees.nid_number as emp_nid_number',
                            'employees.birth_date as emp_birth_date',
                            'employees.blood_group as emp_blood_group',
                            'employees.present_address as emp_present_address',
                            'employees.permanent_address as emp_permanent_address',
                            

                            'branches.br_name as emp_branch_name',
                            'branches.br_address as emp_branch_address',
                            'warehouses.warehouse_name as emp_warehouse_name',
                            'warehouses.warehouse_address as emp_warehouse_address',
                            'outlets.outlet_name as emp_outlet_name',
                            'outlets.outlet_address as emp_outlet_address'
                            )
                        ->where('employees.id',$id)
                        ->first();

        // dd($employee);
        return view('employees.view',compact('employee','current_module'));            
    }
    
    
    
    public function add_new_employee(){
            
        $user_company_id = Auth::user()->company_id;
        
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        // $divisions = DB::table('divisions')->get();
        $branches = DB::table('branches')
                    ->where('company_id',$user_company_id)
                    ->where('br_status',1)
                    ->get();
        $designations = DB::table('designations')
                        ->where('company_id',$user_company_id)
                        ->get();
        // $business_types = DB::table('business_types')->get();

        
        return view('employees.add_new_employee_form',compact('current_module','branches','designations'));
    }



    public function level_designation_dependancy(Request $request){
        $selectedLevel = $request->input('data');
        $user_company_id = Auth::user()->company_id;

        $designations = DB::table('designations')
                        ->where('level',$selectedLevel)
                        ->where('company_id',$user_company_id)
                        ->get();
  
        $str="<option value=''>-- Select --</option>";
        foreach ($designations as $designation) {
            $str .= "<option value='$designation->id'> $designation->designation_name </option>";
            
        }
        echo $str;
    }




    public function store_employee(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']

        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response,400);
        }

        $company_id = Auth::user()->company_id;
        $company_business_type = Auth::user()->company_business_type;
        // $branch_id = $request->branch_id;

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = '3';
        $user->company_id = $company_id;
        $user->branch_id = $request->branch_id;
        $user->review_requisition = $request->review_requisition;
        $user->warehouse_id = $request->warehouse_id;
        $user->outlet_id = $request->outlet_id;
        // $user->department_id = $department;
        $user->designation = $request->designation_name;
        $user->joining_date = $request->joining_date;
        $user->active_status = '1';
        $user->company_business_type = $company_business_type;
        $user->save();

        $success['name'] = $user->name;
        $role = $user->role_id;

        $user = DB::table('employees')
        ->insertGetId([
        'user_id'=>$user->id,
        'monthly_salary' => $request->monthly_salary
        ]); 

        // $success['token'] = $user->createToken('myToken')->plainTextToken;
       
        $response = [
            'success' => true,
            'data' => $success,
            'flag' => 1,
            'message' => 'User is created successfully'
        ];

        $current_modules = array();
            $current_modules['module_status'] = '2';
            $update_module = DB::table('current_modules')
                //   ->where('id', $request->id)
                  ->update($current_modules);

        return response()->json($response,200);
    }


    //edit official information ui/ux (web)
    public function edit_employee_official_info($id){
     
        $user_company_id = Auth::user()->company_id;
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        $branches = DB::table('branches')
                    ->where('company_id',$user_company_id)
                    ->where('br_status',1)
                    ->get();
        
        
        $get_user_id = DB::table('employees')
                       ->where('id',$id)
                       ->first();

        $user_id = $get_user_id->user_id;
        $employee = DB::table('users')
                ->leftJoin('employees','users.id','employees.user_id')
                ->leftJoin('branches','users.branch_id','branches.id')
                ->leftJoin('designations','users.designation','designations.id')
                ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.warehouses', 'users.warehouse_id', '=', 'warehouses.id')
                ->leftJoin(DB::connection('pos')->getDatabaseName() . '.outlets', 'users.outlet_id', '=', 'outlets.id')
                ->select('users.*','employees.monthly_salary as monthly_salary','warehouses.warehouse_name as warehouse_name','outlets.outlet_name as outlet_name','designations.designation_name as designation_name', 'branches.br_name as branch_name')
                ->where('users.id',$user_id)
                ->first();

        return view('employees.edit_employee_official_details',compact('current_module','employee','branches'));

        // dd($employee);
    }

    //edit official information ui/ux (api)
    public function edit_employee_official_info_via_api($id){

        $get_user_id = DB::table('employees')
                       ->where('id',$id)
                       ->first();

        $user_id = $get_user_id->user_id;
        $employee = DB::table('users')
            ->leftJoin('branches','users.branch_id','branches.id')
            ->leftJoin('designations','users.designation','designations.id')
            ->leftJoin(DB::connection('inventory')->getDatabaseName() . '.warehouses', 'users.warehouse_id', '=', 'warehouses.id')
            ->leftJoin(DB::connection('pos')->getDatabaseName() . '.outlets', 'users.outlet_id', '=', 'outlets.id')
            ->select('users.*','warehouses.warehouse_name as warehouse_name','outlets.outlet_name as outlet_name','designations.designation_name as designation_name', 'branches.br_name as branch_name')
            ->where('users.id',$user_id)
            ->first();

        $response = [
            'employee_official_details' => $employee
            ];
    
            return response()->json($response,200);
        }


        public function update_employee_official_info(Request $request, $id){

            
            $data = array();
            $data['branch_id'] = $request->input('branch_id');
            $data['review_requisition'] = $request->input('review_requisition');
            $data['warehouse_id'] = $request->input('warehouse_id');
            $data['outlet_id'] = $request->input('outlet_id');
            $data['designation'] = $request->input('designation_name');

            $emp_monthly_salary = $request->input('monthly_salary');
    
            try {
                // Update the outlet record in the database
                $updated = DB::table('users')
                            ->where('id', $id)
                            ->update($data);


              $update_emp_salary = DB::table('employees')
                                    ->where('user_id', $id)
                                    ->update([
                                        'monthly_salary' => $emp_monthly_salary,
                                        'designation_id' => $request->input('designation_name')
                                    ]);
            
                // Check if the update was successful
                if ($updated) {
                    // Return a success response
                    return response()->json(['message' => 'Employee official information is updated successfully'], 200);
                } else {
                    // Return a failure response
                    return response()->json([
                        'message' => 'Employee official information update failed or no changes were made'
                    ], 400);
                }
            } catch (\Exception $e) {
                // Catch any exceptions and return an error response
                return response()->json(['error' => 'An error occurred while updating the employee official information', 'details' => $e->getMessage()], 500);
            }    
        }


    
    //personal information add ui/ux
    public function add_personal_info(){

        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                //   ->where('id', $request->id)
                  ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $user_role = Auth::user()->role_id;
        $user_designation_id = Auth::user()->designation;
        $user_joining_date = Auth::user()->joining_date;

        $designation = DB::table('designations')
                       ->where('id',$user_designation_id)
                       ->first();

        $designation_name = $designation->designation_name;

        //admin
        if($user_role == '2'){
            $member = DB::table('admins')
                    ->where('user_id',$user_id)
                    ->first();
         return view('employees.create',compact('current_module','user_name','designation_name','user_joining_date','member'));      
           
        //employee
        }elseif($user_role == '3'){
            $member = DB::table('employees')
                    ->where('user_id',$user_id)
                    ->first();
         return view('employees.create',compact('current_module','user_name','designation_name','user_joining_date','member'));
        
        //vendor
        }elseif($user_role == '4'){
            $member = DB::table('vendors')
                    ->where('user_id',$user_id)
                    ->first();
         return view('employees.create',compact('current_module','user_name','designation_name','user_joining_date','member'));
       
        //super admin (OSSL)
        }else{
            $member = DB::table('super_admins')
                    ->where('user_id',$user_id)
                    ->first();
         return view('employees.create',compact('current_module','user_name','designation_name','user_joining_date','member'));          
        }  
        
      }




      //personal information store
      public function member_information_store(Request $request){

        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role_id;
        

        //admin
        if($user_role == '2'){
            $member = DB::table('admins')
                    ->where('user_id',$user_id)
                    ->first();

            if(($member->flag == '1') && ($member->user_id == $user_id)){
                          
                $member_name = $request->input('name');
                $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);


                $getPicFromDb = $member->profile_pic;
                $admin_new_image = $request->file('profile_pic');
            
            
                if(!empty($admin_new_image)){

                    if(!empty($getPicFromDb)){
                    $filePath = public_path('uploads/' . $getPicFromDb);
                        unlink($filePath);
                    }

                $manager = new ImageManager(new Driver());
                $profile_image = $manager->read($request->file('profile_pic'));
                $profile_image_file_name = date('Ymd') . time() . '.' . $admin_new_image->getClientOriginalExtension();
                $profile_image = $profile_image->resize(500,500);
            $profile_image->toJpg(80)->save(base_path('public/uploads/admin_images/'.$profile_image_file_name));  
                $admin_image = 'admin_images/' . $profile_image_file_name;

                
                $data = array();
                $data['father_name'] = $request->father_name;
                $data['mother_name'] = $request->mother_name;
                $data['mobile_number'] = $request->mobile_number;
                $data['nid_number'] = $request->nid_number;
                $data['present_address'] = $request->present_address;
                $data['permanent_address'] = $request->permanent_address;
                $data['birth_date'] = $request->birth_date;
                $data['blood_group'] = $request->blood_group;
                $data['nationality'] = $request->nationality;
                $data['marital_status'] = $request->marital_status;
                $data['religion'] = $request->religion;
                $data['gender'] = $request->gender;
                $data['profile_pic'] = $admin_image;
                $data['emergency_contact_name'] = $request->emergency_contact_name;
                $data['emergency_contact_number'] = $request->emergency_contact_number;
                $data['emergency_contact_relation'] = $request->emergency_contact_relation;

                $updated = DB::table('admins')
                          ->where('user_id', $user_id)
                          ->update($data);

                if(($updated == true) || ($update_user_data == true)){
                $response = [
                    'success' => true,
                    'message' => 'Member information are updated successfully'
                ];
                return response()->json($response,200);
            }else{
                $response = [
                'success' => false,
                'message' => 'Error occured'
                ];       
                return response()->json($response);
            }

                }else{

                    $data = array();
                    $data['father_name'] = $request->father_name;
                    $data['mother_name'] = $request->mother_name;
                    $data['mobile_number'] = $request->mobile_number;
                    $data['nid_number'] = $request->nid_number;
                    $data['present_address'] = $request->present_address;
                    $data['permanent_address'] = $request->permanent_address;
                    $data['birth_date'] = $request->birth_date;
                    $data['blood_group'] = $request->blood_group;
                    $data['nationality'] = $request->nationality;
                    $data['marital_status'] = $request->marital_status;
                    $data['religion'] = $request->religion;
                    $data['gender'] = $request->gender;
                    // $data['profile_pic'] = $admin_image;
                    $data['emergency_contact_name'] = $request->emergency_contact_name;
                    $data['emergency_contact_number'] = $request->emergency_contact_number;
                    $data['emergency_contact_relation'] = $request->emergency_contact_relation;
    
                    $updated = DB::table('admins')
                              ->where('user_id', $user_id)
                              ->update($data);

                    if(($updated == true) || ($update_user_data == true)){
                    $response = [
                        'success' => true,
                        'message' => 'Member information are updated successfully'
                    ];
                    return response()->json($response,200);
                    }else{
                        $response = [
                        'success' => false,
                        'message' => 'Error occured'
                        ];       
                        return response()->json($response);
                    }
                }     

            }else{

                $member_name = $request->input('name');
                $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);

                $capture_img = $request->file('profile_pic');

                $manager = new ImageManager(new Driver());
                $profile_image = $manager->read($request->file('profile_pic'));
                $profile_image_file_name = date('Ymd') . time() . '.' . $capture_img->getClientOriginalExtension();
                $profile_image = $profile_image->resize(500,500);
            $profile_image->toJpg(80)->save(base_path('public/uploads/admin_images/'.$profile_image_file_name));
                
                $admin_image = 'admin_images/' . $profile_image_file_name;

                $data = array();
                $data['father_name'] = $request->father_name;
                $data['mother_name'] = $request->mother_name;
                $data['mobile_number'] = $request->mobile_number;
                $data['nid_number'] = $request->nid_number;
                $data['present_address'] = $request->present_address;
                $data['permanent_address'] = $request->permanent_address;
                $data['birth_date'] = $request->birth_date;
                $data['blood_group'] = $request->blood_group;
                $data['nationality'] = $request->nationality;
                $data['marital_status'] = $request->marital_status;
                $data['religion'] = $request->religion;
                $data['gender'] = $request->gender;
                $data['profile_pic'] = $admin_image;
                $data['emergency_contact_name'] = $request->emergency_contact_name;
                $data['emergency_contact_number'] = $request->emergency_contact_number;
                $data['emergency_contact_relation'] = $request->emergency_contact_relation;
                $data['flag'] = '1';

                $updated = DB::table('admins')
                          ->where('user_id', $user_id)
                          ->update($data);

                
                if(($updated == true) || ($update_user_data == true)){
                    $response = [
                        'success' => true,
                        'message' => 'Member information are added successfully'
                    ];
                    return response()->json($response,200);
                }else{
                    $response = [
                    'success' => false,
                    'message' => 'Error occured'
                    ];       
                    return response()->json($response);
                }

            }

         //employee   
        }elseif($user_role == '3'){
                
                    $member = DB::table('employees')
                    ->where('user_id',$user_id)
                    ->first();

                    $member_info = DB::table('users')
                    ->where('id',$user_id)
                    ->select('joining_date','designation')
                    ->first();

                    $member_designation = $member_info->designation;
                    $member_joining_date = $member_info->joining_date;

                    if(($member->flag == '1') && ($member->user_id == $user_id)){

                        $member_name = $request->input('name');
                        $update_user_data = DB::table('users')
                                            ->where('id', $user_id)
                                            ->update(['name' => $member_name]);


                 
                        $getPicFromDb = $member->profile_pic;
                        $emp_new_image = $request->file('profile_pic');


                        if(!empty($emp_new_image)){

                            if(!empty($getPicFromDb)){
                            $filePath = public_path('uploads/' . $getPicFromDb);
                             unlink($filePath);
                            }
        
                        $manager = new ImageManager(new Driver());
                        $profile_image = $manager->read($request->file('profile_pic'));
                        $profile_image_file_name = date('Ymd') . time() . '.' . $emp_new_image->getClientOriginalExtension();
                        $profile_image = $profile_image->resize(500,500);
                    $profile_image->toJpg(80)->save(base_path('public/uploads/employee_images/'.$profile_image_file_name));  
                        $employee_image = 'employee_images/' . $profile_image_file_name;

                        $data = array();
                        $data['designation_id'] = $member_designation;
                        $data['joining_date'] = $member_joining_date;
                        $data['father_name'] = $request->father_name;
                        $data['mother_name'] = $request->mother_name;
                        $data['mobile_number'] = $request->mobile_number;
                        $data['nid_number'] = $request->nid_number;
                        $data['present_address'] = $request->present_address;
                        $data['permanent_address'] = $request->permanent_address;
                        $data['birth_date'] = $request->birth_date;
                        $data['blood_group'] = $request->blood_group;
                        $data['nationality'] = $request->nationality;
                        $data['marital_status'] = $request->marital_status;
                        $data['religion'] = $request->religion;
                        $data['gender'] = $request->gender;
                        $data['profile_pic'] = $employee_image;
                        $data['emergency_contact_name'] = $request->emergency_contact_name;
                        $data['emergency_contact_number'] = $request->emergency_contact_number;
                        $data['emergency_contact_relation'] = $request->emergency_contact_relation;
                                
                        $updated = DB::table('employees')
                                    ->where('user_id', $user_id)
                                    ->update($data);

                        if(($updated == true) || ($update_user_data == true)){
                            $response = [
                                'success' => true,
                                'message' => 'Member information are updated successfully'
                            ];
                            return response()->json($response,200);
                        }else{
                            $response = [
                            'success' => false,
                            'message' => 'Error occured'
                            ];              
                            return response()->json($response);
                        }
        
                     }else{
        
                        $data = array();
                        $data['designation_id'] = $member_designation;
                        $data['joining_date'] = $member_joining_date;
                        $data['father_name'] = $request->father_name;
                        $data['mother_name'] = $request->mother_name;
                        $data['mobile_number'] = $request->mobile_number;
                        $data['nid_number'] = $request->nid_number;
                        $data['present_address'] = $request->present_address;
                        $data['permanent_address'] = $request->permanent_address;
                        $data['birth_date'] = $request->birth_date;
                        $data['blood_group'] = $request->blood_group;
                        $data['nationality'] = $request->nationality;
                        $data['marital_status'] = $request->marital_status;
                        $data['religion'] = $request->religion;
                        $data['gender'] = $request->gender;
                        // $data['profile_pic'] = $employee_image;
                        $data['emergency_contact_name'] = $request->emergency_contact_name;
                        $data['emergency_contact_number'] = $request->emergency_contact_number;
                        $data['emergency_contact_relation'] = $request->emergency_contact_relation;
                                
                        $updated = DB::table('employees')
                                    ->where('user_id', $user_id)
                                    ->update($data);

                        if(($updated == true) || ($update_user_data == true)){
                            $response = [
                                'success' => true,
                                'message' => 'Member information are updated successfully'
                            ];
                            return response()->json($response,200);
                        }else{
                            $response = [
                            'success' => false,
                            'message' => 'Error occured'
                            ];              
                            return response()->json($response);
                        }
                     }
    
                        
                    }else{
                        $member_name = $request->input('name');
                        $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);


                        $capture_img = $request->file('profile_pic');

                        $manager = new ImageManager(new Driver());
                        $profile_image = $manager->read($request->file('profile_pic'));
                        $profile_image_file_name = date('Ymd') . time() . '.' . $capture_img->getClientOriginalExtension();
                        $profile_image = $profile_image->resize(500,500);
                    $profile_image->toJpg(80)->save(base_path('public/uploads/employee_images/'.$profile_image_file_name));
                        
                        $employee_image = 'employee_images/' . $profile_image_file_name;

                        $data = array();
                        $data['designation_id'] = $member_designation;
                        $data['joining_date'] = $member_joining_date;
                        $data['father_name'] = $request->father_name;
                        $data['mother_name'] = $request->mother_name;
                        $data['mobile_number'] = $request->mobile_number;
                        $data['nid_number'] = $request->nid_number;
                        $data['present_address'] = $request->present_address;
                        $data['permanent_address'] = $request->permanent_address;
                        $data['birth_date'] = $request->birth_date;
                        $data['blood_group'] = $request->blood_group;
                        $data['nationality'] = $request->nationality;
                        $data['marital_status'] = $request->marital_status;
                        $data['religion'] = $request->religion;
                        $data['gender'] = $request->gender;
                        $data['profile_pic'] = $employee_image;
                        $data['emergency_contact_name'] = $request->emergency_contact_name;
                        $data['emergency_contact_number'] = $request->emergency_contact_number;
                        $data['emergency_contact_relation'] = $request->emergency_contact_relation;
                        $data['flag'] = '1';

                        $updated = DB::table('employees')
                                    ->where('user_id', $user_id)
                                    ->update($data);
        
                        if(($updated == true) || ($update_user_data == true)){
                            $response = [
                                'success' => true,
                                'message' => 'Member information are added successfully'
                            ];
                            return response()->json($response,200);
                        }else{
                            $response = [
                            'success' => false,
                            'message' => 'Error occured'
                            ];              
                            return response()->json($response);
                        }
                    }
      
                    
        //vendor
        }elseif($user_role == '4'){
                
            $member = DB::table('vendors')
            ->where('user_id',$user_id)
            ->first();

            if(($member->flag == '1') && ($member->user_id == $user_id)){

                $member_name = $request->input('name');
                $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);
                $data = array();
                $data['father_name'] = $request->father_name;
                $data['mother_name'] = $request->mother_name;
                $data['mobile_number'] = $request->mobile_number;
                $data['nid_number'] = $request->nid_number;
                $data['present_address'] = $request->present_address;
                $data['permanent_address'] = $request->permanent_address;
                $data['birth_date'] = $request->birth_date;
                $data['blood_group'] = $request->blood_group;
                $data['nationality'] = $request->nationality;
                $data['marital_status'] = $request->marital_status;
                $data['religion'] = $request->religion;
                $data['gender'] = $request->gender;
                $data['emergency_contact_name'] = $request->emergency_contact_name;
                $data['emergency_contact_number'] = $request->emergency_contact_number;
                $data['emergency_contact_relation'] = $request->emergency_contact_relation;

                $updated = DB::table('vendors')
                          ->where('user_id', $user_id)
                          ->update($data);

                if(($updated == true) || ($update_user_data == true)){
                    $response = [
                        'success' => true,
                        'message' => 'Member information are updated successfully'
                    ];
                    return response()->json($response,200);
                }else{
                    $response = [
                    'success' => false,
                    'message' => 'Error occured'
                    ];              
                    return response()->json($response);
                }
            }else{

                $member_name = $request->input('name');
                $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);

                $data = array();
                $data['father_name'] = $request->father_name;
                $data['mother_name'] = $request->mother_name;
                $data['mobile_number'] = $request->mobile_number;
                $data['nid_number'] = $request->nid_number;
                $data['present_address'] = $request->present_address;
                $data['permanent_address'] = $request->permanent_address;
                $data['birth_date'] = $request->birth_date;
                $data['blood_group'] = $request->blood_group;
                $data['nationality'] = $request->nationality;
                $data['marital_status'] = $request->marital_status;
                $data['religion'] = $request->religion;
                $data['gender'] = $request->gender;
                $data['emergency_contact_name'] = $request->emergency_contact_name;
                $data['emergency_contact_number'] = $request->emergency_contact_number;
                $data['emergency_contact_relation'] = $request->emergency_contact_relation;
                $data['flag'] = '1';

                $updated = DB::table('vendors')
                          ->where('user_id', $user_id)
                          ->update($data);

                if(($updated == true) || ($update_user_data == true)){
                    $response = [
                        'success' => true,
                        'message' => 'Member information are added successfully'
                    ];
                    return response()->json($response,200);
                }else{
                    $response = [
                    'success' => false,
                    'message' => 'Error occured'
                    ];              
                    return response()->json($response);
                }
            }

         //super admin (OSSL)
        }else{
                
            $member = DB::table('super_admins')
            ->where('user_id',$user_id)
            ->first();

            if(($member->flag == '1') && ($member->user_id == $user_id)){

                $member_name = $request->input('name');
                $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);

                $data = array();
                $data['father_name'] = $request->father_name;
                $data['mother_name'] = $request->mother_name;
                $data['mobile_number'] = $request->mobile_number;
                $data['nid_number'] = $request->nid_number;
                $data['present_address'] = $request->present_address;
                $data['permanent_address'] = $request->permanent_address;
                $data['birth_date'] = $request->birth_date;
                $data['blood_group'] = $request->blood_group;
                $data['nationality'] = $request->nationality;
                $data['marital_status'] = $request->marital_status;
                $data['religion'] = $request->religion;
                $data['gender'] = $request->gender;
                $data['emergency_contact_name'] = $request->emergency_contact_name;
                $data['emergency_contact_number'] = $request->emergency_contact_number;
                $data['emergency_contact_relation'] = $request->emergency_contact_relation;

                $updated = DB::table('super_admins')
                            ->where('user_id', $user_id)
                            ->update($data);

                if(($updated == true) || ($update_user_data == true)){
                    $response = [
                        'success' => true,
                        'message' => 'Member information are updated successfully'
                    ];
                    return response()->json($response,200);
                }else{
                    $response = [
                    'success' => false,
                    'message' => 'Error occured'
                    ];              
                    return response()->json($response);
                }
                            
            }else{
                $member_name = $request->input('name');
                $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);
                $data = array();
                $data['father_name'] = $request->father_name;
                $data['mother_name'] = $request->mother_name;
                $data['mobile_number'] = $request->mobile_number;
                $data['nid_number'] = $request->nid_number;
                $data['present_address'] = $request->present_address;
                $data['permanent_address'] = $request->permanent_address;
                $data['birth_date'] = $request->birth_date;
                $data['blood_group'] = $request->blood_group;
                $data['nationality'] = $request->nationality;
                $data['marital_status'] = $request->marital_status;
                $data['religion'] = $request->religion;
                $data['gender'] = $request->gender;
                $data['emergency_contact_name'] = $request->emergency_contact_name;
                $data['emergency_contact_number'] = $request->emergency_contact_number;
                $data['emergency_contact_relation'] = $request->emergency_contact_relation;
                $data['flag'] = '1';

                $updated = DB::table('super_admins')
                            ->where('user_id', $user_id)
                            ->update($data);

                if(($updated == true) || ($update_user_data == true)){
                    $response = [
                        'success' => true,
                        'message' => 'Member information are added successfully'
                    ];
                    return response()->json($response,200);
                }else{
                    $response = [
                    'success' => false,
                    'message' => 'Error occured'
                    ];              
                    return response()->json($response);
                }
            }
        }

      }


}
