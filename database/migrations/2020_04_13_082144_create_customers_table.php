<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('FK from table: users');
            $table->string('customer_first_name', 50)->nullable();
            $table->string('customer_last_name', 50)->nullable();
            $table->string('customer_type', 20)->comment('company/individual');
            $table->string('customer_gender', 10)->nullable()->comment('Male/Female');
            $table->string('company_name', 100)->nullable();
            $table->string('company_website', 100)->nullable();
            $table->text('company_details')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_mobile', 50)->nullable();
            $table->date('customer_join_date')->nullable();
            $table->integer('customer_join_year')->nullable();
            $table->string('customer_reference', 100)->nullable();
            $table->unsignedBigInteger('created_by')->comment('FK from table: users');
            $table->unsignedBigInteger('updated_by')->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('created_by')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
