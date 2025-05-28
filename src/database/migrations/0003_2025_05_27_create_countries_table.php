<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migration: Creates the 'countries' table with ISO codes as primary keys.
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            // Primary key: ISO 2-letter code (e.g., 'DE', 'US')
            $table->char('iso_code', 2)->primary();

            // Country names (German + English)
            $table->string('name_de', 100); // German name
            $table->string('name_en', 100)->nullable(); // English name (optional)
            $table->unsignedSmallInteger('sort_order')->nullable()->default(1)->comment('Controls display order in dropdowns or lists');
            $table->boolean('is_enabled')->default(true)->comment('Indicates if the country is selectable/active');

            // Timestamps for created_at/updated_at
            $table->timestamps();

            // Indexes for faster queries auto index names
            $table->index('name_de');
            $table->index('name_en');

            // Custom-named indexes (explicitly defined)
            //$table->index('name_de', 'countries_name_de_index');  // Custom name
            //$table->index('name_en', 'countries_name_en_index'); // Custom name


        });
    }

    /**
     * Reverse the migration: Drops the table if it exists.
     * Important: Drop child tables (cities, clients) FIRST in later migrations.
     */
    public function down()
    {
        Schema::dropIfExists('countries');
        // Only needed for custom-named indexes
        //Schema::table('countries', function (Blueprint $table) {
        //$table->dropIndex('custom_index_name');
        //});
    }
};
