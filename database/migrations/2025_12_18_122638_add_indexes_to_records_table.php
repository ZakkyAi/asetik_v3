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
        Schema::table('records', function (Blueprint $table) {
            // Add indexes on foreign keys for faster joins
            $table->index('id_users', 'idx_records_id_users');
            $table->index('id_products', 'idx_records_id_products');
            
            // Add index on status for faster filtering
            $table->index('status', 'idx_records_status');
            
            // Add index on record_time for faster sorting
            $table->index('record_time', 'idx_records_record_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('records', function (Blueprint $table) {
            // Drop indexes in reverse order
            $table->dropIndex('idx_records_record_time');
            $table->dropIndex('idx_records_status');
            $table->dropIndex('idx_records_id_products');
            $table->dropIndex('idx_records_id_users');
        });
    }
};
