<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->required()->index();
            $table->string('topic')->required();
            $table->string('type')->required();
            $table->timestamp('deadline')->required();
            $table->string('paper_type')->required();
            $table->string('status')->nullable();
            $table->bigInteger('quantity')->required();
            $table->string('spacing')->required();
            $table->bigInteger('pages')->nullable();
            $table->bigInteger('words')->nullable();
            $table->string('academic_level')->nullable();
            $table->text('instructions')->nullable();
            $table->string('formating_style')->nullable();
            $table->bigInteger('number_of_sources')->nullable();
            $table->string('sample_file')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
