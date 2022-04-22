<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\DB;


class DoctorController extends Controller
{   

    private $doctorsQB;
    private $filteredDoctorsQB;
    public static $MAX_PAGE_ITEMS = 10;


    // PRIVATE METHODS 
    /**
     * modifies $this->filteredDoctorsQB
     */
    private function getSponsoredDoctorsQB(){

        $DTnow = new DateTime();
        $DTnow = $DTnow->add(new DateInterval('PT1M'));  //aggiunto 1min
        $DTnow = $DTnow->format("Y-m-d H:i:s");
        $doctorsQB = clone $this->doctorsQB;  //fondamentale clonare l'oggetto!!!
        return $doctorsQB->whereHas('sponsorships', function($query) use($DTnow) {
            $query->where('expiration', '>=', $DTnow);
        });
    }

    /**
     * modifies $this->filteredDoctorsQB
     */
    private function getUnsponsoredDoctorsQB(){

        //Get the id's of first model as array
        $ids1 = $this->doctorsQB->pluck('id');
        //get the id's of second models as array
        $ids2 = $this->getSponsoredDoctorsQB()->pluck('id');
        //get the models
        $diffs = User::with(['titles', 'performances'])->whereIn('id',$ids1)->whereNotIn('id',$ids2);
        return $diffs;
    }


    // PUBLIC FUNCTIONS / METHODS

    public function index() {
        
        $this->doctorsQB = User::with(['titles', 'performances'])->select('users.*'); //restituisce lista di tutti i dottori

        if (isset($_GET['title'])){
            
            $titleName = $_GET['title'];
            $titleNamePrefix = substr($titleName, 0, -2);
            $this->doctorsQB = User::with(['titles', 'performances'])->whereHas('titles', function($query) use($titleNamePrefix) {
                $query->whereRaw('name like ?', $titleNamePrefix.'%');
            });
            $this->filteredDoctorsQB = clone $this->doctorsQB; //inizializza il contenuto filtrato
        }
        if (isset($_GET['stars']) || isset($_GET['reviews'])){
            
            if (0 < $_GET['stars'] && $_GET['stars'] <= 5){
                $this->filterByReviewStars($_GET['stars']);
            }
            if (is_int($_GET['reviews']) && ($_GET['reviews']) > 0){
                $this->filterByReviewsCount($_GET['reviews']);
            }
            $this->doctorsQB = $this->filteredDoctorsQB;
        }

        $sponsoredDoctorsQB = $this->getSponsoredDoctorsQB();
        $unsponsoredDoctorsQB = $this->getUnsponsoredDoctorsQB();
        $allSortedLimitedQB = $sponsoredDoctorsQB->union($unsponsoredDoctorsQB);
        $allSortedLimited = $allSortedLimitedQB->get()->toArray();


        if (isset($_GET['page'])){
            $allSortedLimited = $this->getPageItems($allSortedLimited, $_GET['page'], DoctorController::$MAX_PAGE_ITEMS);
        }

        return response()->json(
        [
            'success' => true,
            'data' => [

                'sponsoredDoctors' => $sponsoredDoctorsQB->get(),
                'unsponsoredDoctors' => $unsponsoredDoctorsQB->get(),
                'doctorsSortedLimited' => $allSortedLimited,
            ]
        ]);
    }
    
    public function show($id) {

        $doctor = User::where("id", $id)->with(["titles", "performances", "reviews"])->first();
        return response()->json($doctor);
    }


    private function filterByReviewStars(int $stars){

        $filteredDoctors = $this->filteredDoctorsQB->join('reviews as R1', 'users.id', '=', 'R1.user_id')
        ->select(array('users.*', DB::raw('AVG(R1.`score`) as avg_rate')))
        ->groupBy('R1.user_id')
        // ->havingRaw('AVG(R1.score) BETWEEN ? AND ?', [$stars, $stars+0.5])
        ->having('AVG(R1.score)', '>=', $stars)
        ->orderBy('R1.user_id', 'desc');
    }


    private function filterByReviewsCount(int $reviews){

        $filteredDoctors = $this->filteredDoctorsQB->join('reviews as R2', 'users.id', '=', 'R2.user_id')
        ->select(array('users.*', DB::raw('COUNT(R2.`user_id`) as reviews_n')))
        ->groupBy('R2.user_id')
        ->havingRaw('COUNT(R2.user_id) >= ?', [$reviews])
        ->orderBy('R2.user_id', 'desc');
        
        /* query grezza (testata su phpmyadmin, ma senza prefiltraggio degli users)
        $queryRaw = "SELECT `users`.*, COUNT(`user_id`) as `reviews_n` 
        FROM `users`, `reviews` 
        WHERE `users`.id = `reviews`.user_id 
        GROUP BY(user_id) 
        HAVING COUNT(`user_id`) >= $reviews
        ORDER BY (`user_id`) DESC";
        */
    }

    private function filterByPerformances(array $performances){

        $filteredDoctors = $this->doctorsQB->whereHas('performances', function($query) use($performances) {
            $query->whereIn('name', $performances);
        })->get();
        return response()->json($filteredDoctors);
    }
    
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

    
    public static function setMaxPageItems(int $items){
        DoctorController::$MAX_PAGE_ITEMS = $items;
    }

    private static function getPageItems(array $arr, $page, $itemsPerPage) {

        $lastIndex = count($arr) - 1;
        $startIndex = ($page - 1) * $itemsPerPage;
        $remainingItems = $lastIndex - $startIndex; //per verificare se gli elementi non sono esauriti
        $remainingPageItems = $itemsPerPage - 1; //item restanti della pagina corrente ($page) 
        $lengthOfSlice = 0;
    
        if ($remainingItems > $remainingPageItems) {
            $lenghtOfSlice = $itemsPerPage;
        } else {
            $lenghtOfSlice = $remainingItems + 1;
        }
        $var = array_slice($arr, $startIndex, $lenghtOfSlice);
        return $var;
    }

    public static function getPageNumbers($rowsNum, $itemsPerPage, $url) {
    
        $html = "Pagine:";
        $numbers = ceil($rowsNum / $itemsPerPage);
    
        if ($numbers > 1) {
    
            $pos = strpos($url, "page=");
            $pos == 0 ? $pos = 1 : $pos;
            $urlWithoutPage = substr($url, 0, strlen($url) - $pos+1);
            $sep = "&";
    
            for ($i = 1; $i <= $numbers; $i++) {
    
                $url = substr($url, strlen($url));
                $html .= "&nbsp&nbsp" . "<a href='$urlWithoutPage" . $sep . "page=$i'>$i</a>";
            }
        }

        return response()->json(
            [
                'success' => true,
                'data' => [
                    'pageLinks' => $html,
                ]
            ]);
    }
}
