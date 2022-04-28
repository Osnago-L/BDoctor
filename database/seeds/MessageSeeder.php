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
                "content" => "Buonasera Dottore, volevo informarla che l'operazione al piede è andata molto bene, il chirurgo ha solo detto che devo solo riposare molto. Volevo ringraziarla per tutto buona serata.Senza di lei non avrei saputo cosa fare, è stato per me come un faro nella notte, non smetterò mai di esserle riconoscente.",
            ],
            [
                "author" => "Luca Valle",
                "email" => "barkovairin@nproxi.com",
                "content" => "Gentile Dottor Verdi,volevo informazioni sul medicinale da Lei prescritto, Inofert , nello specifico avrei necessità di sapere se può essere assunto anche lontano dai pasti.",
            ],

            [
                "author" => "Maurizio Mosiello",
                "email" => "pachm1@shanemalakas.com",
                "content" => "Gent.le Dottore, La presente per comunicarle gli esiti della terapia.Sto prendendo il farmaco 'Quadramet' Sono trascorsi ormai 5 giorni da quando ho iniziato questo trattamento medico. Ho potuto riscontrare un peggioramento della mia salute in generale e, nello specifico: molta stanchezza. Sarò lieto di vederla al prossimo appuntamento presso il Suo studio, per discutere il proseguio della terapia.La ringrazio e la saluto cordialmente",
            ],

            [
                "author" => "Gianluca Benedetti",
                "email" => "vitalson0112@cuedigy.com",
                "content" => "Grazie dottore, Buonasera mi ritengo davvero fortunata ad aver incontrato un medico come lei, grazie al suo aiuto io mi sono ripresa più in fretta.",
            ],

            [
                "author" => "Milan Stojkovic",
                "email" => "Stojk@cuedigy.com",
                "content" => "Buonasera dottore, volevo informarla che dopo la vostra cura mi sento una persona nuova.Io e mia moglie le saremo eternamente grati. Un grazie senza fine dottore.Buona serata.",
            ],

            [
                "author" => "Mario Sannicola",
                "email" => "curemson@cuedigy.com",
                "content" => "Buongiorno dottore, le ho mandato una mail la settimana scorsa ma ancora non ho ricevuto risposta, la prego ho un urgente bisogno del vostro aiuto, spero di ricevere presto suo notizie. A Presto.",
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
