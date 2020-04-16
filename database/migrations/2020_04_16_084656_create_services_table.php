<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->comment('FK from table: customers');
            $table->tinyInteger('service_for')->comment('1=domain hosting both, 2=only hosting, 3=only domain');
            $table->string('domain_name', 100);
            $table->unsignedBigInteger('domain_reseller_id')->nullable()->default('0')->comment('FK from table: domain_reseller');
            $table->unsignedBigInteger('hosting_reseller_id')->nullable()->default('0')->comment('FK from table: hosting_reseller');
            $table->string('hosting_type', 20)->nullable()->comment('package/custom');
            $table->integer('hosting_package_id')->nullable()->default('0');
            $table->string('hosting_space', 50)->nullable()->comment('in MB');
            $table->string('hosting_bandwidth', 50)->nullable()->comment('in MB');
            $table->string('hosting_db_qty', 50)->nullable();
            $table->string('hosting_emails_qty', 50)->nullable();
            $table->string('hosting_subdomain_qty', 50)->nullable();
            $table->string('hosting_ftp_qty', 50)->nullable();
            $table->string('hosting_park_domain_qty', 50)->nullable();
            $table->string('hosting_addon_domain_qty', 50)->nullable();
            $table->date('service_start_date');
            $table->date('service_expire_date');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->default('0');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
