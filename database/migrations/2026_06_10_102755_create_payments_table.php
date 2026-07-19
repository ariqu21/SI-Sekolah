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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrasi_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('payment_type_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->date('tanggal_bayar')->nullable();
            $table->decimal('nominal',12,2);
            $table->enum(
                'status',
                ['Belum Bayar','Lunas']
            )->default('Belum Bayar');
            $table->string('metode')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('order_id')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
