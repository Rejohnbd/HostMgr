<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('expense_id')->nullable()->comment('FK from table: users');
            $table->unsignedBigInteger('payment_id')->nullable()->comment('FK from table: payment');
            $table->unsignedBigInteger('domain_reseller_renew_logs_id')->nullable()->comment('FK from table: domain_reseller_renew_logs');
            $table->unsignedBigInteger('hosting_reseller_renew_logs_id')->nullable()->comment('FK from table: hosting_reseller_renew_logs');
            $table->decimal('expenses', 10, 2)->nullable();
            $table->decimal('income', 10, 2)->nullable();
            $table->decimal('previous_balance', 10, 2);
            $table->decimal('present_balance', 10, 2);
            $table->string('description');
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
        Schema::dropIfExists('transactions');
    }
}
