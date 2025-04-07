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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->nullable();
            $table->string('reference');
            $table->string('concept');
            $table->float('movedMoney');
            $table->float('saldo');
            $table->string('cuentaType')
            ->nullable();
            $table->string('cuenta_transferida')
            ->nullable();
            $table->foreignId('user_id_transferido')
            ->nullable();
            $table->string('cuenta_recibida')
            ->nullable();
            $table->foreignId('user_id_recibido')
            ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};

