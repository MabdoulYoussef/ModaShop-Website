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
        Schema::table('products', function (Blueprint $table) {
            // Index for stock filtering
            $table->index('stock');

            // Index for category filtering
            $table->index('category_id');

            // Index for price filtering
            $table->index('price');

            // Index for search functionality
            $table->index('name');

            // Composite index for featured products query
            $table->index(['stock', 'created_at']);
        });

        Schema::table('orders', function (Blueprint $table) {
            // Index for status filtering
            $table->index('status');

            // Index for date filtering
            $table->index('created_at');

            // Index for customer filtering
            $table->index('customer_id');

            // Composite index for admin dashboard queries
            $table->index(['status', 'created_at']);
        });

        Schema::table('categories', function (Blueprint $table) {
            // Index for category listing
            $table->index('name');
        });

        Schema::table('customers', function (Blueprint $table) {
            // Index for customer search
            $table->index('phone');
            $table->index('firstname');
            $table->index('lastname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['stock']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['price']);
            $table->dropIndex(['name']);
            $table->dropIndex(['stock', 'created_at']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['customer_id']);
            $table->dropIndex(['status', 'created_at']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropIndex(['phone']);
            $table->dropIndex(['firstname']);
            $table->dropIndex(['lastname']);
        });
    }
};
