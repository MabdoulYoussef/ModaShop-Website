<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;

class PerformanceMonitor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'performance:monitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor and optimize ModaShop performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 ModaShop Performance Monitor');
        $this->line('');

        // Check cache status
        $this->checkCacheStatus();

        // Check database performance
        $this->checkDatabasePerformance();

        // Clear old cache
        $this->clearOldCache();

        // Optimize database
        $this->optimizeDatabase();

        $this->info('✅ Performance monitoring completed!');
    }

    private function checkCacheStatus()
    {
        $this->info('📊 Cache Status:');

        $cacheKeys = [
            'homepage_featured_products',
            'homepage_categories',
            'homepage_latest_products',
            'admin_dashboard_stats',
            'admin_recent_orders',
            'admin_low_stock_products'
        ];

        foreach ($cacheKeys as $key) {
            $exists = Cache::has($key);
            $status = $exists ? '✅ Cached' : '❌ Not Cached';
            $this->line("  {$key}: {$status}");
        }

        $this->line('');
    }

    private function checkDatabasePerformance()
    {
        $this->info('🗄️ Database Performance:');

        // Check table sizes
        $tables = ['products', 'orders', 'customers', 'categories'];

        foreach ($tables as $table) {
            $count = DB::table($table)->count();
            $this->line("  {$table}: {$count} records");
        }

        $this->line('');
    }

    private function clearOldCache()
    {
        $this->info('🧹 Clearing old cache...');

        // Clear cache older than 24 hours
        $oldKeys = [
            'old_featured_products',
            'old_categories',
            'old_latest_products'
        ];

        foreach ($oldKeys as $key) {
            Cache::forget($key);
        }

        $this->line('✅ Old cache cleared');
        $this->line('');
    }

    private function optimizeDatabase()
    {
        $this->info('⚡ Optimizing database...');

        // Run database optimization
        try {
            DB::statement('VACUUM;');
            $this->line('✅ Database optimized');
        } catch (\Exception $e) {
            $this->line('⚠️ Database optimization skipped (SQLite limitation)');
        }

        $this->line('');
    }
}
