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
            $table->bigIncrements('id');
            $table->string('order_no');
            $table->integer('user_id');
            $table->decimal('total_amount', 10,2);
            $table->decimal('delivery_fee', 10,2);
            $table->string('payment_method')->default('Cash on Delivery');
            $table->integer('order_status_id')->default(1);
            $table->text('remarks')->nullable();
            $table->text('unit_block_street')->nullable();
            $table->string('zipcode')->nullable();
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
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
