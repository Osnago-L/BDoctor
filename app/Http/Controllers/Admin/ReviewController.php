<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Review;
use App\User;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        $user = User::find(Auth::user()->id);
        return view('admin.reviews.index', compact('reviews', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


/*

function generateStars($rating) {

    $rating = round($rating * 2) / 2;
    $checkedStarHtml = "<span class='fa fa-star checked'></span>";
    $emptyStarHtml = "<span class='fa fa-star'></span>";
    $halfStarHtml = "<span class='fa fa-star-half'></span>";

    $stars = floor($rating);
    $rest = $rating - $stars;
    ($rest >= 1) ? $emptyStars = 5 - $stars : $emptyStars = 0;

    $htmlStars = "";

    for ($i = 0; $i < $stars; $i++) {
        $htmlStars .= $checkedStarHtml;
    }
    if ($rest == "0.5") {
        $htmlStars .= $halfStarHtml;
    } else {
        for ($i = 0; $i < $emptyStars; $i++) {
            $htmlStars .= $emptyStarHtml;
        }
    }
    return $htmlStars;
}


*/