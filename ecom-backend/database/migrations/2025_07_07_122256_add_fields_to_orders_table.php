<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('pending');
            $table->text('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_zip');
            $table->string('shipping_country');
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->text('notes')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id', 'total_price', 'status', 'shipping_address',
                'shipping_city', 'shipping_state', 'shipping_zip', 'shipping_country',
                'payment_method', 'payment_status', 'notes'
            ]);
        });
    }
};
