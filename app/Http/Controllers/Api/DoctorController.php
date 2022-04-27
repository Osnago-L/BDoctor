<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use DateTime;
use DateInterval;


class DoctorController extends Controller
{   

    private $doctorsQB;
    private $filteredDoctorsQB;
    private $additionalTables = ['titles', 'performances', 'reviews','sponsorships'];
    public static $MAX_PAGE_ITEMS = 3;


    /* PUBLIC API METHODS */

    public function index() {

        $sponsoredDoctorsQB = null;
        $unsponsoredDoctorsQB = null;
        $filtered = false;

        if (!isset($_GET['title'])){
            $this->doctorsQB = User::with($this->additionalTables)->select('users.*'); //restituisce lista di tutti i dottori
        }
        else {
            $this->doctorsQB = User::with($this->additionalTables)->whereHas('titles', function($query) {
                $titleNamePrefix = substr($_GET['title'], 0, -2);
                $query->whereRaw('name like ?', $titleNamePrefix.'%');
            });
            $filtered = true;
        }
        $this->filteredDoctorsQB = clone($this->doctorsQB); //inizializza il contenuto filtrato        

        $starsFilter = isset($_GET['stars']) && 0 < $_GET['stars'] && $_GET['stars'] <= 5;
        $reviewsFilter = isset($_GET['reviews']) && $_GET['reviews'] > 0;
        
        if ($starsFilter && $reviewsFilter){
            $this->filterByStarsAndReviews($_GET['stars'], $_GET['reviews']);
            $filtered = true;
        }
        else {
            if ($starsFilter){
                    $this->filterByReviewStars($_GET['stars']);
                    $filtered = true;
            }
            if ($reviewsFilter){
                    $this->filterByReviewsCount($_GET['reviews']);
                    $filtered = true;
            }
        }
        $this->doctorsQB = $this->filteredDoctorsQB; //rende effettivo l'eventuale filtraggio

        // dd($this->doctorsQB->toSql());

        if ($filtered){
            $sponsoredDoctorsQB = $this->getSponsoredDoctorsQB();
            $unsponsoredDoctorsQB = $this->getUnSponsoredDoctorsQB();
        }
        else {
            $sponsoredDoctorsQB = $this->getSponsoredDoctorsQB()->orderByRaw('surname ASC, name ASC');
            $unsponsoredDoctorsQB = $this->getUnsponsoredDoctorsQB()->orderByRaw('surname ASC, name ASC');
        }

        $sponsorCloneQB = clone($sponsoredDoctorsQB); //ad ogni nuova operazione su un QB da salvare, bisogna prima clonarlo (metodi eseguiti cambiano stato degli oggetti QB)
        $unsponsorCloneQB = clone($unsponsoredDoctorsQB);
        $allSortedQB = $sponsorCloneQB->union($unsponsorCloneQB);
        $foundResults =clone($allSortedQB);
        $totDoctors =clone($allSortedQB);

        return response()->json(
        [
            'success' => true,
            'data' => [
                'foundResults' => $foundResults->paginate()->total(),
                'maxItemsPerPage' => DoctorController::$MAX_PAGE_ITEMS,
                'maxPages' => DoctorController::getPages($totDoctors->paginate()->total(), DoctorController::$MAX_PAGE_ITEMS),
                'sponsoredDoctors' => $sponsoredDoctorsQB->paginate(DoctorController::$MAX_PAGE_ITEMS)->items(),
                // 'unsponsoredDoctors' => $unsponsoredDoctorsQB->paginate(DoctorController::$MAX_PAGE_ITEMS)->items(),
                'doctors' => $allSortedQB->paginate(DoctorController::$MAX_PAGE_ITEMS)->items(),
                
            ]
        ]);
    }
    
