<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class ProductController extends Controller
{
    //-------------------item category----------------------
    public function item_category_list(){
        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        if($user_role_id == 1){
            $item_categories =  DB::connection('inventory')
                                ->table('item_categories')
                                ->get();


            $user_id = Auth::user()->id;
            $menu_data = DB::table('menu_permissions')
                            ->where('user_id',$user_id)
                            ->first();
            if($menu_data == null){
                return view('item_categories.index',compact('current_module','item_categories'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('item_categories.index',compact('current_module','item_categories','permitted_menus_array'));
                    }

        }else{
            $item_categories = DB::connection('inventory')
                                ->table('item_categories')                 
                                ->where('company_id',$user_company_id)
                                ->get();


            $user_id = Auth::user()->id;
            $menu_data = DB::table('menu_permissions')
                            ->where('user_id',$user_id)
                            ->first();

            if($menu_data == null){
                return view('item_categories.index',compact('current_module','item_categories'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('item_categories.index',compact('current_module','item_categories','permitted_menus_array'));
                    }

        }



    }


    public function add_item_category(){
        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        
        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                            ->where('user_id',$user_id)
                            ->first();
            if($menu_data == null){
                return view('item_categories.create',compact('current_module'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('item_categories.create',compact('current_module','permitted_menus_array'));
                    }
    }


    public function submit_item_category(Request $request){
        $user_company_id = Auth::user()->company_id;
       
        $item_category = DB::connection('inventory')
                        ->table('item_categories')
                        ->insertGetId([
                        'company_id'=>$user_company_id,
                        'name' =>$request->item_category_name,
                        'active_status'=>$request->active_status
                        ]);
        $response = [
            'success' => true,
            'message' => 'Item Category is added successfully'
        ];

        return response()->json($response,200);
    }

     //for web
     public function edit_item_category($id){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $item_category = DB::connection('inventory')
                        ->table('item_categories')
                        ->where('id',$id)
                        ->first();

        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                            ->where('user_id',$user_id)
                            ->first();
            if($menu_data == null){
                return view('item_categories.edit',compact('current_module','item_category'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('item_categories.edit',compact('current_module','item_category','permitted_menus_array'));
                    }

    }
 
    //for api
    public function edit_item_category_via_api($id){

        $item_category = DB::connection('inventory')
                  ->table('item_categories')
                  ->where('id',$id)
                  ->first();
        $response = [
        'item_category_details' => $item_category
        ];
       return response()->json($response,200);
    }

    public function update_item_category(Request $request, $id){

        $user_company_id = Auth::user()->company_id;

        $data = array();
        $data['name'] = $request->input('item_category_name');
        $data['active_status'] = $request->input('active_status');
        try {
            // Update the branch record in the database
            $updated = DB::connection('inventory')
                        ->table('item_categories')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Item Category is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Item Category update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Item Category', 'details' => $e->getMessage()], 500);
        }  
    }

    public function delete_item_category(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::connection('inventory')
                        ->table('item_categories')
                        ->where('id', $id)
                        ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Item Category is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Item Category Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }


    //----------------product category-----------------------

      public function product_category_list(){
        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        if($user_role_id == 1){
            $product_categories =  DB::connection('inventory')
                                ->table('product_categories')
                                ->leftJoin('item_categories','product_categories.item_category_id','item_categories.id')
                                ->select('product_categories.*','item_categories.name as item_category_name')
                                ->get();

            
            $user_id = Auth::user()->id;
            $menu_data = DB::table('menu_permissions')
                                ->where('user_id',$user_id)
                                ->first();
                if($menu_data == null){
                    return view('product_categories.index',compact('current_module','product_categories'));
                    }else{
                    $permitted_menus = $menu_data->menus;
                    $permitted_menus_array = explode(',', $permitted_menus);
                    return view('product_categories.index',compact('current_module','product_categories','permitted_menus_array'));
                        }

        }else{
            $product_categories = DB::connection('inventory')
                                ->table('product_categories')  
                                ->leftJoin('item_categories','product_categories.item_category_id','item_categories.id')
                                ->select('product_categories.*','item_categories.name as item_category_name')            
                                ->where('product_categories.company_id',$user_company_id)
                                ->get();

            $user_id = Auth::user()->id;
            $menu_data = DB::table('menu_permissions')
                                ->where('user_id',$user_id)
                                ->first();
                if($menu_data == null){
                    return view('product_categories.index',compact('current_module','product_categories'));
                    }else{
                    $permitted_menus = $menu_data->menus;
                    $permitted_menus_array = explode(',', $permitted_menus);
                    return view('product_categories.index',compact('current_module','product_categories','permitted_menus_array'));
                        }
        }
    }
    
    public function add_product_category(){
        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $user_company_id = Auth::user()->company_id;

        $item_categories = DB::connection('inventory')
                           ->table('item_categories')
                           ->where('company_id',$user_company_id)
                           ->where('active_status',1)
                           ->get();

        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                            ->where('user_id',$user_id)
                            ->first();
            if($menu_data == null){
                return view('product_categories.create',compact('current_module','item_categories'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('product_categories.create',compact('current_module','item_categories','permitted_menus_array'));
                    }
        
    }

    public function submit_product_category(Request $request){
        $user_company_id = Auth::user()->company_id;
       
        $item_category = DB::connection('inventory')
                        ->table('product_categories')
                        ->insertGetId([
                        'company_id'=>$user_company_id,
                        'name' =>$request->product_category_name,
                        'item_category_id' =>$request->item_category_id,
                        'active_status'=>$request->active_status
                        ]);

        $response = [
            'success' => true,
            'message' => 'Product Category is added successfully'
        ];

        return response()->json($response,200);
    }

       //for web
       public function edit_product_category($id){

        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $product_category = DB::connection('inventory')
                            ->table('product_categories')
                            ->leftJoin('item_categories','product_categories.item_category_id','item_categories.id')
                            ->select('product_categories.*','item_categories.name as item_category_name')    
                            ->where('product_categories.id',$id)
                            ->first();

        $item_categories = DB::connection('inventory')
                           ->table('item_categories')
                           ->where('company_id',$user_company_id)
                           ->where('active_status',1)
                           ->get();



        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                            ->where('user_id',$user_id)
                            ->first();
            if($menu_data == null){
                return view('product_categories.edit',compact('current_module','product_category','item_categories'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('product_categories.edit',compact('current_module','product_category','item_categories','permitted_menus_array'));
                    }

    }
 
    //for api
    public function edit_product_category_via_api($id){

        $item_category = DB::connection('inventory')
                            ->table('product_categories')
                            ->leftJoin('item_categories','product_categories.item_category_id','item_categories.id')
                            ->select('product_categories.*','item_categories.name as item_category_name')    
                            ->where('product_categories.id',$id)
                            ->first();
        $response = [
        'product_category_details' => $item_category
        ];
       return response()->json($response,200);
    }



    public function update_product_category(Request $request, $id){

        $user_company_id = Auth::user()->company_id;

        $data = array();
        $data['name'] = $request->input('product_category_name');
        $data['item_category_id'] = $request->input('item_category_id');
        $data['active_status'] = $request->input('active_status');
        try {
            // Update the branch record in the database
            $updated = DB::connection('inventory')
                        ->table('product_categories')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Product Category is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Product Category update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Product Category', 'details' => $e->getMessage()], 500);
        }  
    }


    public function delete_product_category(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::connection('inventory')
                        ->table('product_categories')
                        ->where('id', $id)
                        ->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Product Category is Deleted Successfully!']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Product Category Failed To Deleted!']);
                }

        // return redirect('/divisions')->with('alert', 'Division is deleted successfully');
    }


    //------------------------------product-------------------------

    public function itemCategoryAndProductCategoryDependancy(Request $request){

        $selectedItemCategoryId = $request->input('data');
        $product_categories = DB::connection('inventory')
                    ->table('product_categories')
                    ->where('item_category_id',$selectedItemCategoryId)
                    ->where('active_status',1)
                    ->get();
  
      $str="<option value=''>-- Select --</option>";
      foreach ($product_categories as $product_category) {
         $str .= "<option value='$product_category->id'> $product_category->name </option>";
         
      }
      echo $str;
      }


      public function product_list(){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        if($user_role_id == 1){

            $products = DB::connection('inventory')
                    ->table('products')
                    ->leftJoin('item_categories','products.item_category_id','item_categories.id')
                    ->leftJoin('product_categories','products.product_category_id','product_categories.id')
                    ->select('products.*','item_categories.name as item_category_name', 'product_categories.name as product_category_name')
                    // ->where('shop_company_id',$user_company_id)
                    ->get();


            $user_id = Auth::user()->id;
            $menu_data = DB::table('menu_permissions')
                    ->where('user_id',$user_id)
                    ->first();
            if($menu_data == null){
                return view('products.index',compact('current_module','products'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('products.index',compact('current_module','products','permitted_menus_array'));
                    }        

        }else{

            $products = DB::connection('inventory')
                    ->table('products')
                    ->leftJoin('item_categories','products.item_category_id','item_categories.id')
                    ->leftJoin('product_categories','products.product_category_id','product_categories.id')
                    ->select('products.*','item_categories.name as item_category_name', 'product_categories.name as product_category_name')
                    ->where('products.shop_company_id',$user_company_id)
                    ->get();


            $user_id = Auth::user()->id;
            $menu_data = DB::table('menu_permissions')
                    ->where('user_id',$user_id)
                    ->first();
            if($menu_data == null){
                return view('products.index',compact('current_module','products'));
                }else{
                $permitted_menus = $menu_data->menus;
                $permitted_menus_array = explode(',', $permitted_menus);
                return view('products.index',compact('current_module','products','permitted_menus_array'));
                    }

        }

        
      }


    public function add_product(){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();


        $user_company_id = Auth::user()->company_id;

        $item_categories = DB::connection('inventory')
                           ->table('item_categories')
                           ->where('company_id',$user_company_id)
                           ->get(); 
                           
        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('products.create',compact('current_module','item_categories'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('products.create',compact('current_module','item_categories','permitted_menus_array'));
                }
   

    }

    public function submit_product(Request $request){
        $user_company_id = Auth::user()->company_id;

        // $product_name = $request->product_name;
        // $product_weight = $request->product_weight;
        // $product_unit_type = $request->product_unit_type;
        
        // $product_special_name = $product_name.'-'.$product_weight.'-'.$product_unit_type;

        $item_category = DB::connection('inventory')
                        ->table('products')
                        ->insertGetId([
                        'item_category_id' =>$request->item_category_id,
                        'product_category_id' =>$request->product_category_id,
                        // 'shop_warehouse_id' =>$request->warehouse_id,
                        'shop_company_id'=>$user_company_id,
                        // 'product_type' =>$request->product_type,
                        'product_name' =>$request->product_name,
                        // 'product_track_name' =>$request->product_name,
                        'labeling_type' =>$request->labeling_type,
                        'product_tag_number' =>$request->product_tag_number,
                        'additional_product_details' =>$request->additional_product_details,
                        'product_weight' =>$request->product_weight,
                        'product_unit_type' =>$request->product_unit_type,

                        // 'quantity' =>$request->quantity,
                        // 'product_unit_price' =>$request->product_unit_price,
                        // 'product_total_price' =>$request->product_total_price, 

                        // 'batch_number' =>$request->batch_number,                        
                        'product_entry_date' =>$request->product_entry_date,
                        'product_mfg_date' =>$request->product_mfg_date,
                        'product_expiry_date' =>$request->product_expiry_date,
                        'product_status' =>1
                        // 'total_product_in_a_batch' =>$request->total_product_in_a_batch,
                        // 'product_batch_price' =>$request->product_batch_price,
                                               
                        ]);

        $response = [
            'success' => true,
            'message' => 'Product is added successfully'
        ];

        return response()->json($response,200);
    }


     //for web
     public function edit_product($id){

        $user_company_id = Auth::user()->company_id;

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                        ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        $product = DB::connection('inventory')
                            ->table('products')
                            ->leftJoin('item_categories','products.item_category_id','item_categories.id')
                            ->leftJoin('product_categories','products.product_category_id','product_categories.id')
                            ->select('products.*','item_categories.name as item_category_name','product_categories.name as product_category_name')    
                            ->where('products.id',$id)
                            ->first();

        $item_categories = DB::connection('inventory')
                           ->table('item_categories')
                           ->where('company_id',$user_company_id)
                           ->where('active_status',1)
                           ->get();


        $user_id = Auth::user()->id;
        $menu_data = DB::table('menu_permissions')
                ->where('user_id',$user_id)
                ->first();
        if($menu_data == null){
            return view('products.edit',compact('current_module','product','item_categories'));
            }else{
            $permitted_menus = $menu_data->menus;
            $permitted_menus_array = explode(',', $permitted_menus);
            return view('products.edit',compact('current_module','product','item_categories','permitted_menus_array'));
                }

    }
 
    //for api
    public function edit_product_via_api($id){

        $product = DB::connection('inventory')
                            ->table('products')
                            ->leftJoin('item_categories','products.item_category_id','item_categories.id')
                            ->leftJoin('product_categories','products.product_category_id','product_categories.id')
                            ->select('products.*','item_categories.name as item_category_name','product_categories.name as product_category_name')    
                            ->where('products.id',$id)
                            ->first();
        $response = [
        'product_details' => $product
        ];
       return response()->json($response,200);
    }


    public function update_product(Request $request, $id){

        $user_company_id = Auth::user()->company_id;

        $current_tag_no  = DB::connection('inventory')
                                ->table('products')    
                                ->where('products.id',$id)
                                ->first();
        $current_tag_number = $current_tag_no->product_tag_number;
        $new_tag_number = $request->input('product_tag_number');

        if($new_tag_number == ''){
        $data = array();
        $data['item_category_id'] = $request->input('item_category_id');
        $data['product_category_id'] = $request->input('product_category_id');
        $data['shop_company_id'] = $user_company_id;
        $data['product_name'] = $request->input('product_name');
        $data['labeling_type'] = $request->input('labeling_type');
        $data['product_tag_number'] = $current_tag_number;
        $data['additional_product_details'] = $request->input('additional_product_details');
        $data['product_weight'] = $request->input('product_weight');
        $data['product_unit_type'] = $request->input('product_unit_type');
        $data['product_entry_date'] = $request->input('product_entry_date');
        $data['product_mfg_date'] = $request->input('product_mfg_date');
        $data['product_expiry_date'] = $request->input('product_expiry_date');
        $data['product_status'] = $request->input('product_status');
        }else{
            $data = array();
            $data['item_category_id'] = $request->input('item_category_id');
            $data['product_category_id'] = $request->input('product_category_id');
            $data['shop_company_id'] = $user_company_id;
            $data['product_name'] = $request->input('product_name');
            $data['labeling_type'] = $request->input('labeling_type');
            $data['product_tag_number'] = $new_tag_number;
            $data['additional_product_details'] = $request->input('additional_product_details');
            $data['product_weight'] = $request->input('product_weight');
            $data['product_unit_type'] = $request->input('product_unit_type');
            $data['product_entry_date'] = $request->input('product_entry_date');
            $data['product_mfg_date'] = $request->input('product_mfg_date');
            $data['product_expiry_date'] = $request->input('product_expiry_date');
            $data['product_status'] = $request->input('product_status');

        }
  
        try {
            // Update the branch record in the database
            $updated = DB::connection('inventory')
                        ->table('products')
                        ->where('id', $id)
                        ->update($data);
        
            // Check if the update was successful
            if ($updated) {
                // Return a success response
                return response()->json(['message' => 'Product is updated successfully'], 200);
            } else {
                // Return a failure response
                return response()->json([
                    'message' => 'Product update failed or no changes were made'
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while updating the Product', 'details' => $e->getMessage()], 500);
        }  
    }



    
    public function delete_product(Request $request, $id)
    {
    	// $id = $request->id;
        $deleted = DB::connection('inventory')->table('products')->where('id', $id)->delete();

        if ($deleted == true) {
                    return response()->json(['success' => true, 'error' => false, 'message' => 'Product is Deleted Successfully !']);
                } else {
                    return response()->json(['success' => false, 'error' => true, 'message' => 'Product Failed To Deleted !']);
                }

    }
}
