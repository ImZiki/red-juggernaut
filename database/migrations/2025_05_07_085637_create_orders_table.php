<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con 'users'
            $table->decimal('total', 10, 2); // Total de la compra
            $table->string('status'); // Estado de la compra (pendiente, completada, etc.)
            $table->text('shipping_address'); // Dirección de envío
            $table->text('billing_address'); // Dirección de facturación
            $table->string('payment_method'); // Método de pago
            $table->text('notes')->nullable(); // Notas adicionales
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
