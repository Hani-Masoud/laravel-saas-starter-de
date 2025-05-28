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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('latitude', 10, 7)->nullable();  // e.g., 52.520008
            $table->decimal('longitude', 11, 7)->nullable(); // e.g., 13.404954
            // Explicit foreign key definition
            $table->char('country_code', 2); // Country reference (custom ISO code)
            $table->foreign('country_code')->references('iso_code')->on('countries')->onUpdate('cascade'); // Critical for ISO code changes

            $table->unsignedSmallInteger('sort_order')->nullable()->default(1)->comment('Controls display order in dropdowns or lists');
            $table->boolean('is_enabled')->default(true)->comment('Indicates if the country is selectable/active');

            $table->timestamps();

            // Index for faster searches
            $table->index('name');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
