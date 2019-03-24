<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate(request(), [
		'aha_score' => 'required',
		'wirkt_score' => 'required',
		'cool_score' => 'required',
		'review_content_id'=> 'required',
        ]);
		$review = new Review;
		$review->aha_score = $request->aha_score;
		$review->cool_score = $request->cool_score;
		$review->wirkt_score = $request->wirkt_score;
		$review->content_id = $request->review_content_id;
		$review->review_comment = $request->review_comment;
        $review->unit_id = $request->review_unit_id;
        $review->content_id = $request->review_content_id;
        $reviews_all = array($review->aha_score, $review->cool_score, $review->wirkt_score);
		$reviews_average = array_sum($reviews_all) / 3 ;
		$review->overall_score = round($reviews_average, 1);
		$review->save();
		return redirect()->back()->with('success', 'Vielen Dank für Deine Bewertung!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
