<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\API\EmpController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\Inventory\ProductController;
use App\Http\Controllers\API\POS\InvoiceController;


Route::get('/', [HomeController::class, 'index'])->name('login');
Route::get('/registration', [HomeController::class, 'registration'])->name('registration');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home');
//for dynamic module
Route::post('/pos_module_active', [HomeController::class, 'pos_module_active'])->name('posModuleActive');
Route::post('/inventory_module_active', [HomeController::class, 'inventory_module_active'])->name('inventoryModuleActive');
Route::post('/emp_module_active', [HomeController::class, 'emp_module_active'])->name('empModuleActive');


//...............********* employee management module ********................
//employee
Route::get('/add_additional_member_info', [EmpController::class, 'add_additional_member_info'])->name('add_additional_member_info');

//attendance
Route::get('/give_attendance', [AttendanceController::class, 'give_attendance'])->name('give_attendance');
Route::get('/attendance_list',[AttendanceController::class,'attendance_list'])->name('attendance_list');


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