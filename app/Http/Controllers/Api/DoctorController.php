<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;


class DoctorController extends Controller
{   

    public $doctorsQB;


    /* 
    N.B. l'oggetto doctorsQB più che array si può lasciare semplicemente come queryBuilder (senza usare la get()) e concatenare le altre query dopo!
    */

    public function index($titleName) {


        $_GET['titleName'];
        $doctorsQB = User::whereHas('titles', function($query) use($titleName) {
            $query->where('name', $titleName);
        });

        $this->doctorsQB = $doctorsQB;

        $sponsoredDoctorsQB = $this->doctorsQB->whereHas('sponsorship', function($query) {
            $query->whereRaw('sponsorship.user_id = users.id');
        });

        dd($sponsoredDoctorsQB->get());

        $sponsoredDoctors = $this->doctorsQB->sponsorships()->where('user.id', )->exists()->get();
        $notSponsoredDoctors = $this->doctorsQB->sponsorships()->where('user.id', )->notExists()->get();


        return response()->json(
            [
            'sponsoredDoctors' => $sponsoredDoctors,
            'notSponsoredDoctors' => $notSponsoredDoctors,
            ]
        );
    }
    
    
    public function show($id) {

        $doctor = User::where("id", $id)->with(["titles", "performances", "reviews"])->first();
        return response()->json($doctor);
    }


    public function filterByReviewStars(int $stars){

        $doctorsQB = $this->doctorsQB->whereHas('reviews', function($query) use($stars) {
            $query->where('score', ">=", $stars);
        })->get();
        return response()->json($doctorsQB);
    }

    public function filterByReviewNumber(int $reviews){
        $this->doctorsQB->reviews()
        ->selectRaw('count(id) as n_reviews')
        ->groupBy('user_id')
        ->having('n_reviews', "=>", $reviews);


        ->whereBetween('votes', [1, 100]);
    }


    public function filterByPerformances(array $performances){

        $doctorsQB = $this->doctorsQB->whereHas('performances', function($query) use($performances) {
            $query->whereIn('name', $performances);
        })->get();
        return response()->json($doctorsQB);
    }


    public function filterByNameSurname($fullName){

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


    public function sponsoreddoctors(){
        $doctorsQB = $this->doctorsQB->whereExists(function($query){
            $query->from('sponsorship_user')
                  ->whereRaw('users.id = sponsorship_user.user_id');
        })->get();
        return response()->json($doctorsQB);
    }

    /*
    $pivot = Models::table('sp');
    $roles = Models::table('roles');
    $prefix = Models::prefix();
    $query->from($table)->join($pivot, $key, '=', $pivot . '.entity_id')->whereRaw("{$prefix}{$pivot}.role_id = {$prefix}{$roles}.id")->where("{$pivot}.entity_type", $model->getMorphClass())->whereIn($key, $keys);
    */


    function getPageItems(array $arr, $page, $itemsPerPage) {

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
    
    
    function showPageNumbers($rowsNum, $itemsPerPage, $url) {
    
        $string = "";
        $numbers = ceil($rowsNum / $itemsPerPage);
    
        if ($numbers > 1) {
    
            $pos = strpos($url, "page=");
            $pos == 0 ? $pos = 1 : $pos;
            $urlWithoutPage = substr($url, 0, strlen($url) - $pos+1);
            #$url = preg_replace('/page=([0-9])*/','',$url); //più pesante
                    
            $sep = "&";
    
    
            $string = "Pagine:";
    
            for ($i = 1; $i <= $numbers; $i++) {
    
                $url = substr($url, strlen($url));
                $string .= "&nbsp&nbsp" . "<a href='$urlWithoutPage" . $sep . "page=$i'>$i</a>";
            }
        }
        return $string;
    }

}
