<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->foreignId('registrasi_id')
                ->nullable()
                ->constrained('registrasis')
                ->nullOnDelete();

            $table->string('phone');

            $table->enum('role',[
                'admin',
                'wali'
            ])->default('wali');

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['registrasi_id']);

            $table->dropColumn([
                'registrasi_id',
                'phone',
                'role'
            ]);

        });
    }
};