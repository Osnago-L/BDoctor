<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DateTime;
use DateInterval;


class DoctorController extends Controller
{   

    public $doctorsQB;
    public $filteredDoctorsQB;

    /* 
    N.B. l'oggetto doctorsQB più che array si può lasciare semplicemente come queryBuilder (senza usare la get()) e concatenare le altre query dopo!
    */

    // PRIVATE FUNCTIONS 

    private function getSponsoredDoctorsQB(){

        $DTnow = new DateTime();
        $DTnow = $DTnow->add(new DateInterval('PT1M'));  //aggiunto 1min
        $DTnow = $DTnow->format("Y-m-d H:i:s");
        $doctorsQB = clone $this->doctorsQB;  //fondamentale clonare l'oggetto!!!
        return $doctorsQB->whereHas('sponsorships', function($query) use($DTnow) {
            $query->where('expiration', '>=', $DTnow);
        });
    }


    private function getUnsponsoredDoctorsQB(){

        /* NOT WORKING */
        // $first = $this->doctorsQB->get();
        // $second = $this->getSponsoredDoctorsQB()->get();
        // return $first->diff($second);

        //Get the id's of first model as array
        $ids1 = $this->doctorsQB->pluck('id');
        //get the id's of second models as array
        $ids2 = $this->getSponsoredDoctorsQB()->pluck('id');
        //get the models
        $diffs = User::whereIn('id',$ids1)->whereNotIn('id',$ids2);
        return $diffs;
    }

    // PUBLIC FUNCTIONS 

    public function index() {

        $titleName = $_GET['title'];
        $doctorsQB = User::whereHas('titles', function($query) use($titleName) {
            $query->where('name', $titleName);
        });

        $this->doctorsQB = $doctorsQB;
        $this->filteredDoctorsQB = clone $this->doctorsQB; //inizializza il contenuto filtrato
        $sponsoredDoctors = $this->getSponsoredDoctorsQB()->get();
        $unsponsoredDoctors = $this->getUnsponsoredDoctorsQB()->get();

        return response()->json(
            [
            'all' => $doctorsQB->get(),
            'sponsoredDoctors' => $sponsoredDoctors,
            'unsponsoredDoctors' => $unsponsoredDoctors,
            ]
        );
    }
    
    public function show($id) {

        $doctor = User::where("id", $id)->with(["titles", "performances", "reviews"])->first();
        return response()->json($doctor);
    }


    // public function filterByReviewStars(int $stars){

    //     if (isset($stars)){

    //         $filteredDoctors = $this->filteredDoctorsQB->whereHas('reviews', function($query) use($stars) {
    //             $query->where('score', ">=", $stars);
    //         })->get();
    //         return response()->json($filteredDoctors);
    //     }
    //     else {
    //         return response()->json($this->filteredDoctorsQB->get());
    //     }
    // }


    // public function filterByReviewNumber(int $reviews){

    //     if (isset($reviews)){
            
    //         $this->doctorsQB->reviews()
    //         ->selectRaw('COUNT(id) as n_reviews')
    //         ->groupBy('user_id')
    //         ->having('COUNT(id)', "=>", $reviews);
            
    //         // ->whereBetween('votes', [1, 100]);
    //     }


    // }

    // public function filterByPerformances(array $performances){

    //     $doctorsQB = $this->doctorsQB->whereHas('performances', function($query) use($performances) {
    //         $query->whereIn('name', $performances);
    //     })->get();
    //     return response()->json($doctorsQB);
    // }

    // /* EXTRA */
    // public function filterByNameSurname($fullName){

    //     $parts = explode(" ", $fullName);

    //     if (count($parts) == 1){
    //         $doctorsQB = $this->doctorsQB->where('surname', 'like', "%".$parts[1]."%");
    //     }
    //     else {
    //         $this->doctorsQB->where( function ( $query ) {

    //             $query->where([
    //                 ['name', 'like', "%".$parts[0]."%"],
    //                 ['surname', '=', $parts[1]],
    //             ])
    //             ->or_where([
    //                 ['name', 'like', "%".$parts[1]."%"],
    //                 ['surname', '=', $parts[0]],
    //             ]);
    //             })->get();
    //     }
    //     return response()->json($doctorsQB);
    // }







    // public static function getPageItems(array $arr, $page, $itemsPerPage) {

    //     $lastIndex = count($arr) - 1;
    //     $startIndex = ($page - 1) * $itemsPerPage;
    //     $remainingItems = $lastIndex - $startIndex; //per verificare se gli elementi non sono esauriti
    //     $remainingPageItems = $itemsPerPage - 1; //item restanti della pagina corrente ($page) 
    //     $lengthOfSlice = 0;
    
    //     if ($remainingItems > $remainingPageItems) {
    //         $lenghtOfSlice = $itemsPerPage;
    //     } else {
    //         $lenghtOfSlice = $remainingItems + 1;
    //     }
    //     $var = array_slice($arr, $startIndex, $lenghtOfSlice);
    //     return $var;
    // }
    

    // public static function showPageNumbers($rowsNum, $itemsPerPage, $url) {
    
    //     $string = "";
    //     $numbers = ceil($rowsNum / $itemsPerPage);
    
    //     if ($numbers > 1) {
    
    //         $pos = strpos($url, "page=");
    //         $pos == 0 ? $pos = 1 : $pos;
    //         $urlWithoutPage = substr($url, 0, strlen($url) - $pos+1);
    //         #$url = preg_replace('/page=([0-9])*/','',$url); //più pesante     
    //         $sep = "&";
    //         $string = "Pagine:";
    
    //         for ($i = 1; $i <= $numbers; $i++) {
    
    //             $url = substr($url, strlen($url));
    //             $string .= "&nbsp&nbsp" . "<a href='$urlWithoutPage" . $sep . "page=$i'>$i</a>";
    //         }
    //     }
    //     return $string;
    // }

}
