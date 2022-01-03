<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('image');
            $table->date('expireDate');
            $table->string('category');
            $table->string('phoneNumber');
            $table->integer('quantity')->default(1);
            $table->double('price');
            $table->integer('minNoDaysFirstOffer');
            $table->integer('minNoDaysSecondOffer');
            $table->integer('minNoDaysThirdOffer');
            $table->double('firstOfferPrice');
            $table->double('secondOfferPrice');
            $table->double('thirdOfferPrice');
            $table->double('priceAfterDiscount')->default(1);
            $table->integer('views')->default(0); 
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
