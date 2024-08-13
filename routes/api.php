<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\API\SuperAdmin\DesignationController;
use App\Http\Controllers\API\SuperAdmin\BusinessTypeController;

use App\Http\Controllers\API\Admin\BranchController;
use App\Http\Controllers\API\Admin\OutletController;
use App\Http\Controllers\API\Admin\WarehouseController;
use App\Http\Controllers\API\Admin\DepartmentController;
use App\Http\Controllers\API\Admin\SupplierController;

use App\Http\Controllers\API\Emp\EmpController;
use App\Http\Controllers\API\Emp\AttendanceController;
use App\Http\Controllers\API\Emp\PayrollController;

use App\Http\Controllers\API\Inventory\ProductController;
use App\Http\Controllers\API\Inventory\ProductRequisitionController;
use App\Http\Controllers\API\Inventory\StockController;

use App\Http\Controllers\API\POS\InvoiceController;
use App\Http\Controllers\API\POS\CustomerController;


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


//..............********** Super Admin/ Admin dashboard module **********...........
//branch
Route::middleware('auth:sanctum')->post('/branch_store',[App\Http\Controllers\API\Admin\BranchController::class,'branch_store']);
Route::middleware('auth:sanctum')->get('/edit_branch/{branch_id}',[App\Http\Controllers\API\Admin\BranchController::class,'edit_branch_via_api']);
Route::middleware('auth:sanctum')->post('/update_branch/{branch_id}',[App\Http\Controllers\API\Admin\BranchController::class,'update_branch']);
// Route::middleware('auth:sanctum')->patch('/update_branch/{branch_id}',[App\Http\Controllers\API\Admin\BranchController::class,'update_branch']);

//outlet
Route::middleware('auth:sanctum')->post('/outlet_store',[App\Http\Controllers\API\Admin\OutletController::class,'outlet_store']);
Route::middleware('auth:sanctum')->get('/edit_outlet/{outlet_id}',[App\Http\Controllers\API\Admin\OutletController::class,'edit_outlet_via_api']);
Route::middleware('auth:sanctum')->post('/update_outlet/{outlet_id}',[App\Http\Controllers\API\Admin\OutletController::class,'update_outlet']);

//warehouse
Route::middleware('auth:sanctum')->post('/warehouse_store',[App\Http\Controllers\API\Admin\WarehouseController::class,'warehouse_store']);
Route::middleware('auth:sanctum')->get('/edit_warehouse/{warehouse_id}',[App\Http\Controllers\API\Admin\WarehouseController::class,'edit_warehouse_via_api']);
Route::middleware('auth:sanctum')->post('/update_warehouse/{warehouse_id}',[App\Http\Controllers\API\Admin\WarehouseController::class,'update_warehouse']);

//department
Route::middleware('auth:sanctum')->post('/branch_warehouse_dependancy',[App\Http\Controllers\API\Admin\DepartmentController::class,'branch_warehouse_dependancy']);
Route::middleware('auth:sanctum')->post('/branch_outlet_dependancy',[App\Http\Controllers\API\Admin\DepartmentController::class,'branch_outlet_dependancy']);
Route::middleware('auth:sanctum')->post('/department_store',[App\Http\Controllers\API\Admin\DepartmentController::class,'department_store']);
Route::middleware('auth:sanctum')->get('/edit_department/{department_id}',[App\Http\Controllers\API\Admin\DepartmentController::class,'edit_department_via_api']);
Route::middleware('auth:sanctum')->post('/update_department/{department_id}',[App\Http\Controllers\API\Admin\DepartmentController::class,'update_department']);

//designation
Route::middleware('auth:sanctum')->post('/designation_store',[App\Http\Controllers\API\SuperAdmin\DesignationController::class,'designation_store']);
Route::middleware('auth:sanctum')->get('/edit_designation/{designation_id}',[App\Http\Controllers\API\SuperAdmin\DesignationController::class,'edit_designation_via_api']);
Route::middleware('auth:sanctum')->post('/update_designation/{designation_id}',[App\Http\Controllers\API\SuperAdmin\DesignationController::class,'update_designation']);
Route::middleware('auth:sanctum')->post('/delete_designation/{designation_id}',[App\Http\Controllers\API\SuperAdmin\DesignationController::class,'delete_designation']);


