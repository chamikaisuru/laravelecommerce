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
        Schema::table('products', function (Blueprint $table) {
            $table->string('fabric')->after('keywords');
            $table->string('Pattern')->after('fabric');
            $table->string('sleeve_length')->after('Pattern');
            $table->string('style')->after('sleeve_length');
            $table->string('fit')->after('style');
            $table->string('occasion')->after('fit');
            $table->string('neckline')->after('occasion');
            $table->string('closure')->after('neckline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('fabric');
            $table->dropColumn('Pattern');
            $table->dropColumn('sleeve_length');
            $table->dropColumn('style');
            $table->dropColumn('fit');
            $table->dropColumn('occasion');
            $table->dropColumn('neckline');
            $table->dropColumn('closure');
        });
    }
};
