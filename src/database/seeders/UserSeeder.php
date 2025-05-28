<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $this->command->info('Seeding predefined Users...');
        $this->seedPredefinedUsers();

   /*     $this->command->info('Seeding from factory...');
        $this->seedFromFactory(10);

        $this->command->info('Seeding from CSV...');
        $this->seedFromCsv();*/

        $this->command->info('Users seeded successfully');


    }

    private function seedPredefinedUsers():void
    {
        $users = [
            ['name' => 'Hani-Masoud', 'email' => 'hani.masoud@gmx.de','password' => bcrypt('12345678'), 'email_verified_at' => now() ],
            ['name' => 'admin', 'email' => 'admin@admin.com','password' => bcrypt('12345678'), 'email_verified_at' =>now() ],
            ['name' => 'client', 'email' => 'client@client.com','password' => bcrypt('12345678'), 'email_verified_at' =>now() ],
            ['name' => Str::random(10) , 'email' => Str::random(10).'@example.com','password' => Hash::make('password'), 'email_verified_at' =>now() ],
        ];


        DB::table('users')->insert(
            $users
        );
    }

    protected function seedFromCsv(string $filename = 'users.csv'): void
    {
        $path = database_path("seeders/data/{$filename}");
        if (!File::exists($path)) {
            $this->command->error("CSV file not found: $path");
            return;
        }


        $csv = array_map('str_getcsv', file($path));
        foreach ($csv as $row) {
            [$name, $email] = $row;
            City::updateOrCreate([
                'name' => $name,
                'email' => $email
            ]);
        }
    }

  /*  protected function seedFromFactory(int $count = 50): void
    {

        User::factory()->count($count)->create([
            'country_id' => $country->id,
        ]);
    }*/


}
