<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_taxis', function (Blueprint $table) {
            $table->integer('color')->after('price');
            $table->integer('trial_color')->default(0)->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_taxis', function (Blueprint $table) {
            $table->dropColumn(['color', 'trial_color']);
        });
    }
};
