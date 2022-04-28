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
    public function run(Faker $faker, $size=100)
    {
        
        $reviewsScoresTitles = [

                "1" => [
                    "Very bad experience...",
                    "A real butcher!!! Stay away from him!",
                    "A sordid man! I'have sued him.",
                    "Very bad doctor. Very disappointing",
                    "I received a wrong treatment...",
                ],
                "2" => [
                    "There's better. I'm not satisfied with him",
                    "A bad doctor...",
                    "Not recommended",
                    "I was looking for a more qualified doctor...",
                    "A waste of time",
                ],
                "3" => [
                    "A valid choice. I hope I'll recover soon",
                    "Without infamy and without praise",
                    "Might be right",
                    "Gets the job done",
                    "Nothing special"
                ],
                "4" => [
                    "Good doctor. Recommended.",
                    "Competent and approachable.",
                    "He gave me some good advice!",
                    "Quite clear",
                    "Really helpful and qualified!",
                ],
                "5" => [
                    "Simply one of the best in his area",
                    "He saved my life.",
                    "Very good doctor!",
                    "Suprisingly kindly and qualified!",
                    "Very experienced and talented. He makes the difference",
                ]
        ];

        
        for ($i = 0; $i < $size; $i++){

            $newReview = new Review();
            $newReview->author = $faker->userName();
            $newReview->score = rand(1, 5);
            $newReview->title = $reviewsScoresTitles[$newReview->score][rand(0,4)];
            $newReview->content = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis itaque, suscipit harum facere debitis iusto perspiciatis natus possimus aspernatur error modi. Expedita perspiciatis eligendi iste voluptate animi ratione, consectetur placeat laboriosam, culpa ex unde esse sapiente quia asperiores, architecto maiores?";
            $newReview->user_id = User::inRandomOrder()->first()->id;
            $newReview->save();
        }
    }
}