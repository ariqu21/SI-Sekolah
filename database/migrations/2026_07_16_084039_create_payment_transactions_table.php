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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('registrasi_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('order_id')->nullable();

            $table->decimal('total',12,2);

            $table->string('payment_proof')->nullable();

            $table->enum(
                'verification_status',
                [
                    'Belum Upload',
                    'Menunggu',
                    'Terverifikasi',
                    'Ditolak'
                ]
            )->default('Belum Upload');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
