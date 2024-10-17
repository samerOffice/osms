<?php

namespace App\Http\Controllers\API\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function give_attendance()
    {
        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();
    
        $user_id = Auth::user()->id;
    
        // Get user designation
        $designation = DB::table('users')
            ->leftJoin('designations', 'users.designation', '=', 'designations.id')
            ->select('designations.designation_name as designation_name')
            ->where('users.id', $user_id)
            ->first();

        $branch_details = DB::table('users')
                            ->leftJoin('branches','users.branch_id','=','branches.id')
                            ->select('branches.br_name as branch_name','branches.longitude as branch_longitude','branches.latitude as branch_latitude')
                            ->where('users.id', $user_id)
                            ->first();
    
        // Get the last attendance record
        $attendances = DB::table('attendances')
            ->select('user_id', 'attendance_date', 'created_at')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->first();
    
        $canAttend = true; // Default value
    
        // Check if the user has attended within the last 24 hours
        if ($attendances) {
            $lastAttendanceTime = \Carbon\Carbon::parse($attendances->created_at);
            $hoursSinceLastAttendance = \Carbon\Carbon::now()->diffInHours($lastAttendanceTime);
    
            if ($hoursSinceLastAttendance < 24) {
                $canAttend = false;
            }
        }
        $menu_data = DB::table('menu_permissions')
              ->where('user_id',$user_id)
              ->first();
      if($menu_data == null){
        return view('attendances.create', compact('current_module', 'designation', 'branch_details',  'canAttend'));
        }else{
          $permitted_menus = $menu_data->menus;
          $permitted_menus_array = explode(',', $permitted_menus);

          return view('attendances.create', compact('current_module', 'designation', 'branch_details', 'canAttend','permitted_menus_array'));
            }
         
    }


     // employee entry
     public function submit_attendance(Request $request){

        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        $attendance = DB::table('attendances')
        ->insertGetId([
        'user_id'=>$user_id,
        'attendance_date' =>$currentDate,
        'entry_time'=>$currentTime
        ]);

        $response = [
            'success' => true,
            'attendance_id' => $attendance,
            'message' => 'Check-in successfully'
        ];

        return response()->json($response,200);

    }


    public function exit_attendance(){

        $current_modules = ['module_status' => '2'];
        DB::table('current_modules')->update($current_modules);
        $current_module = DB::table('current_modules')->first();
    
        $user_id = Auth::user()->id;
    
        // Get user designation
        $designation = DB::table('users')
                            ->leftJoin('designations', 'users.designation', '=', 'designations.id')
                            ->select('designations.designation_name as designation_name')
                            ->where('users.id', $user_id)
                            ->first();

        $branch_details = DB::table('users')
                            ->leftJoin('branches','users.branch_id','=','branches.id')
                            ->select('branches.br_name as branch_name','branches.longitude as branch_longitude','branches.latitude as branch_latitude')
                            ->where('users.id', $user_id)
                            ->first();

        $attendance = DB::table('attendances')
                          ->whereDate('created_at', '=', \Carbon\Carbon::today())
                          ->where('user_id',$user_id)
                          ->first();


        $menu_data = DB::table('menu_permissions')
                        ->where('user_id',$user_id)
                        ->first();

      if($menu_data == null){
        return view('attendances.exit', compact('current_module', 'designation', 'branch_details', 'attendance'));
        }else{
          $permitted_menus = $menu_data->menus;
          $permitted_menus_array = explode(',', $permitted_menus);

          return view('attendances.exit', compact('current_module', 'designation', 'branch_details', 'attendance','permitted_menus_array'));
            }
    }
    

   
    public function submit_exit_time(Request $request, $id){

        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        // $attendance = DB::table('attendances')
        //                 ->insertGetId([
        //                 'user_id'=>$user_id,
        //                 'attendance_date' =>$currentDate,
        //                 'entry_time'=>$currentTime
        //                 ]);


        $attendance = DB::table('attendances')
                         ->where('id',$id)
                         ->update(['exit_time' => $currentTime]);


        $response = [
            'success' => true,
            'message' => 'Check-out successfully'
        ];

        return response()->json($response,200);

    }


    //web
    public function attendance_list(){
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->role_id;

        if($user_role_id == 2){
        $attendances = DB::table('attendances')
                       ->leftJoin('users','attendances.user_id','=','users.id')
                       ->select('attendances.*','users.name as member_name')
                       ->where('users.company_id',$user_company_id)
                       ->orderBy('attendances.id', 'DESC')
                       ->get();

        return view('attendances.index',compact('current_module','attendances'));

        }else{
            
            $attendances = DB::table('attendances')
            ->leftJoin('users','attendances.user_id','=','users.id')
            ->select('attendances.*','users.name as member_name')
            ->where('users.id',$user_id)
            ->orderBy('attendances.id', 'DESC')
            ->get();

        
            $menu_data = DB::table('menu_permissions')
                            ->where('user_id',$user_id)
                            ->first();

            if($menu_data == null){
                return view('attendances.index',compact('current_module','attendances'));
            }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);

                return view('attendances.index',compact('current_module','attendances','permitted_menus_array'));
          }
     
        }

        
    }

    // attendance list (api purpose)
    public function all_attendance_list(){

        $attendances = DB::table('attendances')
                       ->leftJoin('users','attendances.user_id','=','users.id')
                       ->select('attendances.*','users.name as member_name')
                       ->get();
      
        $response = [
            'success' => true,
            'data' => $attendances
        ];

        return response()->json($response,200);
    }
}
