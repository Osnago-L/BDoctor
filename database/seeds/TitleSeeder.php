<?php

use App\Title;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Podologia','Urologia','Cardiologia','Dermatologia','Andrologia','Gastroenterologia','Ginecologia','Oculistica','Ortopedia','Proctologia'];
        
        foreach($titles as $title_name){
            $new_title = new Title();
            $new_title->name = $title_name;
            $new_title->save();
        }
    }
}
