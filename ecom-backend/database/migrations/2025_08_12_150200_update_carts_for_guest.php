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
        Schema::table('carts', function (Blueprint $table) {
            // Add session_token for guest carts
            if (!Schema::hasColumn('carts', 'session_token')) {
                $table->string('session_token')->nullable()->index()->after('id');
            }

            // Add customer_id for authenticated customers
            if (!Schema::hasColumn('carts', 'customer_id')) {
                $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete()->after('session_token');
            }

            // Remove user_id if it exists
            if (Schema::hasColumn('carts', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // This is a destructive migration, so we can't easily reverse it
            // You would need to restore the original structure manually
        });
    }
};
