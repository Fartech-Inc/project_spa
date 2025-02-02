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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique()->index();
            $table->foreignId('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('service_id')->index();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->enum('status', ['pending','success','cancel'])->default('pending')->index();
            $table->integer('total_price')->index();
            $table->integer('total_paid')->index();
            $table->enum('payment_type', ['full_payment','down_payment'])->index();
            $table->timestamp('transaction_date')->index();
            $table->time('start_time')->index();
            $table->time('end_time')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
