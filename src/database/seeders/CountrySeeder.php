<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use App\Services\LocationImportService;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $this->command->info('Seeding predefined Countries...');
        // $this->seedPredefinedCountries();

        // $this->command->info('Seeding from factory...');
        // $this->seedFromFactory(10);

        $this->command->info('Seeding from CSV...');
        $this->seedFromCsv();

        $this->command->info('Countries seeded successfully');
    }

    private function seedPredefinedCountries(): void
    {
        $countries = [
            ['iso_code' => 'DE', 'name_de' => 'Deutschland', 'name_en' => 'Germany', 'created_at' => now(), 'updated_at' => now()],
            ['iso_code' => 'US', 'name_en' => 'United States', 'name_de' => 'Vereinigte Staaten', 'created_at' => now(), 'updated_at' => now()],
            ['iso_code' => 'AT', 'name_de' => 'Österreich', 'name_en' => 'Austria', 'created_at' => now(), 'updated_at' => now()],
            ['iso_code' => 'CH', 'name_de' => 'Schweiz', 'name_en' => 'Switzerland', 'created_at' => now(), 'updated_at' => now()],
            ['iso_code' => 'FR', 'name_de' => 'Frankreich', 'name_en' => 'France', 'created_at' => now(), 'updated_at' => now()]
        ];

        foreach ($countries as $data) {
            Country::updateOrCreate(['iso_code' => $data['iso_code']], $data);
        }
        $this->command->info('Predefined countries seeded successfully');
    }

    protected function seedFromCsv(string $filename = 'countries_en_de.csv'): void
    {
        $importer = app(LocationImportService::class);
        $importer->importCountriesFromCsv('countries_en_de.csv');
    }

    protected function seedFromFactory(int $count = 10): void
    {
        Country::factory()->count($count)->create();
    }

}
