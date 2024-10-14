<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class SupplierController extends Controller
{
    public function supplier_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        if($user_role_id == 1){

            $suppliers = DB::table('suppliers')->get();
                                          
        return view('suppliers.index',compact('current_module','suppliers'));

        }else{
            $suppliers = DB::table('suppliers') 
                        ->where('company_id',$user_company_id)
                        ->get();

        return view('suppliers.index',compact('current_module','suppliers'));
        }       

    }

    public function add_supplier(){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('suppliers.create',compact('current_module'));
        
    }

    public function supplier_store(Request $request){
        $user_company_id = Auth::user()->company_id;
        $supplier = DB::table('suppliers')
                ->insertGetId([
                'company_id'=>$user_company_id,
                'full_name'=>$request->full_name,
                'mobile_number'=>$request->mobile_number,
                'official_address'=>$request->official_address,
                'active_status'=>$request->active_status      
                ]);

        $response = [
            'success' => true,
            'message' => 'Supplier is added successfully'
        ];

        return response()->json($response,200);
    }


    //for web
    public function edit_supplier($id){

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $supplier = DB::table('suppliers')
                    ->where('id',$id)
                    ->first();
 
        return view('suppliers.edit',compact('current_module','supplier'));

    }

    //for api
    public function edit_supplier_via_api($id){
        $supplier = DB::table('suppliers')
        ->where('id',$id)
        ->first();
        
        $response = [
        'Supplier Name' => $supplier->full_name,
        'Mobile Number' => $supplier->mobile_number,
        'Official Address' => $supplier->official_address,
        'Active Status' => $supplier->active_status
        ];

       return response()->json($response,200);

    }


    public function update_supplier(Request $request, $id){    
        $data = array();
        $data['full_name'] = $request->full_name;
        $data['mobile_number'] = $request->mobile_number;
        $data['official_address'] = $request->official_address;
        $data['active_status'] = $request->active_status;
       
        try {
            // Update the outlet record in the database
            $updated = DB::table('suppliers')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Supplier is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Supplier update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the supplier', 'details' => $e->getMessage()], 500);
        }     
    }


    public function delete_supplier(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::table('suppliers')->where('id', $id)->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Supplier is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Supplier Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }



    //---------------- ******** Supplier Due part (start) -----------------
    public function supplier_due_list(){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        // $due_list = DB::connection('pos')
        //                 ->table('invoices')
        //                 ->leftJoin('customers', 'invoices.customer_id', '=', 'customers.id')
        //                 ->select(
        //                     'customers.customer_name as customer_name',
        //                     'customers.customer_phone_number as customer_mobile_number',
        //                     'customers.registration_date as customer_registration_date',
        //                     DB::raw('SUM(invoices.due_amount) as total_due')
        //                 )
        //                 ->where('invoices.company_id', $user_company_id)
        //                 ->where('invoices.due_amount', '!=', '')
        //                 ->where('invoices.due_amount', '!=', 0)
        //                 ->groupBy(
        //                     'customers.customer_name',
        //                     'customers.customer_phone_number',
        //                     'customers.registration_date'
        //                 )
        //                 ->get();


         $due_list = DB::connection('inventory')
                        ->table('requisition_orders')
                        ->leftJoin(DB::connection('mysql')->getDatabaseName() . '.suppliers', 'requisition_orders.supplier_id', '=', 'suppliers.id')
                        ->select(
                            'suppliers.full_name as supplier_name',
                            'suppliers.mobile_number as supplier_mobile_number',
                            DB::raw('SUM(requisition_orders.due_amount) as total_due')
                        )
                        ->where('requisition_orders.company_id', $user_company_id)
                        ->where('requisition_orders.due_amount', '!=', '')
                        ->where('requisition_orders.due_amount', '!=', 0)
                        ->groupBy(
                            'suppliers.full_name',
                            'suppliers.mobile_number'
                        )
                        ->get();

        // dd($due_list);

        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                        ->where('user_id',$user_id)
                        ->first();
        if($menu_data == null){
            return view('supplier_dues.index',compact('current_module','due_list'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('supplier_dues.index',compact('current_module','due_list','permitted_menus_array'));
                }

    }




    public function supplier_due_details($mobile_number){

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        $current_modules = array();
        $current_modules['module_status'] = '1';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        
        $supplier_details = DB::table('suppliers')
                                ->where('mobile_number', $mobile_number)
                                ->first();
                                
        $supplier_id = $supplier_details->id;


        $total_due_amount = DB::connection('inventory')
                            ->table('requisition_orders')
                            ->select(DB::raw('SUM(requisition_orders.due_amount) as total_due'))
                            ->where('supplier_id',$supplier_id)
                            ->first();
        
        $due_details = DB::connection('inventory')
                        ->table('requisition_orders')
                        // ->select('id','invoice_date','invoice_track_id', DB::raw('SUM(invoices.due_amount) as total_due'))
                        ->where('supplier_id',$supplier_id)
                        ->where('due_amount', '!=', '')
                        ->where('due_amount', '!=', 0)
                        ->get();
        
        // dd($due_details);

        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                        ->where('user_id',$user_id)
                        ->first();
        if($menu_data == null){
            return view('supplier_dues.due_details',compact('current_module','supplier_details','total_due_amount','due_details'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('supplier_dues.due_details',compact('current_module','supplier_details','total_due_amount','due_details','permitted_menus_array'));
                }

    }



    public function supplier_due_clear(Request $request){
        
        $order_id = $request->order_id;
        $due_clear_amount = $request->clear_due_amount;
        
        $details_from_order = DB::connection('inventory')
                                    ->table('requisition_orders')
                                    ->select('company_id','supplier_id','due_amount','paid_amount')
                                    ->where('id',$order_id)
                                    ->first();

       $company_id = $details_from_order->company_id;
       $supplier_id = $details_from_order->supplier_id;
       $due_amount = $details_from_order->due_amount;
       $paid_amount = $details_from_order->paid_amount;

       $remaining_due_amount = $due_amount - $due_clear_amount;
       $updated_paid_amount = $paid_amount + $due_clear_amount;

       $update =  DB::connection('inventory')
                    ->table('requisition_orders')
                    ->where('id', $order_id)
                    ->update([
                        'due_amount' => $remaining_due_amount,
                        'paid_amount' => $updated_paid_amount
                    ]);


        $insert = DB::connection('inventory')
        ->table('supplier_dues')
        ->insertGetId([
            'due_clear_date' => Carbon::now()->toDateString(),
            'company_id' => $company_id,
            'order_id' => $order_id,
            'supplier_id' => $supplier_id,
            'due_clear_amount' => $due_clear_amount
            ]);

    return redirect()->route('supplier_due_list')->withSuccess('Due is cleared and updated successfully'); 
        
    }
    //---------------- ******** Supplier Due part (end) -----------------



}
