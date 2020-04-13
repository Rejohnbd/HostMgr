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
            $table->unsignedBigInteger('user_id');
            $table->string('customer_first_name', 50)->nullable();
            $table->string('customer_last_name', 50)->nullable();
            $table->string('customer_type', 20);
            $table->string('customer_gender', 10);
            $table->string('company_name', 100)->nullable();
            $table->string('company_website', 100);
            $table->text('company_details');
            $table->text('customer_address');
            $table->date('customer_join_date');
            $table->integer('customer_join_year');
            $table->string('customer_reference', 100)->nullable();
            $table->unsignedBigInteger('created_by');
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
