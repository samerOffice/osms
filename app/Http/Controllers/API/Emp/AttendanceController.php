<?php

namespace App\Http\Controllers\API\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;

class AttendanceController extends Controller
{
    public function give_attendance(){
        $current_modules = array();
        $current_modules['module_status'] = '2';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

    $user_id = Auth::user()->id;

        $designation = DB::table('users')
                            ->leftJoin('designations','users.designation','=','designations.id')
                            ->select('designations.designation_name as designation_name')
                            ->where('users.id',$user_id)
                            ->first();
                            
        // dd($designation->designation_name);
        
        return view('attendances.create',compact('current_module','designation'));
    }

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
            'message' => 'User attendance is submitted successfully'
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

        if($user_role_id == 1){
         
        $attendances = DB::table('attendances')
                       ->leftJoin('users','attendances.user_id','=','users.id')
                       ->select('attendances.*','users.name as member_name')
                       ->get();

        return view('attendances.index',compact('current_module','attendances'));

        }elseif($user_role_id == 2){

        $attendances = DB::table('attendances')
                       ->leftJoin('users','attendances.user_id','=','users.id')
                       ->select('attendances.*','users.name as member_name')
                       ->where('users.company_id',$user_company_id)
                       ->get();

        return view('attendances.index',compact('current_module','attendances'));

        }else{
            $attendances = DB::table('attendances')
            ->leftJoin('users','attendances.user_id','=','users.id')
            ->select('attendances.*','users.name as member_name')
            ->where('users.id',$user_id)
            ->get();

        return view('attendances.index',compact('current_module','attendances'));
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
