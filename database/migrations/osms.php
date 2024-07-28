<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOsmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create failed_jobs table
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        // Create migrations table
        Schema::create('migrations', function (Blueprint $table) {
            $table->id();
            $table->string('migration');
            $table->integer('batch');
        });

        // Insert data into migrations table
        DB::table('migrations')->insert([
            ['id' => 1, 'migration' => '2014_10_12_000000_create_users_table', 'batch' => 1],
            ['id' => 2, 'migration' => '2014_10_12_100000_create_password_reset_tokens_table', 'batch' => 1],
            ['id' => 3, 'migration' => '2019_08_19_000000_create_failed_jobs_table', 'batch' => 1],
            ['id' => 4, 'migration' => '2019_12_14_000001_create_personal_access_tokens_table', 'batch' => 1],
        ]);

        // Create password_reset_tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Create personal_access_tokens table
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('tokenable_type');
            $table->unsignedBigInteger('tokenable_id');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['tokenable_type', 'tokenable_id']);
        });

        // Insert data into personal_access_tokens table
        DB::table('personal_access_tokens')->insert([
            ['id' => 1, 'tokenable_type' => 'App\\Models\\User', 'tokenable_id' => 1, 'name' => 'myToken', 'token' => '3ad100a8bf42f44c988e4be5fc38aabf0d1d4e0c2bc8f88a8a1a08fbde23ba2f', 'abilities' => '["*"]', 'created_at' => '2024-05-01 04:09:44', 'updated_at' => '2024-05-01 04:09:44'],
            // Add other entries similarly...
        ]);

        // Create users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        // Insert data into users table
        DB::table('users')->insert([
            ['id' => 3, 'name' => 'samer', 'email' => 'sam@gmail.com', 'password' => '$2y$10$Q/7NYoa9ThlmRx6SUNn6zOYSAXp4KAHfJFelXPUdIBURB2GnKpuRC', 'created_at' => '2024-05-01 04:23:22', 'updated_at' => '2024-05-01 04:23:22'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('migrations');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('users');
    }
}