//supplier
Route::middleware('auth:sanctum')->post('/supplier_store',[App\Http\Controllers\API\Admin\SupplierController::class,'supplier_store']);
Route::middleware('auth:sanctum')->get('/edit_supplier/{suppiler_id}',[App\Http\Controllers\API\Admin\SupplierController::class,'edit_supplier_via_api']);
Route::middleware('auth:sanctum')->post('/update_supplier/{suppiler_id}',[App\Http\Controllers\API\Admin\SupplierController::class,'update_supplier']);
Route::middleware('auth:sanctum')->post('/delete_supplier/{suppiler_id}',[App\Http\Controllers\API\Admin\SupplierController::class,'delete_supplier']);



//business type
Route::middleware('auth:sanctum')->post('/business_type_store',[App\Http\Controllers\API\SuperAdmin\BusinessTypeController::class,'business_type_store']);
Route::middleware('auth:sanctum')->get('/edit_business_type/{business_type_id}',[App\Http\Controllers\API\SuperAdmin\BusinessTypeController::class,'edit_business_type_via_api']);
Route::middleware('auth:sanctum')->post('/update_business_type/{business_type_id}',[App\Http\Controllers\API\SuperAdmin\BusinessTypeController::class,'update_business_type']);

//users
Route::middleware('auth:sanctum')->get('/edit_user/{user_id}',[App\Http\Controllers\API\AuthController::class,'edit_user']);
Route::middleware('auth:sanctum')->post('/update_user_details/{user_id}',[App\Http\Controllers\API\AuthController::class,'update_user_details']);



//...............********* employee management module ********................

