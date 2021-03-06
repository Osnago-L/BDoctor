<?php

use App\Performance;
use Illuminate\Database\Seeder;

class PerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $performances = ['Domiciliare','Ambulatoriale','Ospedaliero','Privato','Consulenza Remoto','Ricetta medica'];
        foreach($performances as $performance_name){
            $new_performance = new Performance();
            $new_performance->name = $performance_name;
            $new_performance->save();

        }
    }
}
