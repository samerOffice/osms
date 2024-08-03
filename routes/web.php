<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\API\AuthController;

use App\Http\Controllers\API\SuperAdmin\DesignationController;
use App\Http\Controllers\API\SuperAdmin\BusinessTypeController;

use App\Http\Controllers\API\Admin\BranchController;
use App\Http\Controllers\API\Admin\DepartmentController;
use App\Http\Controllers\API\Admin\OutletController;
use App\Http\Controllers\API\Admin\WarehouseController;
use App\Http\Controllers\API\Admin\SupplierController;

use App\Http\Controllers\API\Emp\EmpController;
use App\Http\Controllers\API\Emp\AttendanceController;
use App\Http\Controllers\API\Emp\PayrollController;

use App\Http\Controllers\API\Inventory\ProductController;
use App\Http\Controllers\API\Inventory\ProductRequisitionController;
use App\Http\Controllers\API\Inventory\StockController;

use App\Http\Controllers\API\POS\InvoiceController;


#### CLEAR ALL IN ONE ####
use Illuminate\Support\Facades\Artisan;
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize');
    return 'Caches cleared and configuration files regenerated.';
});


Route::get('/', [HomeController::class, 'index'])->name('login');
Route::get('/registration', [HomeController::class, 'registration'])->name('registration');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home');

//.............**************** for dynamic module **************....................
Route::post('/pos_module_active', [HomeController::class, 'pos_module_active'])->name('posModuleActive');
Route::post('/inventory_module_active', [HomeController::class, 'inventory_module_active'])->name('inventoryModuleActive');
Route::post('/emp_module_active', [HomeController::class, 'emp_module_active'])->name('empModuleActive');

//............**************** Super Admin/Admin Dashboard module **************...................
//branch
Route::get('/branch_list', [BranchController::class, 'branch_list'])->name('branch_list');
Route::get('/add_branch', [BranchController::class, 'add_branch'])->name('add_branch');
Route::get('/edit_branch/{branch_id}', [BranchController::class, 'edit_branch'])->name('edit_branch');

//department
Route::get('/department_list', [DepartmentController::class, 'department_list'])->name('department_list');
Route::get('/add_department', [DepartmentController::class, 'add_department'])->name('add_department');
Route::get('/edit_department/{department_id}', [DepartmentController::class, 'edit_department'])->name('edit_department');

//outlet
Route::get('/outlet_list', [OutletController::class, 'outlet_list'])->name('outlet_list');
Route::get('/add_outlet', [OutletController::class, 'add_outlet'])->name('add_outlet');
Route::get('/edit_outlet/{outlet_id}', [OutletController::class, 'edit_outlet'])->name('edit_outlet');

//warehouse
Route::get('/warehouse_list', [WarehouseController::class, 'warehouse_list'])->name('warehouse_list');
Route::get('/add_warehouse', [WarehouseController::class, 'add_warehouse'])->name('add_warehouse');
Route::get('/edit_warehouse/{warehouse_id}', [WarehouseController::class, 'edit_warehouse'])->name('edit_warehouse');

//designation
Route::get('/designation_list', [DesignationController::class, 'designation_list'])->name('designation_list');
Route::get('/add_designation', [DesignationController::class, 'add_designation'])->name('add_designation');
Route::get('/edit_designation/{designation_id}', [DesignationController::class, 'edit_designation'])->name('edit_designation');

//suppliers
Route::get('/supplier_list', [SupplierController::class, 'supplier_list'])->name('supplier_list');
Route::get('/add_supplier', [SupplierController::class, 'add_supplier'])->name('add_supplier');
Route::get('/edit_supplier/{supplier_id}', [SupplierController::class, 'edit_supplier'])->name('edit_supplier');


//business types
Route::get('/business_type_list', [BusinessTypeController::class, 'business_type_list'])->name('business_type_list');
Route::get('/add_business_type', [BusinessTypeController::class, 'add_business_type'])->name('add_business_type');
Route::get('/edit_business_type/{business_type_id}', [BusinessTypeController::class, 'edit_business_type'])->name('edit_business_type');

