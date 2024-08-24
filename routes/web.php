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
use App\Http\Controllers\API\Admin\BillController;

use App\Http\Controllers\API\Emp\EmpController;
use App\Http\Controllers\API\Emp\AttendanceController;
use App\Http\Controllers\API\Emp\PayrollController;
use App\Http\Controllers\API\Emp\LeaveController;
use App\Http\Controllers\API\Emp\EmployeeReportController;

use App\Http\Controllers\API\Inventory\ProductController;
use App\Http\Controllers\API\Inventory\ProductRequisitionController;
use App\Http\Controllers\API\Inventory\StockController;
use App\Http\Controllers\API\Inventory\InventoryReportController;

use App\Http\Controllers\API\POS\InvoiceController;
use App\Http\Controllers\API\POS\CustomerController;
use App\Http\Controllers\API\POS\DueController;
use App\Http\Controllers\API\POS\TermAndConditionController;
use App\Http\Controllers\API\POS\PosReportControlller;



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


//middleware
Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home');

//.............**************** for dynamic module **************....................
Route::get('/pos_module_active', [HomeController::class, 'pos_module_active'])->name('posModuleActive');
Route::get('/inventory_module_active', [HomeController::class, 'inventory_module_active'])->name('inventoryModuleActive');
Route::get('/emp_module_active', [HomeController::class, 'emp_module_active'])->name('empModuleActive');

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


//--- *** bills ***-------

//rents
Route::get('/rent_list', [BillController::class, 'rent_list'])->name('rent_list');
Route::get('/add_rent', [BillController::class, 'add_rent'])->name('add_rent');
Route::get('/edit_rent/{rent_id}', [BillController::class, 'edit_rent'])->name('edit_rent');

//utilities
Route::get('/utility_list', [BillController::class, 'utility_list'])->name('utility_list');
Route::get('/add_utility', [BillController::class, 'add_utility'])->name('add_utility');
Route::get('/edit_utility/{utility_id}', [BillController::class, 'edit_utility'])->name('edit_utility');


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
Route::get('/view_employee_details/{employee_id}', [EmpController::class, 'view_employee_details'])->name('view_employee_details');

//employee official information update
Route::get('/edit_employee_official_info/{employee_id}', [EmpController::class, 'edit_employee_official_info'])->name('edit_employee_official_info');

//employee personal information update
Route::get('/add_personal_info', [EmpController::class, 'add_personal_info'])->name('add_personal_info');
Route::get('/employee_list', [EmpController::class, 'employee_list'])->name('employee_list');
Route::get('/password_reset', [EmpController::class, 'password_reset'])->name('password_reset');

//payrolls
// Route::resource('payroll', PayrollController::class);
Route::get('/add_payroll', [PayrollController::class, 'create'])->name('add_payroll');
// Route::post('/store_payroll', [PayrollController::class, 'store_payroll'])->name('store_payroll');
Route::get('/payroll_list', [PayrollController::class, 'index'])->name('payroll_list');

//dependencies
// Route::post('/employee_details_dependancy', [PayrollController::class, 'employee_details_dependancy']);
Route::get('/payroll_show_data/{payroll_id}', [PayrollController::class, 'payroll_show_data'])->name('payroll_show_data');
Route::post('/generate-csv', [PayrollController::class, 'generateCsv'])->name('generate-csv');


//attendance
Route::get('/give_attendance', [AttendanceController::class, 'give_attendance'])->name('give_attendance');
Route::get('/attendance_list',[AttendanceController::class,'attendance_list'])->name('attendance_list');


//------ *** Leave Application *** -----

//leave application list
Route::get('/leave_applications', [LeaveController::class, 'leave_applications'])->name('leave_applications');

//Leave type
Route::get('/leave_types', [LeaveController::class, 'leave_types'])->name('leave_types');
Route::get('/add_leave_type', [LeaveController::class, 'add_leave_type'])->name('add_leave_type');
Route::get('/edit_leave_type/{leave_type_id}', [LeaveController::class, 'edit_leave_type'])->name('edit_leave_type');