    public function show($id) {

        $doctor = User::where("id", $id)->with($this->additionalTables)->first();
        return response()->json($doctor);
    }
    
<<<<<<< HEAD
    public static function getPageNumbers() {
        
        $itemsPerPage = DoctorController::$MAX_PAGE_ITEMS;
        $items = $_GET['items'];
        $url = $_GET['route'];

        $html = "Pagine:";
        $numbers = ceil($items / $itemsPerPage);
=======
    public static function getPages($rowsNum, $itemsPerPage) {
        // $url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        // $html = "Pagine:";
        return ceil($rowsNum / $itemsPerPage);
>>>>>>> search-small-fix
    
        // if ($numbers > 1) {
    
        //     $pos = strpos($url, "page=");
        //     $pos == 0 ? $pos = 1 : $pos;
        //     $urlWithoutPage = substr($url, 0, strlen($url) - $pos+1);
        //     $sep = "&";
    
        //     for ($i = 1; $i <= $numbers; $i++) {
    
        //         $url = substr($url, strlen($url));
        //         $html .= "&nbsp&nbsp" . "<a href='$urlWithoutPage" . $sep . "page=$i'>$i</a>";
        //     }
        // }

        return response()->json(
        [
            'success' => true,
            'data' => [
                'pageLinks' => $html,
            ]
        ]);
    }

    public static function setMaxPageItems(int $items){
        DoctorController::$MAX_PAGE_ITEMS = $items;
    }


    /* OTHER METHODS */

    private function filterByReviewStars(int $stars){

        $this->filteredDoctorsQB->join('reviews as R1', 'users.id', '=', 'R1.user_id')
        ->select('users.*')
        ->groupBy('R1.user_id')
        ->havingRaw('AVG(R1.`score`) >= ?', [$stars])
        ->orderByRaw('AVG(R1.`score`) DESC');
    }

    private function filterByReviewsCount(int $reviews){

        $this->filteredDoctorsQB->join('reviews as R2', 'users.id', '=', 'R2.user_id')
        ->select('users.*')
        ->groupBy('R2.user_id')
        ->havingRaw('COUNT(R2.`user_id`) >= ?', [$reviews])
        ->orderByRaw('COUNT(R2.`user_id`) DESC');
    }

    private function filterByStarsAndReviews(int $stars, int $reviews){
        $this->filteredDoctorsQB->join('reviews', 'users.id', '=', 'reviews.user_id')
        ->select('users.*')
        ->groupBy('reviews.user_id')
        ->havingRaw('AVG(reviews.score) >= ? AND COUNT(reviews.user_id) >= ?', [$stars, $reviews])
        ->orderByRaw('AVG(reviews.score) DESC, COUNT(reviews.user_id) DESC');
    }


    private function filterByPerformances(array $performances){  /* EXTRA */

        $filteredDoctors = $this->doctorsQB->whereHas('performances', function($query) use($performances) {
            $query->whereIn('name', $performances);
        })->get();
        return response()->json($filteredDoctors);
    }
    
    private function filterByNameSurname($fullName){  /* EXTRA */

        $parts = explode(" ", $fullName);

        if (count($parts) == 1){
            $doctorsQB = $this->doctorsQB->where('surname', 'like', "%".$parts[1]."%");
        }
        else {
            $this->doctorsQB->where( function ( $query ) {

                $query->where([
                    ['name', 'like', "%".$parts[0]."%"],
                    ['surname', '=', $parts[1]],
                ])
                ->or_where([
                    ['name', 'like', "%".$parts[1]."%"],
                    ['surname', '=', $parts[0]],
                ]);
                })->get();
        }
        return response()->json($doctorsQB);
    }


    /**
     * modifies $this->filteredDoctorsQB
     */
    private function getSponsoredDoctorsQB(){

        $DTnow = new DateTime();
        $DTnow = $DTnow->add(new DateInterval('PT1M'));  //aggiunto 1min
        $DTnow = $DTnow->format("Y-m-d H:i:s");
        $doctorsQB = clone $this->doctorsQB;  //fondamentale clonare l'oggetto per non sporcare il campo originario col filtro seguente!!!
        return $doctorsQB->whereHas('sponsorships', function($query) use($DTnow) {
            $query->where('expiration', '>=', $DTnow);
        });
    }

    /**
     * modifies $this->filteredDoctorsQB
     */
    private function getUnsponsoredDoctorsQB(){

        $ids1 = $this->doctorsQB->pluck('id');   //dottori potenzialmente filtrati
        $ids2 = $this->getSponsoredDoctorsQB()->pluck('id'); 
        $diffs = User::with($this->additionalTables)->whereIn('users.id',$ids1)->whereNotIn('users.id',$ids2);
        return $diffs;
    }


}
