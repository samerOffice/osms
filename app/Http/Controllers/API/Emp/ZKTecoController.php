<?php

namespace App\Http\Controllers\API\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
// use App\Services\ZKTecoService;
use Jmrashed\Zkteco\Lib\ZKTeco;

class ZKTecoController extends Controller
{
    
    // protected $zktecoService;

    // public function __construct(ZKTecoService $zktecoService)
    // {
    //     $this->zktecoService = $zktecoService;
    // }

    public function fingerprint_attendances()
    {
       $my_device_ip =  Session::get('zkteco_ip');
        $zk = new ZKTeco($my_device_ip);
        $connected = $zk->connect();
        $attendances = $zk->getAttendance();

        // Get today's date
        $todayDate = date('2024-10-24');

        // Filter attendance records for today
        $todayRecords = [];
        foreach ($attendances as $record) {
            // Extract the date from the timestamp
            $recordDate = substr($record['timestamp'], 0, 10);

            // Check if the date matches today's date
            if ($recordDate === $todayDate) {

                $user = DB::table('attendance_users')
                ->join('users', 'attendance_users.system_user_id', '=', 'users.id')
                ->select('attendance_users.machine_user_id', 'attendance_users.uid', 'users.name','users.id')
                ->where('attendance_users.machine_user_id', $record['id'])
                ->first();
    
                    if ($user) {
                        // Store the required data in the $todayRecords array
                        $todayRecords[] = [
                            'system_user_id' => $user->id,
                            'machine_user_id' => $user->machine_user_id,
                            'uid' => $user->uid,
                            'name' => $user->name,
                            'timestamp' => date('Y-m-d h:i:s A', strtotime($record['timestamp']))
                        ];
                    }
            }
        }


        return response()->json(['attendances' => $todayRecords]);
    }


    public function select_attendance_type(){
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();



        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('fingerprints.select',compact('current_module'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('fingerprints.select',compact('current_module','permitted_menus_array'));
                }
    }


    public function attendance_type_submit(Request $request){
   
        $attendance_type = $request->attendance_type;
        //daily
        if($attendance_type == 1){
        $my_device_ip =  Session::get('zkteco_ip');
        $zk = new ZKTeco($my_device_ip);
        $connected = $zk->connect();
        $attendances = $zk->getAttendance();

        // Get today's date
        $todayDate = Carbon::now()->toDateString();

        // Filter attendance records for today
        $todayRecords = [];
        foreach ($attendances as $record) {
            // Extract the date from the timestamp
            $recordDate = substr($record['timestamp'], 0, 10);

            // Check if the date matches today's date
            if ($recordDate === $todayDate) {

                $user = DB::table('attendance_users')
                ->join('users', 'attendance_users.system_user_id', '=', 'users.id')
                ->select('attendance_users.machine_user_id', 'attendance_users.uid', 'users.name','users.id')
                ->where('attendance_users.machine_user_id', $record['id'])
                ->first();
    
                    if ($user) {
                        // Store the required data in the $todayRecords array
                        $todayRecords[] = [
                            'system_user_id' => $user->id,
                            'machine_user_id' => $user->machine_user_id,
                            'uid' => $user->uid,
                            'name' => $user->name,
                            'timestamp' => date('Y-m-d h:i:s A', strtotime($record['timestamp']))
                        ];
                    }
            }
        }
        return response()->json(['attendances' => $todayRecords]);
        //monthly
        }else{
        
        }
    }
    
    
    public function set_fingerprint_device_ip(){

        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();



        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('fingerprints.set_ip',compact('current_module'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('fingerprints.set_ip',compact('current_module','permitted_menus_array'));
                }
    }


    public function store_ip(Request $request)
    {
        // Store the IP in the session (or use a database)
        Session::put('zkteco_ip', $request->input('device_ip'));
        return redirect()->back()->with('message', 'IP Address saved successfully.');
    }

    public function add_fingerprint_user(){

        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $user_id = Auth::user()->id;
        $user_company_id = Auth::user()->company_id;

        $users = DB::table('users')
                    ->select('id','name')
                    ->where('company_id',$user_company_id)
                    ->get();

        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('fingerprints.create',compact('current_module','users'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('fingerprints.create',compact('current_module','users','permitted_menus_array'));
                }
    }


    public function user_fingerprint_data_store(Request $request){

        $user_company_id = Auth::user()->company_id;
        $user_branch_id = Auth::user()->branch_id;

        $system_user_id = $request->system_user_id;

        $system_user_name = DB::table('users')
                               ->select('name')
                               ->where('id',$system_user_id)
                               ->first();

        $name = $system_user_name->name;

        $uid = $request->uid;
        $machine_user_id = $request->machine_user_id;
        $role_id = $request->role_id;
        $company_id = $user_company_id;
        $branch_id = $user_branch_id;
        $user_create_date = Carbon::now()->toDateString();
        $password = $request->password;
        $card_no = $request->card_no;

        $my_device_ip =  Session::get('zkteco_ip');
        $zk = new ZKTeco($my_device_ip);
        $zk->connect(); 

        $setUserToMachine = $zk->setUser($uid, $machine_user_id, $name, $password, $role_id, $card_no);


        $setUserToSystem = DB::table('attendance_users')
                              ->insertGetId([
                                'uid' => $uid,
                                'system_user_id' => $system_user_id,
                                'machine_user_id' => $machine_user_id,
                                'role_id' => $role_id,
                                'company_id' => $user_company_id,
                                'branch_id' => $branch_id,
                                'user_create_date' => $user_create_date,
                                'password' => $password,
                                'card_no' => $card_no
                                ]);


        if ($setUserToMachine && $setUserToSystem) {
            $response = [
                'success' => true,
                'message' => 'User Fingerprint Data is submitted successfully'
            ];
        
            return response()->json($response, 200);
        }



    }
}