//users
Route::get('/user_list', [AuthController::class, 'user_list'])->name('user_list');
Route::get('/edit_user/{user_id}', [AuthController::class, 'edit_user'])->name('edit_user');

//...............********* employee management module ********................
//new employee add
Route::get('/add_new_employee', [EmpController::class, 'add_new_employee'])->name('add_new_employee');

//employee official information update
Route::get('/edit_employee_official_info/{employee_id}', [EmpController::class, 'edit_employee_official_info'])->name('edit_employee_official_info');

//employee personal information update
Route::get('/add_personal_info', [EmpController::class, 'add_personal_info'])->name('add_personal_info');
Route::get('/employee_list', [EmpController::class, 'employee_list'])->name('employee_list');
Route::get('/password_reset', [EmpController::class, 'password_reset'])->name('password_reset');

//payrolls
// Route::resource('payroll', PayrollController::class);
Route::get('/add_payroll', [PayrollController::class, 'create'])->name('add_payroll');
Route::post('/store_payroll', [PayrollController::class, 'store_payroll'])->name('store_payroll');
Route::get('/payroll_list', [PayrollController::class, 'index'])->name('payroll_list');

//dependencies
// Route::post('/employee_details_dependancy', [PayrollController::class, 'employee_details_dependancy']);
Route::get('/payroll_show_data', [PayrollController::class, 'payroll_show_data'])->name('payroll_show_data');
Route::post('/generate-csv', [PayrollController::class, 'generateCsv'])->name('generate-csv');


//attendance
Route::get('/give_attendance', [AttendanceController::class, 'give_attendance'])->name('give_attendance');
Route::get('/attendance_list',[AttendanceController::class,'attendance_list'])->name('attendance_list');




//...............********* inventory management module ********................
//item category
Route::get('/add_item_category', [ProductController::class, 'add_item_category'])->name('add_item_category');
Route::get('/item_category_list', [ProductController::class, 'item_category_list'])->name('item_category_list');
Route::get('/edit_item_category/{item_category_id}', [ProductController::class, 'edit_item_category'])->name('edit_item_category');

//product category
Route::get('/add_product_category', [ProductController::class, 'add_product_category'])->name('add_product_category');
Route::get('/product_category_list', [ProductController::class, 'product_category_list'])->name('product_category_list');
Route::get('/edit_product_category/{product_category_id}', [ProductController::class, 'edit_product_category'])->name('edit_product_category');

//product
Route::get('/add_product', [ProductController::class, 'add_product'])->name('add_product');
Route::get('/product_list', [ProductController::class, 'product_list'])->name('product_list');
Route::get('/edit_product/{product_id}', [ProductController::class, 'edit_product'])->name('edit_product');
// ProductRequisition
Route::get('/requisition_list', [ProductRequisitionController::class, 'requisition_list'])->name('requisition_list');
Route::get('/new_stock', [ProductRequisitionController::class, 'new_stock'])->name('new_stock');
Route::get('/requisition_edit_data/{requisition_order_id}', [ProductRequisitionController::class, 'requisition_edit_data'])->name('requisition_edit_data');
Route::get('/requisition_view/{requisition_order_id}', [ProductRequisitionController::class, 'requisition_view'])->name('requisition_view');
Route::post('/requisition_order_decline', [ProductRequisitionController::class, 'requisition_order_decline'])->name('requisition_order_decline');
Route::post('/requisition_order_receive', [ProductRequisitionController::class, 'requisition_order_receive'])->name('requisition_order_receive');

//stock
Route::get('/stock_list', [StockController::class, 'stock_list'])->name('stock_list');
Route::get('/view_stock/{product_id}', [StockController::class, 'view_stock'])->name('view_stock');
Route::get('/add_label/{product_id}', [StockController::class, 'add_label'])->name('add_label');


//...............********* pos module ********................
//invoice
Route::get('/add_invoice', [InvoiceController::class, 'add_invoice'])->name('add_invoice');
Route::post('/submit_invoice',[InvoiceController::class,'submit_invoice'])->name('submit_invoice');
Route::get('/invoice_show_data', [InvoiceController::class, 'invoice_show_data'])->name('invoice_show_data');