<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\User;

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
                "content" => "Buongiorno Dottore, come posso fare per prenotare una vista con lei?",
            ],
            [
                "author" => "Lorenzo Osnago",
                "email" => "desidiosa@ndgbmuh.com",
                "content" => "Salve Dottore, in allegato le lascio le analisi che mi ha chiesto la settimana scosa.",
            ],
            [
                "author" => "Matteo Pompei",
                "email" => "socmirby@mailpluss.com",
                "content" => "Salve Dottore, ho un problema alla schiena, quando possiamo vederci? Prenoto la vista e vengo allo studio?",
            ],
            [
                "author" => "Davide Masa",
                "email" => "mariereimus@zeemails.in",
                "content" => "Ciao dottore, come state? Ho visto che siete il migliore nella zona,quando possiamo vederci per la visita?",
            ],
            [
                "author" => "Lorenzo Bernardini",
                "email" => "sham924@eeuasi.com",
                "content" => "Buonsera Dottore, 2 mesi fa sono stato investito e tra 1 mese ho un operazione al ginocchio. Cosa mi consiglia di fare nei giorni prima dell operazione? Grazie",
            ],
            [
                "author" => "Vincenzo Vitello",
                "email" => "mikovsa@sewce.com",
                "content" => "Dottore grazie della cura che mi ha dato lo scorso mese, è stata miracolosa mi sento rinato.Grazie!!",
            ],
            [
                "author" => "Alessio Tomei",
                "email" => "okbaby@ezybarber.com",
                "content" => "Dottore purtroppo da quando sono stato a visita la scorsa settimana il dolore non si è fermato, non so piu cosa fare. Possiamo prendere un altro appuntamento?",
            ],
            [
                "author" => "Matteo Salvalaggio",
                "email" => "thieun3@hackertrap.info",
                "content" => "Salve Dottore, volevo informarla che ho avuto un imprevisto e non posso più venire all appuntamento del 23/05/2022. Possiamo metterci d'accordo per un altra data. Attendo sue notizie. Buona serata.",
            ],
            [
                "author" => "Lorenzo Guerrini",
                "email" => "ilnar@omtecha.com",
                "content" => "Buongiorno Dottore,la contatto perchè avevo bisogno di prenotare un appuntamento presso il vostro ambulatorio per una visita specialistica. Grazie a presto",
            ],
            [
                "author" => "Sara Barbi",
                "email" => "ezbill4u99@greendike.com",
                "content" => "Buongiorno Dottore, la contatto riguardo la ricetta medica, alla prenotazione della visita mi dice che il codice è scaduto, cosa possiamo risolvere?",
            ],
            [
                "author" => "Losa Fabio",
                "email" => "cacsa00123@cuedigy.com",
                "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi eaque cum quod? Aliquid, optio. Ducimus, illo consequuntur. Suscipit accusamus dolorum quisquam, adipisci assumenda exercitationem commodi dolores placeat et facilis voluptatibus?",
            ],
            [
                "author" => "Luca Valle",
                "email" => "barkovairin@nproxi.com",
                "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi eaque cum quod? Aliquid, optio. Ducimus, illo consequuntur. Suscipit accusamus dolorum quisquam, adipisci assumenda exercitationem commodi dolores placeat et facilis voluptatibus?",
            ],

            [
                "author" => "Maurizio Mosiello",
                "email" => "pachm1@shanemalakas.com",
                "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi eaque cum quod? Aliquid, optio. Ducimus, illo consequuntur. Suscipit accusamus dolorum quisquam, adipisci assumenda exercitationem commodi dolores placeat et facilis voluptatibus?",
            ],

            [
                "author" => "Gianluca Benedetti",
                "email" => "vitalson0112@cuedigy.com",
                "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi eaque cum quod? Aliquid, optio. Ducimus, illo consequuntur. Suscipit accusamus dolorum quisquam, adipisci assumenda exercitationem commodi dolores placeat et facilis voluptatibus?",
            ],

            [
                "author" => "Mario Sannicola",
                "email" => "curemson@cuedigy.com",
                "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi eaque cum quod? Aliquid, optio. Ducimus, illo consequuntur. Suscipit accusamus dolorum quisquam, adipisci assumenda exercitationem commodi dolores placeat et facilis voluptatibus?",
            ],

            
        ];

        foreach($messages as $message){

            $newMessage = new Message();
            $newMessage->author = $message['author'];
            $newMessage->email = $message['email'];
            $newMessage->content = $message['content'];
            $newMessage->user_id = User::all()->random()->id;
            $newMessage->save();
        }
    }
}
