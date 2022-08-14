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
            $table->foreignId('address_id');
            $table->string('key');
            $table->integer('status_id');
            $table->double('subTotal');
            $table->double('itemDiscount');
            $table->double('tax');
            $table->double('shipping');
            $table->double('total');
            $table->double('promo');
            $table->double('discount');
            $table->double('grandTotal');
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
