<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Featured;
use App\Serie;
use App\Unit;


class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feature_01=Featured::first();
        $feature_02=Featured::skip(1)->take(1)->first();
        $feature_03=Featured::skip(2)->take(1)->first();
        $series = Serie::where('status_id', 1)->get();
        $units = Unit::where('status_id', 1)->get();
        return view ('backend.index_features', compact('feature_01','feature_02','feature_03','series','units'));
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
        'feature1' => 'required',
        'feature2' =>'required',
        'feature3' =>'required'
        ]);
        
        Featured::truncate();
        $feature_01 = new Featured;
        $request_explode1 = explode('|', $request->feature1);
        if($request_explode1[0] == 'serie') {
            $feature_01->serie_id = $request_explode1[1];
        } else {
            $feature_01->unit_id = $request_explode1[1];
        }
        $feature_01->save();

        $feature_02 = new Featured;
        $request_explode2 = explode('|', $request->feature2);
        if($request_explode2[0] == 'serie') {
            $feature_02->serie_id = $request_explode2[1];
        } else {
            $feature_02->unit_id = $request_explode2[1];
        }
        $feature_02->save();

        $feature_03 = new Featured;
        $request_explode3 = explode('|', $request->feature3);
        if($request_explode3[0] == 'serie') {
            $feature_03->serie_id = $request_explode3[1];
        } else {
            $feature_03->unit_id = $request_explode3[1];
        }
        $feature_03->save();

        return redirect()->route('admin.dashboard');
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
    public function destroy()
    {
        Featured::truncate();
        return redirect()->route('admin.dashboard');
    }
}
