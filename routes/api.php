<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\API\Emp\EmpController;
use App\Http\Controllers\API\Emp\AttendanceController;
use App\Http\Controllers\API\Emp\BranchController;
use App\Http\Controllers\API\Inventory\ProductController;
use App\Http\Controllers\API\POS\InvoiceController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//...............********* employee management module ********................

Route::post('/register',[App\Http\Controllers\API\AuthController::class,'register']);
Route::post('/login',[App\Http\Controllers\API\AuthController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[App\Http\Controllers\API\AuthController::class,'logout']);
Route::post('/division',[App\Http\Controllers\HomeController::class,'division']);
//member personal information store
Route::middleware('auth:sanctum')->post('/member_information_store',[App\Http\Controllers\API\Emp\EmpController::class,'member_information_store']);
//attendance
Route::middleware('auth:sanctum')->post('/submit_attendance',[App\Http\Controllers\API\Emp\AttendanceController::class,'submit_attendance']);
Route::middleware('auth:sanctum')->get('/all_attendance_list',[App\Http\Controllers\API\Emp\AttendanceController::class,'all_attendance_list']);
//branch
Route::middleware('auth:sanctum')->post('/branch_store',[App\Http\Controllers\API\Emp\BranchController::class,'branch_store']);
Route::middleware('auth:sanctum')->get('/edit_branch/{branch_id}',[App\Http\Controllers\API\Emp\BranchController::class,'edit_branch_via_api']);
Route::middleware('auth:sanctum')->put('/update_branch/{branch_id}',[App\Http\Controllers\API\Emp\BranchController::class,'update_branch']);
// Route::middleware('auth:sanctum')->patch('/update_branch/{branch_id}',[App\Http\Controllers\API\Emp\BranchController::class,'update_branch']);



//...............********* inventory management module ********................
//item category
Route::middleware('auth:sanctum')->post('/submit_item_category', [App\Http\Controllers\API\Inventory\ProductController::class, 'submit_item_category']);
//product category
Route::middleware('auth:sanctum')->post('/submit_product_category', [App\Http\Controllers\API\Inventory\ProductController::class, 'submit_product_category']);
//product
Route::post('/item_category_and_product_category_dependancy',[App\Http\Controllers\API\Inventory\ProductController::class,'itemCategoryAndProductCategoryDependancy']);
Route::middleware('auth:sanctum')->post('/submit_product',[App\Http\Controllers\API\Inventory\ProductController::class,'submit_product']);

//...............********* pos module ********................
Route::middleware('auth:sanctum')->post('/submit_invoice',[App\Http\Controllers\API\POS\InvoiceController::class,'submit_invoice']);
