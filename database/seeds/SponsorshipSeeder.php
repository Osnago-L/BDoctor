<?php

use App\Sponsorship;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $sponsorships = [
            [
                "name" => "Basic",
                "length" => 24,
                "price" => "2.99"
            ],
            [
                "name" => "Regular",
                "length" => 72,
                "price" => "5.99"
            ],
            [
                "name" => "Premium",
                "length" => 144,
                "price" => "9.99"
            ],
            
        ];


        foreach($sponsorships as $element){
            $new_sponsorship = new Sponsorship();
            $new_sponsorship->name = $element["name"];
            $new_sponsorship->length = $element["length"];
            $new_sponsorship->price = $element["price"];
            $new_sponsorship->save();

        }
    }
}
