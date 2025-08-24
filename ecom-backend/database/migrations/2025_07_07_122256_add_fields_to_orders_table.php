<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('pending');
            $table->text('shipping_address');
            $table->string('shipping_city');
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'total_price', 'status', 'shipping_address',
                'shipping_city', 'payment_method', 'payment_status'
            ]);
        });
    }
};
