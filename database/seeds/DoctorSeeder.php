<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


use App\User;
use App\Title;
use App\Sponsorship;


class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker, $size = 10)
    {
        // $faker = Faker\Factory::create('en_US');
        // $faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
        // $faker->seed(1234); //per avere sempre gli stessi valori


        $surnames = ['Rossi', 'Bianchi', 'Verdi', 'Neri', 'Viola'];
        $names = ['Antonio', 'Bruno', 'Carlo', 'Dario', 'Edoardo', 'Fabio', 'Giovanni'];
        $addresses = ['Ponti della Priula','Ceresio','F. Cilea','C. Imperatrice','V. Muciaccia','T. Schifaldo','Lussinpiccolo','Poasco','M. Rosso','Bastioni Bramante'];

        
        for ($i = 0; $i < $size; $i++){
            $doctor = new User();
            
            /* Nomi, Cognomi, N^telefono USA
                N.B. $faker->name() crea nome e cognome
                $nameSurnameArr = explode(" ",$faker->name());
                $doctor->name = $nameSurnameArr[0];
                $doctor->surname = $nameSurnameArr[01]; 
                $doctor->phone = $faker->unique->e164PhoneNumber();
                */
            // $doctor->email = strtolower(Str::of($doctor->name)).strtolower(Str::of($doctor->surname))."@example.it";
            
            $doctor->name = $names[rand(0, count($names)-1)]; 
            $doctor->surname = $surnames[rand(0, count($surnames)-1)];
            $doctor->birth_date = $faker->dateTimeBetween('-75 years', '-25 years');
            $doctor->address = "via ".$addresses[rand(0, count($addresses)-1)]." ".$faker->numberBetween($min = 1, $max = 250).$faker->optional()->randomElement($array = array ('a','b','c','d','e','f'));
            $doctor->phone_n = $faker->regexify('0[1-9]{1,3} [1-9]{4,8}'); //numeri formato italiano
            $doctor->email = $faker->safeEmail();
            
            
            $doctor->password = /*bcrypt(*/ Str::of($doctor->name).Str::of($doctor->surname); /*); */
            $doctor->save();

            $titleId = Title::inRandomOrder()->first()->id; // prende uno degli id esistenti a casaccio
            $doctor->titles()->sync([$titleId]);


            if (rand(0,1)){
                $sponsorshipId = Sponsorship::inRandomOrder()->first()->id;

                $sponsorshipLength = Sponsorship::where('id', $sponsorshipId)->pluck('length')->first(); // pluck restituisce il solo valore e non anche la chiave! la first va usata perché è [value]
                $start = new DateTime();
                $expiration = $start->add(new DateInterval('PT'.$sponsorshipLength.'H'));  //aggiunte ore della sponsorship
                $doctor->sponsorships()->attach($sponsorshipId, array('start_date'=>$start,'expiration'=>$expiration));
            }

        }
    }
}