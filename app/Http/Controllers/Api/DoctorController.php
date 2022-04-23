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
    public static $MAX_PAGE_ITEMS = 10;


    /* PUBLIC API METHODS */

    public function index() {

        $sponsoredDoctorsQB = null;
        $unsponsoredDoctorsQB = null;
        $filtered = false;

        if (!isset($_GET['title'])){
            $this->doctorsQB = User::with($this->additionalTables)->select('users.*')->orderByRaw('surname ASC, name ASC'); //restituisce lista di tutti i dottori
            $sponsoredDoctorsQB = $this->getSponsoredDoctorsQB()->orderByRaw('surname ASC, name ASC');
            $unsponsoredDoctorsQB = $this->getUnsponsoredDoctorsQB()->orderByRaw('surname ASC, name ASC');
        }
        else {
            $this->doctorsQB = User::with($this->additionalTables)->whereHas('titles', function($query) {
                $titleNamePrefix = substr($_GET['title'], 0, -2);
                $query->whereRaw('name like ?', $titleNamePrefix.'%');
            });
            $filtered = true;
        }
        $this->filteredDoctorsQB = clone $this->doctorsQB; //inizializza il contenuto filtrato
        
            
        if (isset($_GET['stars']) && 0 < $_GET['stars'] && $_GET['stars'] <= 5){
                $this->filterByReviewStars($_GET['stars']);
                $filtered = true;
        }
        if (isset($_GET['reviews']) && is_int($_GET['reviews']) && ($_GET['reviews']) > 0){
                $this->filterByReviewsCount($_GET['reviews']);
                $filtered = true;
        }
        $this->doctorsQB = $this->filteredDoctorsQB; //rende il filtraggio effettivo

        if ($filtered){
            $sponsoredDoctorsQB = $this->orderByScore($this->getUnSponsoredDoctorsQB());
            $unsponsoredDoctorsQB = $this->orderByScore($this->getUnSponsoredDoctorsQB());
        }

        $sponsorCloneQB = clone($sponsoredDoctorsQB); //ogni volta che si fa una operazione su una QB bisogna clonarla prima: metodi eseguiti cambiano stato degli oggetti QB
        $unsponsorCloneQB = clone($unsponsoredDoctorsQB);
        $allSortedQB = $sponsorCloneQB->union($unsponsorCloneQB);

        return response()->json(
        [
            'success' => true,
            'data' => [

                'sponsoredDoctors' => $sponsoredDoctorsQB->paginate(DoctorController::$MAX_PAGE_ITEMS)->items(),
                'unsponsoredDoctors' => $unsponsoredDoctorsQB->paginate(DoctorController::$MAX_PAGE_ITEMS)->items(),
                'doctorsSorted' => $allSortedQB->paginate(DoctorController::$MAX_PAGE_ITEMS)->items()
            ]
        ]);
    }
    
    public function show($id) {

        $doctor = User::where("id", $id)->with($this->additionalTables)->first();
        return response()->json($doctor);
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

    public static function setMaxPageItems(int $items){
        DoctorController::$MAX_PAGE_ITEMS = $items;
    }


    /* OTHER METHODS */

    private function filterByReviewStars(int $stars){

        $filteredDoctors = $this->filteredDoctorsQB->join('reviews as R1', 'users.id', '=', 'R1.user_id')
        ->select(array('users.*', DB::raw('AVG(R1.`score`) as avg_rate')))
        ->groupBy('R1.user_id')
        // ->havingRaw('AVG(R1.score) BETWEEN ? AND ?', [$stars, $stars+0.5])
        // ->orderBy('R1.user_id', 'desc');
        ->havingRaw('`avg_rate` >= ?', [$stars])
        ->orderByRaw('`avg_rate` desc');
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
 

    private function orderByScore(Builder $doctorsQB){

        $doctorsQB->join('reviews', 'users.id', '=', 'reviews.user_id')
        ->select(array('users.*', DB::raw('AVG(reviews.score) as `avg_rate`')))
        ->groupBy('user_id')
        ->orderByRaw('`avg_rate` DESC');

        // dd($doctorsQB->toSql());
        return $doctorsQB;
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

        //Get the id's of first model as array
        $ids1 = $this->doctorsQB->pluck('id');
        //get the id's of second models as array
        $ids2 = $this->getSponsoredDoctorsQB()->pluck('id');
        //get the models
        $diffs = User::with($this->additionalTables)->whereIn('users.id',$ids1)->whereNotIn('users.id',$ids2);
        return $diffs;
    }


}
