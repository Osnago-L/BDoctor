<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as FakerITA;


use App\User;
use App\Title;
use App\Sponsorship;
use App\Performance;



class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($size = 300)
    {
        $faker = FakerITA::create('it_IT');
        $faker->seed(1234); //per avere sempre gli stessi valori
        

        for ($i = 0; $i < $size; $i++){
            $doctor = new User();

            $doctor->name = $faker->firstName;
            $doctor->surname = $faker->lastName;
            $doctor->birth_date = $faker->dateTimeBetween('-75 years', '-25 years');
            $doctor->address = strtok($faker->address, ",");
            $doctor->phone_n = $faker->regexify('0[1-9]{1,3} [1-9]{4,8}'); //numeri formato italiano
            
            $birth_year = $doctor->birth_date->format("Y");
            $doctor->email = strtolower(Str::of($doctor->name)).strtolower(Str::of($doctor->surname)).substr($birth_year, 2, 4)."@example.".$faker->randomElement(array('it', 'com', 'net', 'org'));
        
            $doctor->password = bcrypt(Str::of($doctor->name).Str::of($doctor->surname).$birth_year);
            $doctor->save();

            $titleId = Title::inRandomOrder()->first()->id; // prende uno degli id esistenti a casaccio
            $doctor->titles()->sync([$titleId]);

            $performanceId = Performance::inRandomOrder()->first()->id; // prende uno degli id esistenti a casaccio
            $doctor->performances()->sync([$performanceId]);


            if (rand(0,1)){
                $sponsorshipId = Sponsorship::inRandomOrder()->first()->id;

                $sponsorshipLength = intval(Sponsorship::where('id', $sponsorshipId)->pluck('length')->first()); // pluck restituisce il solo valore e non anche la chiave! la first va usata perché è [value]
                $start = new DateTime();
                $expiration = clone $start;
                $expiration->add(new DateInterval('PT'.$sponsorshipLength.'H'));
                  //aggiunte ore della sponsorship
                $doctor->sponsorships()->attach($sponsorshipId, array('start_date'=>$start,'expiration'=>$expiration));
            }

        }
    }
}