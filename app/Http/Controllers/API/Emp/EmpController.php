<?php

namespace App\Http\Controllers\API\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class EmpController extends Controller
{
    
    public function add_new_employee(){
            
        
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();
        
        $divisions = DB::table('divisions')->get();
        $roles = DB::table('roles')->get();
        $designations = DB::table('designations')->get();
        $business_types = DB::table('business_types')->get();

        
        return view('employees.add_new_employee_form',compact('current_module','divisions','roles','designations','business_types'));
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
