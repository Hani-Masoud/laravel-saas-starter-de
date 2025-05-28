<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Services\LocationImportService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $this->command->info('Seeding predefined Cities...');
        // $this->seedPredefinedCities();

        // $this->command->info('Seeding from factory...');
        // $this->seedFromFactory(10);

        $this->command->info('Seeding from CSV...');
        $this->seedFromCsv();

        $this->command->info('Cities seeded successfully');

    }

    private function seedPredefinedCities(): void
    {
        $germany = Country::where('iso_code', 'DE')->first();
        if (!$germany) {
            $this->command->warn('Germany (DE) not found. Run CountrySeeder first.');
            return;
        }

        $cities = [
            ['name' => 'Berlin', 'country_code' => 'DE', 'latitude' => 52.520008, 'longitude' => 13.404954],
            ['name' => 'Hamburg', 'country_code' => 'DE', 'latitude' => 53.551086, 'longitude' => 9.993682],
            ['name' => 'München', 'country_code' => 'DE', 'latitude' => 48.135125, 'longitude' => 11.581981],
            ['name' => 'Köln', 'country_code' => 'DE', 'latitude' => 50.937531, 'longitude' => 6.960279],
            ['name' => 'Frankfurt', 'country_code' => 'DE', 'latitude' => 50.110924, 'longitude' => 8.682127],
            ['name' => 'Wolfsburg', 'country_code' => 'DE', 'latitude' => null, 'longitude' => null],
        ];

        DB::table('cities')->insert(
            $cities
        );
    }

    protected function seedFromCsv(string $filename = 'de_main_cities.csv'): void
    {
        $importer = app(LocationImportService::class);
        $importer->importCitiesFromCsv('de_main_cities.csv');
    }

    protected function seedFromFactory(int $count = 50): void
    {
        $country = Country::inRandomOrder()->first();
        if (!$country) {
            $this->command->warn('No countries found. Run CountrySeeder first.');
            return;
        }

        City::factory()->count($count)->create([
            'country_code' => $country->iso_code,
        ]);
    }


}
