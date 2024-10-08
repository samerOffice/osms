<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use Laravel\Sanctum\Sanctum;
use DB;

// use Laravel\Sanctum\NewAccessToken;

class AuthController extends Controller
{
    public function register(Request $request){

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


        $company = DB::table('companies')
                   ->insertGetId([
                    'company_name' => $request->company_name,
                    'company_email' => $request->company_email,
                    'contact_no' => $request->company_contact_no,
                    'license_no' => $request->company_license_no,
                    'company_address' => $request->company_address,
                    'registration_no' => $request->company_reg_no,
                    'division' => $request->division,
                    'district' => $request->district,
                    'country' => $request->company_country
                   ]);

        $branch = DB::table('branches')
        ->insertGetId([
        'company_id' => $company,
        'br_name' => $request->br_name,
        'br_address' => $request->br_address,
        'br_type' => $request->br_type,
        'br_status' => '1',
        ]);

    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->company_id = $company;
        $user->branch_id = $branch;
        $user->review_requisition = '1';
        $user->designation = $request->designation_name;
        $user->joining_date = $request->joining_date;
        $user->active_status = '1';
        $user->company_business_type = $request->business_type;   
        $user->save();

        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['role_id'] = $user->role_id;
        $success['company_id'] = $user->company_id;
        $success['branch_id'] = $user->branch_id;
        $success['designation_id'] = $user->designation;
        $success['joining_date'] = $user->joining_date;
        $success['company_business_type_id'] = $user->company_business_type;


        $user_company = DB::table('companies')
                           ->where('id',$company)
                           ->first();
        $success['company_name'] = $user_company->company_name;

        $user_branch = DB::table('branches')
                           ->where('id',$branch)
                           ->first();
        $success['branch_name'] = $user_branch->br_name;

        $user_designation = DB::table('designations')
                           ->where('id',$user->designation)
                           ->first();
        $success['designation_name'] = $user_designation->designation_name;

        $role = $user->role_id;


        $selectedItems = implode(',',$request->input('menu'));
        $add_menu_permission = DB::table('menu_permissions')
                                    ->insertGetId([
                                        'role_id' => 2,
                                        'user_id' => $user->id,
                                        'menus' => $selectedItems,
                                    ]);

        if($role == '1'){
        $user = DB::table('super_admins')
        ->insertGetId([
        'user_id'=>$user->id
        ]);
        }elseif($role == '2'){
            $user = DB::table('admins')
            ->insertGetId([
            'user_id'=>$user->id
            ]); 
        }elseif($role == '3'){
            $user = DB::table('employees')
            ->insertGetId([
            'user_id'=>$user->id
            ]); 
        }else{
            $user = DB::table('vendors')
            ->insertGetId([
            'user_id'=>$user->id
            ]); 
        }

        // $success['token'] = $user->createToken('myToken')->plainTextToken;
       
        $response = [
            'success' => true,
            'flag' => 1,
            'message' => 'User is created successfully',
            'data' => $success
        ];

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                        ->update($current_modules);

        return response()->json($response,200); 

    }

    public function login(Request $request){

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            
            $user = Auth::user();

            $user_company_id = Auth::user()->company_id;
            $user_name = Auth::user()->name;

            $company = DB::table('companies')
                        ->where('id',$user_company_id)
                        ->first();

            $shop_name = $company->company_name;
            
            if($user->active_status == 1){ 
                
                $user->tokens()->delete();
                
                $success['token'] = $user->createToken('myToken')->plainTextToken;
                $success['shop_owner_name'] = $user_name;
                $success['shop_name'] = $shop_name;
    
                $current_modules = array();
                $current_modules['module_status'] = '1';
                $update_module = DB::table('current_modules')
                    //   ->where('id', $request->id)
                      ->update($current_modules);
    
    
                $response = [
                    'success' => true,
                    'data' => $success,
                    'flag' => 1,
                    'message' => 'User is logged in successfully'
                ];
                return response()->json($response,200);
            }else{
                Auth::guard('web')->logout();
                $response = [
                    'success' => false,
                    'message' => 'User is not activated'
                    ];      
                    return response()->json($response);
            }
            
   
        }else{
            $response = [
            'success' => false,
            'message' => 'Email and Password did not match'
            ];

            return response()->json($response);
        }

    }


    public function logout(Request $request){
    

        if ( Auth::check()) {
            // User is authenticated, proceed to generate token         
             $user = Auth::user();
            // $token = $user->createToken('token-name')->plainTextToken;
            // $bearerToken = $token;
            Auth::guard('web')->logout();
            // Auth::guard('sanctum')->user()->currentAccessToken()->delete();
            auth()->user()->tokens()->delete();
            
            $current_modules = array();
            $current_modules['module_status'] = '1';
            $update_module = DB::table('current_modules')
                //   ->where('id', $request->id)
                  ->update($current_modules);

            $response = [
                'success' => true,
                'flag' => 1,
                // 'tokai' => $bearerToken,
                'user' => $user,
                'message' => 'User is logged out successfully'
            ];
        } else {
            // User is not authenticated, handle the error
            $response = [
                'success' => false,
                'flag' => 0,
                'message' => 'User is not logged in'
            ];
        }
        return response()->json($response);
    }


    public function add_new_user(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $roles = DB::table('roles')
               ->where('id',2)
               ->first();

        $designations = DB::table('designations')->get();
        $business_types = DB::table('business_types')->get();

        $menus = DB::table('menus')
                    ->where('module_type',1)           
                    ->get();
        $groupedMenus = $menus->groupBy('module_type');

        return view('users.create',compact('current_module','roles','designations','business_types','menus','groupedMenus'));
    }



    public function user_list(){
        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $users = DB::table('users')->get();

        return view('users.index',compact('current_module','users'));
    }


    //for web
    public function edit_user($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user = DB::table('users')
                        ->where('id',$id)
                        ->first();    
        return view('users.edit',compact('current_module','user'));
    }

    //for api
    public function edit_designation_via_api($id){
        $user = DB::table('users')
                        ->where('id',$id)
                        ->first();      
        $response = [
        'user_details' => $user
        ];
       return response()->json($response,200);

    }

    public function update_user_details(Request $request, $id){
      
        $data = array();
        $data['active_status'] = $request->input('active_status');
        try {
            // Update the outlet record in the database
            $updated = DB::table('users')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'User Information is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'User Information update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the user information', 'details' => $e->getMessage()], 500);
        }     
    }

    
}
