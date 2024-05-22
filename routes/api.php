<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\API\EmpController;
use App\Http\Controllers\API\AttendanceController;
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


Route::post('/register',[App\Http\Controllers\API\AuthController::class,'register']);
Route::post('/login',[App\Http\Controllers\API\AuthController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[App\Http\Controllers\API\AuthController::class,'logout']);
Route::post('/division',[App\Http\Controllers\HomeController::class,'division']);
Route::middleware('auth:sanctum')->post('/member_information_store',[App\Http\Controllers\API\EmpController::class,'member_information_store']);
Route::middleware('auth:sanctum')->post('/submit_attendance',[App\Http\Controllers\API\AttendanceController::class,'submit_attendance']);
Route::middleware('auth:sanctum')->get('/all_attendance_list',[App\Http\Controllers\API\AttendanceController::class,'all_attendance_list']);

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
