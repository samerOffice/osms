<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniqueEmployeeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('user_id')->nullable();
            $table->string('father_name', 100)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('mobile_number', 100)->nullable();
            $table->string('nid_number', 100)->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('blood_group', 10)->nullable();
            $table->string('nationality', 100)->nullable();
            $table->string('marital_status', 10)->nullable();
            $table->string('religion', 10)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('profile_pic', 100)->nullable();
            $table->string('emergency_contact_name', 100)->nullable();
            $table->string('emergency_contact_number', 100)->nullable();
            $table->string('emergency_contact_relation', 10)->nullable();
            $table->integer('flag')->nullable();
            $table->timestamps();
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('user_id');
            $table->date('attendance_date')->nullable();
            $table->time('entry_time')->nullable();
            $table->time('exit_time')->nullable();
            $table->timestamps();
        });

        Schema::create('attendance_users', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('user_id');
            $table->integer('role_id');
            $table->string('password', 500)->nullable();
            $table->string('card_no', 500)->nullable();
            $table->timestamps();
        });

        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('company_id')->nullable();
            $table->string('br_name', 500)->nullable();
            $table->text('br_address')->nullable();
            $table->integer('br_type')->nullable()->comment('1=Head Office, 2= Single branch');
            $table->integer('br_status')->nullable()->comment('1= active, 2= inactive');
            $table->timestamps();
        });

        Schema::create('business_types', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->string('business_type', 50)->nullable();
            $table->integer('business_status')->nullable()->comment('1=active, 2=inactive');
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->string('company_name', 100)->nullable();
            $table->string('company_email', 100)->nullable();
            $table->string('contact_no', 100)->nullable();
            $table->string('license_no', 100)->nullable();
            $table->text('company_address')->nullable();
            $table->string('registration_no', 100)->nullable();
            $table->string('division', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('current_modules', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('module_status')->default(1)->comment('1 = general dashboard, 2= employee, 3= inventory, 4= pos');
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('company_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('outlet_id')->nullable();
            $table->string('dept_name', 500)->nullable();
            $table->timestamps();
        });

        Schema::create('designations', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('level')->nullable()->comment('1 = managing level, 2 = operational level, 3 = support level');
            $table->string('designation_name', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('division_id');
            $table->string('name', 25);
            $table->string('bn_name', 25);
            $table->string('lat', 15)->nullable();
            $table->string('lon', 15)->nullable();
            $table->string('url', 50);
        });

        Schema::create('divisions', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->string('name', 25);
            $table->string('bn_name', 25);
            $table->string('url', 50);
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('user_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('father_name', 100)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('mobile_number', 100)->nullable();
            $table->string('nid_number', 100)->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('blood_group', 10)->nullable();
            $table->string('nationality', 100)->nullable();
            $table->string('marital_status', 10)->nullable();
            $table->string('religion', 10)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('profile_pic', 100)->nullable();
            $table->string('emergency_contact_name', 100)->nullable();
            $table->string('emergency_contact_number', 100)->nullable();
            $table->string('emergency_contact_relation', 10)->nullable();
            $table->integer('flag')->nullable();
            $table->timestamps();
        });

        Schema::create('employee_performances', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('emp_id')->nullable();
            $table->string('total_working_hours', 100)->nullable();
            $table->string('total_overtime_hours', 100)->nullable();
            $table->string('performance_bonus', 100)->nullable();
            $table->string('total_attendance', 100)->nullable();
            $table->integer('smartness_point')->nullable();
            $table->timestamps();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id'); // Big auto-increment primary key
            $table->string('uuid', 255);
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('leave_applications', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('emp_id')->nullable();
            $table->integer('leave_type_id')->nullable();
            $table->date('leave_start_date')->nullable();
            $table->date('leave_end_date')->nullable();
            $table->text('leave_reason')->nullable();
            $table->timestamps();
        });

        Schema::create('leave_types', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->string('leave_type', 100)->nullable();
            $table->integer('total_days')->nullable();
            $table->timestamps();
        });

        Schema::create('menu_has_permissions', function (Blueprint $table) {
            $table->integer('permission_id'); // Not a primary key
            $table->integer('menu_id');
            $table->primary(['permission_id', 'menu_id']);
        });

        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->integer('permission_id'); // Not a primary key
            $table->integer('model_id');
            $table->string('model_type');
            $table->primary(['permission_id', 'model_id', 'model_type']);
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->integer('role_id'); // Not a primary key
            $table->integer('model_id');
            $table->string('model_type');
            $table->primary(['role_id', 'model_id', 'model_type']);
        });

        Schema::create('oauth_access_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary(); // String primary key
            $table->integer('user_id')->nullable()->index();
            $table->integer('client_id');
            $table->string('name', 255)->nullable();
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->timestamps();
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_auth_codes', function (Blueprint $table) {
            $table->string('id', 100)->primary(); // String primary key
            $table->integer('user_id');
            $table->integer('client_id');
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->timestamps();
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_clients', function (Blueprint $table) {
            $table->bigIncrements('id'); // Big auto-increment primary key
            $table->string('user_id', 100)->nullable()->index();
            $table->string('name', 255);
            $table->string('secret', 100)->nullable();
            $table->text('redirect');
            $table->boolean('personal_access_client');
            $table->boolean('password_client');
            $table->boolean('revoked');
            $table->timestamps();
        });

        Schema::create('oauth_personal_access_clients', function (Blueprint $table) {
            $table->bigIncrements('id'); // Big auto-increment primary key
            $table->integer('client_id');
            $table->timestamps();
        });

        Schema::create('oauth_refresh_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary(); // String primary key
            $table->integer('access_token_id')->index();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('outlets', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('company_id')->nullable();
            $table->string('outlet_name', 500)->nullable();
            $table->text('outlet_address')->nullable();
            $table->integer('outlet_type')->nullable()->comment('1=Head Office, 2= Single outlet');
            $table->integer('outlet_status')->nullable()->comment('1= active, 2= inactive');
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email', 100)->index();
            $table->string('token', 100);
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->string('name', 191);
            $table->string('guard_name', 191);
            $table->timestamps();
        });


        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->integer('permission_id'); // Not a primary key
            $table->integer('role_id');
            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->string('name', 191);
            $table->string('guard_name', 191);
            $table->timestamps();
        });

        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('user_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('salary', 100)->nullable();
            $table->date('effective_date')->nullable();
            $table->integer('emp_id')->nullable();
            $table->timestamps();
        });

        Schema::create('salaries_history', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('emp_id')->nullable();
            $table->string('salary', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('role_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('warehouses', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key
            $table->integer('company_id')->nullable();
            $table->string('warehouse_name', 500)->nullable();
            $table->text('warehouse_address')->nullable();
            $table->integer('warehouse_type')->nullable()->comment('1=Head Office, 2= Single warehouse');
            $table->integer('warehouse_status')->nullable()->comment('1= active, 2= inactive');
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
        Schema::dropIfExists('admins');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('attendance_users');
        Schema::dropIfExists('branches');
        Schema::dropIfExists('business_types');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('current_modules');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('designations');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('divisions');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('employee_performances');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('leave_applications');
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('menu_has_permissions');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('oauth_access_tokens');
        Schema::dropIfExists('oauth_auth_codes');
        Schema::dropIfExists('oauth_clients');
        Schema::dropIfExists('oauth_personal_access_clients');
        Schema::dropIfExists('oauth_refresh_tokens');
        Schema::dropIfExists('outlets');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('salaries');
        Schema::dropIfExists('salaries_history');
        Schema::dropIfExists('users');
        Schema::dropIfExists('warehouses');
    }
}
