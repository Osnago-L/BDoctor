<?php

use Illuminate\Database\Seeder;
use App\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            [
                "author" => "Anonimo",
                "email" => "anonymous@anonymous.it",
                "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi eaque cum quod? Aliquid, optio. Ducimus, illo consequuntur. Suscipit accusamus dolorum quisquam, adipisci assumenda exercitationem commodi dolores placeat et facilis voluptatibus?",
            ],
            [
                "author" => "Alfredo Dalcaldo",
                "email" => "alfrdalcal@smidollato.it",
                "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi eaque cum quod? Aliquid, optio. Ducimus, illo consequuntur. Suscipit accusamus dolorum quisquam, adipisci assumenda exercitationem commodi dolores placeat et facilis voluptatibus?",
            ],
            [
                "author" => "Lino Sasso",
                "email" => "sassolino@ghiaia.it",
                "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi eaque cum quod? Aliquid, optio. Ducimus, illo consequuntur. Suscipit accusamus dolorum quisquam, adipisci assumenda exercitationem commodi dolores placeat et facilis voluptatibus?",
            ],
            
        ];

        foreach($messages as $message){

            $newMessage = new Message();
            $newMessage->author = $message['author'];
            $newMessage->email = $message['email'];
            $newMessage->content = $message['content'];
            $newMessage->user_id = 1;
            $newMessage->save();
        }
    }
}
