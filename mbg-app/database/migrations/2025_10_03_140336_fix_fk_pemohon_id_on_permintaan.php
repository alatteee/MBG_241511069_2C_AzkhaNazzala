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
        Schema::table('permintaan', function (Blueprint $table) {
            $table->dropForeign(['id']); // kalau sebelumnya ada; jika error, abaikan
            $table->dropForeignIfExists('permintaan_ibfk_1'); // Laravel 10 punya helper? kalau tidak, manual di SQL
        });

        DB::statement('ALTER TABLE `permintaan` DROP FOREIGN KEY `permintaan_ibfk_1`;');

        Schema::table('permintaan', function (Blueprint $table) {
            $table->index('pemohon_id');
            $table->foreign('pemohon_id')->references('id')->on('user')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }
    public function down(): void
    {
        Schema::table('permintaan', function (Blueprint $table) {
            $table->dropForeign(['pemohon_id']);
            $table->dropIndex(['pemohon_id']);
        });
    }
};
