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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_proof')->nullable();

            $table->enum(
                'verification_status',
                [
                    'Belum Upload',
                    'Menunggu Verifikasi',
                    'Terverifikasi',
                    'Ditolak'
                ]
            )->default('Belum Upload');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'payment_proof',
                'verification_status'
            ]);
        });
    }
};
