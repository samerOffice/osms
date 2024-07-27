<?php

namespace App\Http\Controllers\API\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use DB;
use Auth;

class EmpController extends Controller
{
    
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
                    ->get();
        $designations = DB::table('designations')->get();
        // $business_types = DB::table('business_types')->get();

        
        return view('employees.add_new_employee_form',compact('current_module','branches','designations'));
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
        $branch_id = $request->branch_id;

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = '3';
        $user->company_id = $company_id;
        $user->branch_id = $branch_id;
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
        'user_id'=>$user->id
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
    
    
    
    
    
    
    
    
    
    public function add_additional_member_info(){

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
                        $member_name = $request->input('name');
                        $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);
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
