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
        Schema::create('records', function (Blueprint $table) {
            $table->id('id_records');
            $table->foreignId('id_users')->nullable()->constrained('users', 'id');
            $table->foreignId('id_products')->nullable()->constrained('products', 'id');
            $table->enum('status', ['good', 'broken', 'not taken', 'pending', 'fixing', 'decline'])->default('good');
            $table->string('no_serial', 255);
            $table->string('no_inventaris', 255);
            $table->text('note_record');
            $table->timestamp('record_time')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
