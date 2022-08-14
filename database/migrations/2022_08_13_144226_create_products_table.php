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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('Summary');
            $table->integer('sku');
            $table->double('price');
            $table->double('discount')->default(0);
            $table->integer('quantity');
            $table->enum('shop', [1, 0]);
            $table->text('content');
            // $table->timestamp('publishedAt');
            $table->timestamp('startAt');
            $table->timestamp('endAt');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
};
