<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void /* se empieza a ejecutar una migración */
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->after('name');
            $table->string('username')->unique()->after('lastname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void /* si arriba se crea una tabla, aquí se destruye */
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('lastname');
            $table->dropColumn('username');
        });
    }
};
