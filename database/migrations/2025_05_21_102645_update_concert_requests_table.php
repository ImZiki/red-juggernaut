<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('concert_requests', function (Blueprint $table) {
            $table->string('status')
                ->default('pendiente')
                ->after('message'); // Puedes moverlo según te convenga

            $table->foreignId('processed_by')
                ->nullable()
                ->after('status')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('concert_requests', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropForeign(['processed_by']);
            $table->dropColumn('processed_by');
        });
    }
};
