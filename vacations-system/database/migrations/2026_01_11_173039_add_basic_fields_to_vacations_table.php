<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('vacations', function (Blueprint $table) {
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration');
            $table->foreignId('transport_type_id')->constrained('transport_types')->onDelete('cascade');
            $table->foreignId('organizer_id')->constrained('organizers')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
        });
    }


    public function down(): void
    {
        Schema::table('vacations', function (Blueprint $table) {
            $table->dropForeign(['transport_type_id']);
            $table->dropForeign(['organizer_id']);
            $table->dropColumn(['start_date', 'end_date', 'duration', 'transport_type_id', 'organizer_id', 'price', 'description', 'image']);
        });
    }
};
