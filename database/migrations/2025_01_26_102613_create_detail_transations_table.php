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
        Schema::create('detail_transations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->index();
            $table->foreign('transaction_id')->references('id')->on('transations')->onDelete('cascade');
            $table->foreignId('product_id')->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('price')->index();
            $table->integer('quantity')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transations');
    }
};