//ways of applying for leave
Route::get('/apply_leave', [LeaveController::class, 'apply_leave'])->name('apply_leave');

// leave application (file attachment)
Route::get('/leave_application_file_attachment', [LeaveController::class, 'leave_application_file_attachment'])->name('leave_application_file_attachment');
Route::get('/edit_file_attachment/{leave_id}', [LeaveController::class, 'edit_file_attachment'])->name('edit_file_attachment');

// leave application (form submission)
Route::get('/leave-application/create', [LeaveController::class, 'create'])->name('leave-application.create');
Route::post('/leave-application', [LeaveController::class, 'store'])->name('leave-application.store');
Route::get('/leave-applications/{id}/edit', [LeaveController::class, 'edit'])->name('edit_leave_application');

//leave application (approval)
Route::get('/leave_application_approval_list', [LeaveController::class, 'leave_application_approval_list'])->name('leave_application_approval_list');
Route::get('/review_leave/{leave_id}', [LeaveController::class, 'review_leave'])->name('review_leave');
Route::post('/approve_leave', [LeaveController::class, 'approve_leave'])->name('approve_leave');
Route::post('/decline_leave', [LeaveController::class, 'decline_leave'])->name('decline_leave');



//----- ** employee reports **------
//top seller report
Route::get('/top_seller_report', [EmployeeReportController::class, 'top_seller_report'])->name('top_seller_report');
Route::post('/top_seller_report_submit', [EmployeeReportController::class, 'top_seller_report_submit'])->name('top_seller_report_submit');


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
Route::get('/damage_product/{product_id}', [StockController::class, 'damage_product'])->name('damage_product');


//----- ** inventory reports **------
//damage report
Route::get('/damage_report', [InventoryReportController::class, 'damage_report'])->name('damage_report');
Route::post('/damage_report_submit', [InventoryReportController::class, 'damage_report_submit'])->name('damage_report_submit');


//...............********* pos module ********................

//invoice (sale)
Route::get('/add_invoice', [InvoiceController::class, 'new_invoice'])->name('add_invoice');
// Route::post('/submit_invoice',[InvoiceController::class,'submit_invoice'])->name('submit_invoice');
 Route::get('/invoice_show_data/{invoice_id}', [InvoiceController::class, 'invoice_show_data'])->name('invoice_show_data');
 Route::get('/sale_list', [InvoiceController::class, 'sale_list'])->name('sale_list');

//customer
Route::get('/customer_list', [CustomerController::class, 'customer_list'])->name('customer_list');
Route::get('/add_customer', [CustomerController::class, 'add_customer'])->name('add_customer');
Route::get('/edit_customer/{customer_id}', [CustomerController::class, 'edit_customer'])->name('edit_customer');

//customer due
Route::get('/customer_due_list', [DueController::class, 'customer_due_list'])->name('customer_due_list');
Route::get('/due_details/{customer_mobile_number}', [DueController::class, 'due_details'])->name('due_details');
Route::post('/clear_due', [DueController::class, 'clear_due'])->name('clear_due');

//terms and conditions
Route::get('/terms_and_conditions', [TermAndConditionController::class, 'terms_and_conditions'])->name('terms_and_conditions');
Route::get('/add_terms_and_conditions', [TermAndConditionController::class, 'add_terms_and_conditions'])->name('add_terms_and_conditions');

//----- ** pos reports **------
//profit and loss report
Route::get('/profit_and_loss_report', [PosReportControlller::class, 'profit_and_loss_report'])->name('profit_and_loss_report');
Route::get('/sale_report', [PosReportControlller::class, 'sale_report'])->name('sale_report');
Route::post('/sale_report_submit', [PosReportControlller::class, 'sale_report_submit'])->name('sale_report_submit');


});