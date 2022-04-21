<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PerformanceSeeder::class);
        $this->call(SponsorshipSeeder::class);
        $this->call(TitleSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(ReviewSeeder::class); 
    }
}
