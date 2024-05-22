<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class ProductController extends Controller
{
    //item category
    public function add_item_category(){

        $current_modules = array();
        $current_modules['module_status'] = '3';
        $update_module = DB::table('current_modules')
                    // ->where('id', $request->id)
                    ->update($current_modules);
        $current_module = DB::table('current_modules')->first();

        return view('item_categories.create',compact('current_module'));
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


    //product category
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
                           ->get();

        return view('product_categories.create',compact('current_module','item_categories'));
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


    //product

    public function itemCategoryAndProductCategoryDependancy(Request $request){

        $selectedItemCategoryId = $request->input('data');
        $product_categories = DB::connection('inventory')
                    ->table('product_categories')
                    ->where('item_category_id',$selectedItemCategoryId)
                    ->get();
  
      $str="<option value=''>-- Select --</option>";
      foreach ($product_categories as $product_category) {
         $str .= "<option value='$product_category->id'> $product_category->name </option>";
         
      }
      echo $str;
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

        return view('products.create',compact('current_module','item_categories'));

    }

    ///// note :: must be update after 22/05/2024 
    public function submit_product(Request $request){
        $user_company_id = Auth::user()->company_id;
       
        $item_category = DB::connection('inventory')
                        ->table('products')
                        ->insertGetId([
                        'item_category_id' =>$request->item_category_id,
                        'product_category_id' =>$request->product_category_id,
                        'product_type' =>$request->product_type,
                        'product_name' =>$request->product_name,
                        'product_single_price' =>$request->product_single_price,
                        'labeling_type' =>$request->labeling_type,
                        'batch_number' =>$request->batch_number,
                        'product_tag_number' =>$request->product_tag_number,
                        'product_weight' =>$request->product_weight,
                        'quantity' =>$request->quantity,
                        'additional_product_details' =>$request->additional_product_details,
                        'product_entry_date' =>$request->product_entry_date,
                        'product_mfg_date' =>$request->product_mfg_date,
                        'product_expiry_date' =>$request->product_expiry_date,
                        'total_product_in_a_batch' =>$request->total_product_in_a_batch,
                        'product_batch_price' =>$request->product_batch_price,
                        'shop_company_id'=>$user_company_id                       
                        ]);

        $response = [
            'success' => true,
            'message' => 'Product is added successfully'
        ];

        return response()->json($response,200);
    }
}
