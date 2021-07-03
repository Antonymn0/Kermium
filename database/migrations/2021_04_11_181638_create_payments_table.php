<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->required()->index();
            $table->string('method')->required()->index();
            $table->string('status')->required();
            $table->string('currency')->required();
            $table->double('shipping_cost')->nullable();
            $table->double('total_due')->required();
            $table->double('total_payable')->required();
            $table->double('discount_rate')->nullable();
            $table->double('discount_amount')->nullable();
            $table->timestamp('payment_due_date')->required();
            $table->double('interest_rate')->required();
            $table->string('account_ref')->nullable();
            $table->string('tansaction_desc')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('merchant_request_id')->nullable();
            $table->string('checkout_request_id')->nullable();
            $table->string('response_code')->nullable();
            $table->string('response_message')->nullable();
            $table->string('coupon_code')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('suspended_at')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
