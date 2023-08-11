<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('line_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('sales_invoices');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('product_quantity');
            $table->double('product_price',15,2);
            $table->double('product_total_price',15.2);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sales_invoices');

        Schema::dropIfExists('line_items');
    }
};
