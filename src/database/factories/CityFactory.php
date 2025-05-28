<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;

    /**
     * Major German cities with their coordinates
     */
    private array $germanCities = [
        ['Berlin', 52.520008, 13.404954],
        ['Hamburg', 53.551086, 9.993682],
        ['Munich', 48.137154, 11.576124],
        ['Cologne', 50.937531, 6.960279],
        ['Frankfurt', 50.110924, 8.682127],
        ['Stuttgart', 48.783333, 9.183333],
        ['Düsseldorf', 51.227741, 6.773456],
        ['Leipzig', 51.339695, 12.373075],
        ['Dortmund', 51.513587, 7.465298],
        ['Essen', 51.455643, 7.011555],
        ['Dresden', 51.050409, 13.737262],
        ['Nuremberg', 49.452102, 11.076665],
        ['Hannover', 52.375892, 9.732010],
        ['Bremen', 53.079296, 8.801694],
        ['Bonn', 50.737430, 7.098207],
    ];

    public function definition(): array
    {
        static $cityIndex = 0;

        // If we've used all predefined cities, switch to generating random ones
        if ($cityIndex >= count($this->germanCities)) {
            return $this->randomCity();
        }

        // Use the next predefined city
        $city = $this->germanCities[$cityIndex++];

        return [
            'name' => $city[0],
            'country_code' => 'DE',
            'latitude' => $city[1],
            'longitude' => $city[2],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function randomCity(): array
    {
        // Generate a random city name with German-style suffixes
        $suffixes = ['stadt', 'dorf', 'burg', 'bach', 'heim', 'hausen', 'furt'];
        $prefix = $this->faker->unique()->city();
        $suffix = $this->faker->randomElement($suffixes);

        return [
            'name' => $prefix . $suffix,
            'country_code' => 'DE',
            'latitude' => $this->faker->latitude(47.27, 55.05),  // German latitude range
            'longitude' => $this->faker->longitude(5.87, 15.04), // German longitude range
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * State for creating small towns
     */
    public function smallTown(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => $this->faker->unique()->city() . 'dorf',
                'latitude' => $this->faker->latitude(47.27, 55.05),
                'longitude' => $this->faker->longitude(5.87, 15.04),
            ];
        });
    }
}
