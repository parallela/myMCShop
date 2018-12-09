<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('price');
            $table->unsignedInteger('recommended');
            $table->string('image');
            $table->unsignedInteger('required_product_id')->default(0)->nullable();
            $table->boolean('max_buys')->default(0);
            $table->boolean('paypal_only')->default(0);
            $table->integer('discount')->nullable();
            $table->integer('sms_id');
            $table->integer('site_id');
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
}
