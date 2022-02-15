<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->string('account_id')->primary();
            $table->integer('role_id');
            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->integer('gender_id');
            $table->foreign('gender_id')->references('gender_id')->on('genders');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('display_picture_link');
            $table->integer('delete_flag')->nullable();
            $table->date('modified_at')->nullable();
            $table->string('modified_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('accounts');
    }
}
