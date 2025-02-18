<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->unsignedBigInteger('user_id');
            $table->integer('subtotal');
            $table->integer('tax');
            $table->integer('grand_total');
            $table->enum('status', ['pending', 'settlement', 'cooked'])->comment('Order status');
            $table->integer('table_number');
            $table->enum('payment_method', ['tunai', 'qris'])->comment('Payment method');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
