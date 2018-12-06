<?php

namespace App\Http\Controllers;

use App\Block;
use Illuminate\Http\Request;
use App\Unit;
use Purifier;

class BlockController extends Controller
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
        'title' => 'required', 
        'task' => 'required',
        'differentiation'=> 'required',
        ]);
        $block = new Block;
        $block->title = $request->title;
        $block->task = Purifier::clean($request->task);
        $block->time = $request->time;
        $block->unit_id = $request->unit_id;
        $unit = Unit::find($request->unit_id);
        $block->order = $unit->blocks->max('order') + 1;
        $block->differentiation = $request->differentiation;
        $block->save();
        
        return redirect()->route('unit.edit',[$block->unit_id]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$this->validate(request(), [
        'title' => 'required', 
        'task' => 'required',
        ]);
/*         dd($request); */
        $block = Block::findOrFail($id);
        $block->title = $request->title;
        $block->task = Purifier::clean($request->task);
        $block->time = $request->time;
        $block->unit_id = $request->unit_id;
        switch ($request->contentnumber) {
        case 1:
        	$block->content_id1 = $request->content_id;
        	$block->specialcontent1 = Purifier::clean($request->specialcontent);
        	break;
        case 2:
        $block->content_id2 = $request->content_id;
        $block->specialcontent2 = Purifier::clean($request->specialcontent);
        break;
        case 3:
        $block->content_id3 = $request->content_id;
     	$block->specialcontent3 = Purifier::clean($request->specialcontent);
     	break;
        default:
        break;
        }
/*         dd($block); */
        $block->save();
        
        return redirect()->route('unit.edit',[$block->unit_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $block = Block::findOrFail($id);
        $unit_id =$block->unit_id;
        $block->delete();
        return redirect()->route('unit.edit',[$unit_id]);
    }
}