Route::post('/register',[App\Http\Controllers\API\AuthController::class,'register']);
Route::post('/login',[App\Http\Controllers\API\AuthController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[App\Http\Controllers\API\AuthController::class,'logout']);
Route::post('/division',[App\Http\Controllers\HomeController::class,'division']);

//member (super admin, admin, employee, vernodr) personal information store
Route::middleware('auth:sanctum')->post('/member_information_store',[App\Http\Controllers\API\Emp\EmpController::class,'member_information_store']);

//employee store
Route::middleware('auth:sanctum')->post('/level_designation_dependancy',[App\Http\Controllers\API\Emp\EmpController::class,'level_designation_dependancy']);
Route::middleware('auth:sanctum')->post('/store_employee',[App\Http\Controllers\API\Emp\EmpController::class,'store_employee']);

//employee official information update
Route::middleware('auth:sanctum')->get('/edit_employee_official_info/{employee_id}',[App\Http\Controllers\API\Emp\EmpController::class,'edit_employee_official_info_via_api']);
Route::middleware('auth:sanctum')->post('/update_employee_official_info/{employee_id}',[App\Http\Controllers\API\Emp\EmpController::class,'update_employee_official_info']);

//new password set
Route::middleware('auth:sanctum')->post('/new_password_set',[App\Http\Controllers\API\Emp\EmpController::class,'new_password_set']);

//attendance
Route::middleware('auth:sanctum')->post('/submit_attendance',[App\Http\Controllers\API\Emp\AttendanceController::class,'submit_attendance']);
Route::middleware('auth:sanctum')->get('/all_attendance_list',[App\Http\Controllers\API\Emp\AttendanceController::class,'all_attendance_list']);

//dependencies (payroll)
Route::middleware('auth:sanctum')->post('/member_details_dependancy', [PayrollController::class, 'member_details_dependancy']);



//...............********* inventory management module ********................

//stock
Route::middleware('auth:sanctum')->post('/add_barcode/{stock_id}',[App\Http\Controllers\API\Inventory\StockController::class,'add_barcode']);
Route::middleware('auth:sanctum')->post('/delete_barcode/{stock_id}',[App\Http\Controllers\API\Inventory\StockController::class,'delete_barcode']);
Route::middleware('auth:sanctum')->post('/add_sku/{stock_id}',[App\Http\Controllers\API\Inventory\StockController::class,'add_sku']);
Route::middleware('auth:sanctum')->post('/delete_sku/{stock_id}',[App\Http\Controllers\API\Inventory\StockController::class,'delete_sku']);
Route::middleware('auth:sanctum')->post('/update_damage_product/{stock_id}',[App\Http\Controllers\API\Inventory\StockController::class,'update_damage_product']);

//requisition
Route::middleware('auth:sanctum')->post('/requisition_store', [App\Http\Controllers\API\Inventory\ProductRequisitionController::class, 'requisition_store']);
Route::middleware('auth:sanctum')->get('/requisition_edit/{requisition_order_id}', [App\Http\Controllers\API\Inventory\ProductRequisitionController::class, 'requisition_edit']);
Route::middleware('auth:sanctum')->post('/requisition_update/{requisition_order_id}',[App\Http\Controllers\API\Inventory\ProductRequisitionController::class,'requisition_update']);
Route::post('/product_information_dependancy',[App\Http\Controllers\API\Inventory\ProductRequisitionController::class,'ProductInfoDependancy']);
Route::get('/products',[App\Http\Controllers\API\Inventory\ProductRequisitionController::class,'productList']);
Route::get('/monthly_sales_purchases',[App\Http\Controllers\API\Inventory\ProductRequisitionController::class,'monthlySalesPurchases']);
Route::get('/total_available_products',[App\Http\Controllers\API\Inventory\ProductRequisitionController::class,'totalAvailableProducts']);
Route::get('/total_near_expired_products',[App\Http\Controllers\API\Inventory\ProductRequisitionController::class,'totalNearExpiredProducts']);
Route::get('/total_damaged_products',[App\Http\Controllers\API\Inventory\ProductRequisitionController::class,'totalDamagedProducts']);

//item category
Route::middleware('auth:sanctum')->post('/submit_item_category', [App\Http\Controllers\API\Inventory\ProductController::class, 'submit_item_category']);
Route::middleware('auth:sanctum')->get('/edit_item_category/{item_category_id}',[App\Http\Controllers\API\Inventory\ProductController::class,'edit_item_category_via_api']);
Route::middleware('auth:sanctum')->post('/update_item_category/{item_category_id}',[App\Http\Controllers\API\Inventory\ProductController::class,'update_item_category']);

//product category
Route::middleware('auth:sanctum')->post('/submit_product_category', [App\Http\Controllers\API\Inventory\ProductController::class, 'submit_product_category']);
Route::middleware('auth:sanctum')->get('/edit_product_category/{product_category_id}',[App\Http\Controllers\API\Inventory\ProductController::class,'edit_product_category_via_api']);
Route::middleware('auth:sanctum')->post('/update_product_category/{product_category_id}',[App\Http\Controllers\API\Inventory\ProductController::class,'update_product_category']);

//product
Route::post('/item_category_and_product_category_dependancy',[App\Http\Controllers\API\Inventory\ProductController::class,'itemCategoryAndProductCategoryDependancy']);
Route::middleware('auth:sanctum')->post('/submit_product',[App\Http\Controllers\API\Inventory\ProductController::class,'submit_product']);
Route::middleware('auth:sanctum')->get('/edit_product/{product_id}',[App\Http\Controllers\API\Inventory\ProductController::class,'edit_product_via_api']);
Route::middleware('auth:sanctum')->post('/update_product/{product_id}',[App\Http\Controllers\API\Inventory\ProductController::class,'update_product']);
Route::middleware('auth:sanctum')->post('/delete_product/{product_id}',[App\Http\Controllers\API\Inventory\ProductController::class,'delete_product']);




//...............********* pos module ********................

// Route::middleware('auth:sanctum')->post('/submit_invoice',[App\Http\Controllers\API\POS\InvoiceController::class,'submit_invoice']);
// Route::post('/product_and_price_dependancy',[App\Http\Controllers\API\POS\InvoiceController::class,'product_and_price_dependancy']);


//invoice (sale)
Route::post('/sku_product_information_dependancy',[App\Http\Controllers\API\POS\InvoiceController::class,'SkuProductInfoDependancy']);
Route::middleware('auth:sanctum')->post('/sale_store', [App\Http\Controllers\API\POS\InvoiceController::class, 'sale_store']);
Route::get('/previous_and_current_monthly_sales',[App\Http\Controllers\API\POS\InvoiceController::class,'previousAndCurrentMonthSale']);
//customer
Route::middleware('auth:sanctum')->post('/customer_store',[App\Http\Controllers\API\POS\CustomerController::class,'customer_store']);
Route::middleware('auth:sanctum')->get('/edit_customer/{customer_id}',[App\Http\Controllers\API\POS\CustomerController::class,'edit_customer_via_api']);
Route::middleware('auth:sanctum')->post('/update_customer/{customer_id}',[App\Http\Controllers\API\POS\CustomerController::class,'update_customer']);
Route::middleware('auth:sanctum')->post('/delete_customer/{customer_id}',[App\Http\Controllers\API\POS\CustomerController::class,'delete_customer']);