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
use App\Services\ZKTecoService;
use Jmrashed\Zkteco\Lib\ZKTeco;

class ZKTecoController extends Controller
{
    
    protected $zktecoService;

    public function __construct(ZKTecoService $zktecoService)
    {
        $this->zktecoService = $zktecoService;
    }

    public function getAttendanceLogs()
    {
       $my_device_ip =  Session::get('zkteco_ip');
        $zk = new ZKTeco($my_device_ip);
        $connected = $zk->connect();
        $voiceTest = $zk->testVoice();

        return response()->json(['logs' => $voiceTest]);
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
}
