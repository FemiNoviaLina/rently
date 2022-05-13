<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('vehicle_id')->references('id')->on('vehicles');
            $table->string('phone_1');
            $table->string('phone_2');
            $table->string('address_id');
            $table->string('address_mlg');
            $table->time('pickup_time');
            $table->date('pickup_date');
            $table->string('pickup_address');
            $table->time('dropoff_time');
            $table->date('dropoff_date');
            $table->string('dropoff_address');
            $table->string('id_card');
            $table->string('id_card_2');
            $table->string('driver_license');
            $table->float('total_price', 10, 2);
            $table->string('note');
            $table->enum('order_status', ['PENDING', 'REJECTED', 'WAITING_FOR_PAYMENT', 'PAYMENT_DONE', 'CANCELED', 'COMPLETED']);
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('virtual_account')->nullable();
            $table->string('qr_link')->nullable();
            $table->string('deep_link')->nullable();
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
};
