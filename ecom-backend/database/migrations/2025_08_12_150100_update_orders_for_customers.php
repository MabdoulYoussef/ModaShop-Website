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
        Schema::table('orders', function (Blueprint $table) {
            // Add customer_id if it doesn't exist
            if (!Schema::hasColumn('orders', 'customer_id')) {
                $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete()->after('id');
            }

            // Remove user_id if it exists
            if (Schema::hasColumn('orders', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            // Remove unnecessary fields for Morocco
            foreach (['shipping_postal_code', 'shipping_country', 'shipping_state', 'notes'] as $col) {
                if (Schema::hasColumn('orders', $col)) {
                    $table->dropColumn($col);
                }
            }

            // Remove customer info fields (we'll use customer_id relationship)
            foreach (['customer_firstname', 'customer_lastname', 'customer_phone', 'customer_city'] as $col) {
                if (Schema::hasColumn('orders', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // This is a destructive migration, so we can't easily reverse it
            // You would need to restore the original structure manually
        });
    }
};
