<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\API\Emp\EmpController;
use App\Http\Controllers\API\Emp\AttendanceController;
use App\Http\Controllers\API\Emp\BranchController;
use App\Http\Controllers\API\Inventory\ProductController;
use App\Http\Controllers\API\POS\InvoiceController;


Route::get('/', [HomeController::class, 'index'])->name('login');
Route::get('/registration', [HomeController::class, 'registration'])->name('registration');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home');

//.............**************** for dynamic module **************....................
Route::post('/pos_module_active', [HomeController::class, 'pos_module_active'])->name('posModuleActive');
Route::post('/inventory_module_active', [HomeController::class, 'inventory_module_active'])->name('inventoryModuleActive');
Route::post('/emp_module_active', [HomeController::class, 'emp_module_active'])->name('empModuleActive');


//...............********* employee management module ********................
//new employee add
Route::get('/add_new_employee', [EmpController::class, 'add_new_employee'])->name('add_new_employee');
//employee personal information update
Route::get('/add_additional_member_info', [EmpController::class, 'add_additional_member_info'])->name('add_additional_member_info');


//attendance
Route::get('/give_attendance', [AttendanceController::class, 'give_attendance'])->name('give_attendance');
Route::get('/attendance_list',[AttendanceController::class,'attendance_list'])->name('attendance_list');

//branch
Route::get('/branch_list', [BranchController::class, 'branch_list'])->name('branch_list');
Route::get('/add_branch', [BranchController::class, 'add_branch'])->name('add_branch');
Route::get('/edit_branch/{branch_id}', [BranchController::class, 'edit_branch'])->name('edit_branch');
// Route::post('/update_branch', [BranchController::class, 'update_branch'])->name('update_branch');

//...............********* inventory management module ********................

//item category
Route::get('/add_item_category', [ProductController::class, 'add_item_category'])->name('add_item_category');
//product category
Route::get('/add_product_category', [ProductController::class, 'add_product_category'])->name('add_product_category');
//product
Route::get('/add_product', [ProductController::class, 'add_product'])->name('add_product');


//...............********* pos module ********................

//invoice
Route::get('/add_invoice', [InvoiceController::class, 'add_invoice'])->name('add_invoice');