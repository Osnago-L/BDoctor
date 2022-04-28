<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Review;
use App\User;


class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker, $size=3500)
    {
        
        $reviewsScoresTitles = [

                "1" => [

                    'titles' =>[

                        "Pessima esperienza...",
                        "Un vero macellaio! State lontano da lui.",
                        "Inaffidabile. L'ho querelato",
                        "Davvero contrariato...",
                        "Mi ha prescritto una cura errata!",
                    ],
                    'comments' => [
                        "Sono davvero rimasto molto deluso da Bdoctor per questa brutta esperienza.",
                        "Circa una settimana fa mi ha mandato a casa dicendo che non avevo nulla ed invece due
                        settimane più tardi ho appreso di avere un serio problema di salute",
                        "La cura che mi ha prescritto mi ha fatto più male che bene. Non lasciatevi imbottire di farmaci",
                        "Più di un amico mi ha consigliato il suo nome dicendomi che è una persona molto competente, invece è molto caro
                        e non mi ha dato soddisfazione",
                        "Non ho parole. L'intervento a cui sono stato sottoposto ha avuto complicazioni. Il medico non aveva molta esperienza su questo
                        tipo di interventi..."
                    ]
                ],
                "2" => [

                    'titles' =>[

                        "C'è di meglio. Non sono soddisfatto",
                        "Mediocre",
                        "Non consigliato",
                        "Cercavo uno specialista competente ed invece...",
                        "Una perdita di tempo",
                    ],
                    'comments' => [
                        "Non mi ha detto nulla di più di quanto già sapevo...",
                        "Non mi ha fatto quasi parlare, parlava sempre lui e non riuscivo a seguirlo poiché non ne capisco e lui usava un linguaggio molto tecnico",
                        "Uno specialista troppo indaffarato... Non male ma temo non riesca a seguire bene i suoi pazienti.",
                        "La terapia che ho seguito non era delle migliori... adesso sto meglio ma non tornerò da lui.",
                        "Cercate professionisti recensiti meglio, non mi ha fatto una buona impressione",
                    ]
                ],
                "3" => [

                    'titles' =>[
                        "Una valida opzione. Spero di riprendermi presto",
                        "Senza infamia ne' lode",
                        "Può andar bene",
                        "Fa il suo dovere",
                        "Niente di speciale."
                    ],
                    'comments' => [
                        "Non male. Se cercate un professionista che non prende parcelle esorbitanti, contattate lui, non ve ne pentirete. ",
                        "Per la visita da me richiesta può andare più che bene",
                        "E' una valida scelta ma se avete urgenza scegliete altro, ha davvero troppa gente.",
                        "Molto competente, ma umanamente intrattabile. Non vuole che gli si dica come si fa il suo mestiere. E comunque
                        per certi versi ha ragione, su internet c'è molta disinformazione",
                        "Non posso lamentarmi. Il 12 aprile ho prenotato una visita che mi è stata fissata già il 16. Con altri specialisti
                        passa molto più tempo.",
                    ]
                ],
                "4" => [

                    'titles' =>[

                        "Bravo. Ve lo consiglio",
                        "Competente e disponibile",
                        "Mi ha dato alcune ottime dritte",
                        "Molto chiaro",
                        "Mi è stato davvero di aiuto",
                    ],
                    'comments' => [
                        "Mi ha fatto un'ottima impressione sin da quando sono entrato per la prima volta nel suo studio.
                        Devo dire che è molto accurato e diligente e sa fare ottime diagnosi.",
                        "Grazie alla sua terapia sono riuscito nuovamente a fare tutto ciò che facevo prima della malattia",
                        "Sa essere molto chiaro e comprensibile quando parla con i pazienti.",
                        "Non è facile trovare un medico che fa della prevenzione il suo punto di forza e cerca di evitare di imbottire di
                        farmaci. Mi sono trovato davvero molto bene e ho rispolverato i classici rimedi della nonna.",
                        "Sembra promettente per il momento. Non posso dargli 5 stelle perché devo conoscerlo meglio, aspetto che finisca
                        la terapia che comunque sta già dando risultati.",
                    ]
                ],
                "5" => [

                    'titles' =>[

                        "Semplicemente uno dei migliori nel suo campo",
                        "Mi ha davvero migliorato la vita...",
                        "Davvero in gamba!",
                        "Sorprendentemente gentile e qualificato",
                        "Molto esperto e talentuoso. Fa la differenza.",
                    ],
                    'comments' => [
                        "Ora so a chi posso rivolgermi quando ho problemi di questo tipo. Una sicurezza. TOP",
                        "Mi avevano fatto il suo nome diversi amici, e devo dire che avevano pienamente ragione. Sa mettere le persone a loro agio
                        e per me è stato più facile del solito collaborare",
                        "Sono profondamente grato a questo professionista e all'impegno che ci mette per rimanere sempre aggiornato",
                        "Se fossero tutti disponibili e competenti come lui i pazienti non sarebbero più diffidenti. Ve lo consiglio.",
                        "Uno specialista con i fiocchi e per giunta anche delle mie parti! Non potevo trovare di meglio."
                    ]
                ]
        ];

        
        for ($i = 0; $i < $size; $i++){

            $newReview = new Review();
            $newReview->author = $faker->userName();
            $newReview->score = rand(1, 5);
            $newReview->title = $reviewsScoresTitles[$newReview->score]['titles'][rand(0,4)];
            $newReview->content = $reviewsScoresTitles[$newReview->score]['comments'][rand(0,4)];
            $newReview->user_id = User::inRandomOrder()->first()->id;
            $newReview->save();
        }
    }
}