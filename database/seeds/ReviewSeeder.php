<?php

use Illuminate\Database\Seeder;
use App\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $reviews = [

            [
                'author' => "Pinco Pallo",
                'title' => "Really helpful and qualified!",
                'content' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta minima labore, laudantium adipisci omnis rerum quis asperiores nobis sit assumenda quo saepe? Soluta, repellendus, repellat incidunt doloremque quas debitis aperiam sunt id inventore, laborum expedita architecto cum distinctio. Atque veritatis adipisci harum error consectetur! Ipsam recusandae quod facere quasi sunt",
                'score' => 5,
            ],
            [
                'author' => "Tizio Caio",
                'title' => "A real butcher!!! Stay away from him!",
                'content' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta minima labore, laudantium adipisci omnis rerum quis asperiores nobis sit assumenda quo saepe? Soluta, repellendus, repellat incidunt doloremque quas debitis aperiam sunt id inventore, laborum expedita architecto cum distinctio. Atque veritatis adipisci harum error consectetur! Ipsam recusandae quod facere quasi sunt",
                'score' => 1,
            ],
            [
                'author' => "Sempronio",
                'title' => "A sordid gynecologist! I slapped him harshly in the face.",
                'content' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta minima labore, laudantium adipisci omnis rerum quis asperiores nobis sit assumenda quo saepe? Soluta, repellendus, repellat incidunt doloremque quas debitis aperiam sunt id inventore, laborum expedita architecto cum distinctio. Atque veritatis adipisci harum error consectetur! Ipsam recusandae quod facere quasi sunt",
                'score' => 1,
            ],
            [
                'author' => "Mario Rossi",
                'title' => "There is better...",
                'content' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta minima labore, laudantium adipisci omnis rerum quis asperiores nobis sit assumenda quo saepe? Soluta, repellendus, repellat incidunt doloremque quas debitis aperiam sunt id inventore, laborum expedita architecto cum distinctio. Atque veritatis adipisci harum error consectetur! Ipsam recusandae quod facere quasi sunt",
                'score' => 3,
            ],
        ];

        
        foreach($reviews as $review){

            $newReview = new Review();
            $newReview->author = $review['author'];
            $newReview->title = $review['title'];
            $newReview->content = $review['content'];
            $newReview->score = $review['score'];
            $newReview->user_id = 1;

            $newReview->save();
        }
    }
}