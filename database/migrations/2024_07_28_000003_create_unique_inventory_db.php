<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// composer dump-autoload
// php artisan optimize:clear
// php artisan clear-compiled



class CreateUniqueInventory extends Migration
{
    /**
     * Run the migrations..
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('inventory')->create('inventory_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->text('description')->nullable();
            $table->string('ip_address', 500)->nullable();
            $table->string('url', 1000)->nullable();
            $table->timestamps();
        });

        Schema::connection('inventory')->create('item_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable();
            $table->string('name', 100)->nullable();
            $table->integer('active_status')->nullable();
            $table->timestamps();
        });

        Schema::connection('inventory')->create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_category_id')->nullable();
            $table->integer('product_category_id')->nullable();
            $table->integer('product_type')->nullable()->comment('1=batch, 2=single item');
            $table->string('product_name', 100)->nullable();
            $table->string('product_single_price', 100)->nullable();
            $table->integer('labeling_type')->nullable()->comment('1=sku, 2=barcode');
            $table->string('batch_number', 100)->nullable();
            $table->string('product_tag_number', 100)->nullable();
            $table->string('product_weight', 100)->nullable();
            $table->integer('quantity')->nullable();
            $table->text('additional_product_details')->nullable();
            $table->date('product_entry_date')->nullable();
            $table->date('product_mfg_date')->nullable();
            $table->date('product_expiry_date')->nullable();
            $table->integer('product_status')->nullable()->comment('1=available, 2=not available, 3=damaged');
            $table->integer('total_product_in_a_batch')->nullable();
            $table->string('product_batch_price', 500)->nullable();
            $table->integer('current_available_product_in_a_batch')->nullable();
            $table->integer('shop_company_id')->nullable();
            $table->integer('shop_branch_id')->nullable();
            $table->integer('shop_depth_id')->nullable();
            $table->integer('shop_outlet_id')->nullable();
            $table->integer('shop_warehouse_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('vendor_company_id')->nullable();
            $table->integer('vendor_branch_id')->nullable();
            $table->timestamps();
        });

        Schema::connection('inventory')->create('product_batch', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->nullable();
            $table->string('batch_number', 500)->nullable();
            $table->string('product_name', 500)->nullable();
            $table->integer('total_number_of_purchased_product_in_a_batch')->nullable();
            $table->timestamps();
        });

        Schema::connection('inventory')->create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable();
            $table->string('name', 500)->nullable();
            $table->integer('item_category_id')->nullable();
            $table->integer('active_status')->nullable();
            $table->timestamps();
        });

        Schema::connection('inventory')->create('product_requisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('requisition_order_id', 100)->nullable();
            $table->string('product_track_id', 100)->nullable();
            $table->string('product_name', 100)->nullable();
            $table->string('product_weight', 100)->nullable();
            $table->string('product_unit_type', 100)->nullable();
            $table->text('product_details')->nullable();
            $table->integer('product_quantity')->nullable();
            $table->string('product_unit_price', 100)->nullable();
            $table->string('product_subtotal', 100)->nullable();
            $table->timestamps();
        });

        Schema::connection('inventory')->create('product_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->nullable();
            $table->string('product_tag_number', 100)->nullable();
            $table->string('batch_number', 100)->nullable();
            $table->integer('quantity')->nullable();
            $table->date('sales_date')->nullable();
            $table->integer('invoice_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('outlet_id')->nullable();
            $table->integer('total_number_of_sold_product_in_a_batch')->nullable();
            $table->timestamps();
        });

        Schema::connection('inventory')->create('product_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status_name', 500)->nullable();
            $table->timestamps();
        });

        Schema::connection('inventory')->create('requisition_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable();
            $table->integer('requisition_type')->nullable()->comment('1=new stock, 2=refill stock');
            $table->string('requisition_order_id', 100)->nullable();
            $table->date('requisition_order_date')->nullable();
            $table->date('requisition_deliver_date')->nullable();
            $table->integer('shop_company_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('requisition_order_by')->nullable();
            $table->integer('requisition_approved_by')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('requisition_status')->nullable()->comment('1 = pending, 2= declined, 3 = delivered');
            $table->string('total_amount', 100)->nullable();
            $table->text('requisition_decline_reason')->nullable();
            $table->timestamps();
        });

        Schema::connection('inventory')->create('warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('warehouse_name', 100)->nullable();
            $table->text('warehouse_address')->nullable();
            $table->integer('warehouse_status')->nullable()->comment('1=open, 2=closed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('inventory')->dropIfExists('inventory_log');
        Schema::connection('inventory')->dropIfExists('item_categories');
        Schema::connection('inventory')->dropIfExists('products');
        Schema::connection('inventory')->dropIfExists('product_batch');
        Schema::connection('inventory')->dropIfExists('product_categories');
        Schema::connection('inventory')->dropIfExists('product_requisitions');
        Schema::connection('inventory')->dropIfExists('product_sales');
        Schema::connection('inventory')->dropIfExists('product_status');
        Schema::connection('inventory')->dropIfExists('requisition_orders');
        Schema::connection('inventory')->dropIfExists('warehouses');
    }
}
