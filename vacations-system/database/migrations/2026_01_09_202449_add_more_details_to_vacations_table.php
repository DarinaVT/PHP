<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vacations', function (Blueprint $table) {
            $table->text('detailed_description')->nullable();
            $table->text('included_services')->nullable();
            $table->text('not_included_services')->nullable();
            $table->text('program')->nullable();
            $table->string('departure_location')->nullable();
            $table->time('departure_time')->nullable();
            $table->string('return_location')->nullable();
            $table->time('return_time')->nullable();
        });
    }
    public function down(): void
    {
        Schema::table('vacations', function (Blueprint $table) {
            $table->dropColumn([
                'detailed_description',
                'included_services',
                'not_included_services',
                'program',
                'departure_location',
                'departure_time',
                'return_location',
                'return_time',
            ]);
        });
    }
};