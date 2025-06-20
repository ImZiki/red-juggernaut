<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('concert_requests', function (Blueprint $table) {
            $table->timestamp('accepted_at')->nullable()->after('message');
            $table->timestamp('rejected_at')->nullable()->after('accepted_at');
        });
    }

    public function down(): void
    {
        Schema::table('concert_requests', function (Blueprint $table) {
            $table->dropColumn(['accepted_at', 'rejected_at']);
        });
    }
};
