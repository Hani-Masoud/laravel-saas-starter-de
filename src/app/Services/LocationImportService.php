<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\City;

class LocationImportService
{
    public function importCountriesFromCsv(string $filename): void
    {
        $file = Storage::disk('pre_data')->get($filename);
        $rows = array_map('str_getcsv', explode(PHP_EOL, $file));
        array_shift($rows); // skip header

        foreach ($rows as $row) {
            if (count($row) < 3) continue;
            if (!isset($row[0]) || trim($row[0]) === '') continue;

            Country::updateOrCreate([
                'iso_code' => $row[0],
            ], [
                'name_en' => $row[1],
                'name_de' => $row[2],
            ]);
        }
    }

    public function importCitiesFromCsv(string $filename): void
    {
        $file = Storage::disk('pre_data')->get($filename);
        $rows = array_map('str_getcsv', explode(PHP_EOL, $file));
        array_shift($rows); // skip header

        foreach ($rows as $row) {
            if (count($row) < 4) continue;

            $country = Country::where('iso_code', $row[1])->first();
            if (! $country) continue;

            if (!isset($row[0]) || trim($row[0]) === '') continue;

            City::updateOrCreate([
                'name' => $row[0],
                'country_code' => $country->iso_code,
            ], [
                'latitude' => $row[2],
                'longitude' => $row[3],
            ]);
        }
    }

}
