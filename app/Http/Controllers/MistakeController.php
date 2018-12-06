<?php

namespace App\Http\Controllers;

use App\Mistake;
use Illuminate\Http\Request;

class MistakeController extends Controller
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
		'type' => 'required',
        ]);
		$mistake = new Mistake;
		$mistake->content_id = $request->mistake_content_id;
		$mistake->mistake_type = $request->type;
		$mistake->mistake_description = $request->mistake_description;
		$mistake->save();
		return redirect()->route('frontend.contents.show', [$mistake->content_id]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Mistake  $mistake
     * @return \Illuminate\Http\Response
     */
    public function show(Mistake $mistake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mistake  $mistake
     * @return \Illuminate\Http\Response
     */
    public function edit(Mistake $mistake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mistake  $mistake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mistake $mistake)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mistake  $mistake
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mistake $mistake)
    {
        //
    }
}
