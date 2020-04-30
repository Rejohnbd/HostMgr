<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostingResellerRenewLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosting_reseller_renew_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hosting_reseller_id')->comment('FK from table: hosting_reseller');
            $table->date('hosting_reseller_renew_date');
            $table->integer('hosting_reseller_renew_for');
            $table->decimal('hosting_reseller_renew_amount', 10, 2);
            $table->timestamps();

            $table->foreign('hosting_reseller_id')
                ->references('id')
                ->on('hosting_resellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosting_reseller_renew_logs');
    }
}
