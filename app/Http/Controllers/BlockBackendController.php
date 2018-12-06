<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Block;
use App\Content;
use App\Topic;
use App\Differentiation;
use Purifier;
use Validator;

class BlockBackendController extends Controller
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
    public function create_step1($id)
    {
    	$unit = Unit::find($id);
    	$differentiations = Differentiation::where('user_id', null)->get();
    	return view('backend.create_blocks_step1', compact('unit','differentiations') );

    }

	public function create_step2($id)
    {
    	$block = Block::find($id);
    	$unit = Unit::find($block->unit_id);
    	$contents = Content::where('topic_id',$unit->topic_id)->get();
    	$topics = Topic::where('id','!=',$unit->topic_id)->get();
    	return view('backend.create_blocks_step2', compact('block','unit','contents','topics'));
    }

	public function create_step3($id)
    {
    	$block = Block::find($id);
    	$unit = Unit::find($block->unit_id);
    	$contents = Content::where('topic_id',$unit->topic_id)->get();
    	$topics = Topic::where('id','!=',$unit->topic_id)->get();
    	return view('backend.create_blocks_step3', compact('block','unit','contents','topics'));
    }

public function create_step4($id)
    {
    	$block = Block::find($id);
    	$unit = Unit::find($block->unit_id);
    	$contents = Content::where('topic_id',$unit->topic_id)->get();
    	$topics = Topic::where('id','!=',$unit->topic_id)->get();
    	return view('backend.create_blocks_step4', compact('block','unit','contents','topics'));
    }

public function store(Request $request)
    {


     /* Store a newly created resource in storage.
      @param  \Illuminate\Http\Request  $request*/
    	$this->validate(request(), [
        'title' => 'required',
        'time'=> 'required', 
        ]);
        $block = new Block;
        	if ($request->alternative != "keine") {
        		$blockAlternative = Block::findOrFail($request->alternative);
        		$block->order = $blockAlternative->order;
        		$block->alternative = $blockAlternative->id;
        	}
        	else {
        	$unit = Unit::find($request->unit_id);
        $block->order = $unit->blocks->max('order') + 1;
        	}
        $block->title = $request->title;
        $block->time = $request->time;
        $block->unit_id = $request->unit_id;
        
        	
        	$block->differentiation_id = $request->differentiation;
        $block->save();
        
        return redirect()->route('backend.blocks.create_step2',[$block->id]);
    }

public function store_contents(Request $request, $id)
    {
    	$this->validate(request(), [
        ]);
        $block = Block::find($id);
        $block->save();
        
        return redirect()->route('backend.blocks.show',[$block->id]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $block = Block::find($id);
        	if($block->alternative != NULL) {
        		$blockAlternative = Block::find($block->alternative);
        	}
        $unit = Unit::find($block->unit_id);
        $content = Content::find($block->content_id);
		$differentiations = Differentiation::where('user_id',null)->get();
		
        return view ('backend.show_blocks', compact('block','unit','content', 'ordernumber','differentiations','blockAlternative'));
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
        $this->validate(request(), [
        'title' => 'required', 
        ]);
        $block = Block::find($id);
        	if ($request->alternative != "keine") {
        		$blockAlternative = Block::findOrFail($request->alternative);
        		$block->order = $blockAlternative->order;
        		$block->alternative = $blockAlternative->id;
        	}
        $block->title = $request->title;
        $block->time = $request->time;
        $block->unit_id = $request->unit_id;
        $block->differentiation_id = $request->differentiation;
        $block->save();
        
        return redirect()->route('backend.units.show',[$block->unit_id]);
    }

public function update_contents(Request $request, $id)
    {
        $block = Block::find($id);
        if ($request->content_id == 'diftopic') {
			$block->content_id = $request->content_id_dif;
			} else{
        		$block->content_id = $request->content_id;
        }
        $block->task = Purifier::clean($request->task);
// If Contents are included set time to max of all content times
		if (isset($block->content_id)) {
			$content = Content::find($block->content_id);
			$block->time = $content->content_duration;
		}
		$block->save();
        return redirect()->route('backend.blocks.create_step4',[$block->id]);
    }
    
    /* public function update_differentiation(Request $request, $id)
    {
		$differentiation = 0;
		if(isset ($request->content_id3)) {
			$differentiation = 3;
		} elseif (isset ($request->task3)) {
			$differentiation = 3;
		} elseif (isset($request->content_id2)) {
			$differentiation =2;
		} elseif (isset($request->task2)) {
			$differentiation = 2;
		} else {
			$differentiation = 1;
		}
       	$v = Validator::make($request->all(), [
        'content_id1' => 'required_without:task1',
        'task1' => 'required_without:content_id1',
        ]);
        $v->sometimes('task2', 'nullable|required_without:content_id2', function ($differentiation) {
       return $differentiation === 2;
       });
       $v->sometimes('task3','nullable|required_without:content_id3', function($differentiation) {
       return $differentiation === 3;
       });
        $v->sometimes('content_id2','required_without:task2', function($differentiation) {
       return $differentiation === 2;
       });
       $v->sometimes('content_id3','required_without:task3', function($differentiation) {
        return $differentiation === 3;
       })->validate();
        
        
        $block = Block::find($id);
        $block->differentiation = $differentiation;
        if ($request->content_id1 == 'diftopic') {
			$block->content_id1 = $request->content_id_dif;
			} else{
        		$block->content_id1 = $request->content_id1;
        }
        $block->differentiation_name1 =$request->differentiation_name1;
        $block->task1 = Purifier::clean($request->task1);
        $block->content_id2 = $request->content_id2;
        $block->differentiation_name2 =$request->differentiation_name2;
        $block->task2 = Purifier::clean($request->task2);
        $block->content_id3 = $request->content_id3;
        $block->differentiation_name3 =$request->differentiation_name3;
        $block->task3 = Purifier::clean($request->task3);
        $block->tips = Purifier::clean($request->tips);
// If Contents are included set time to max of all content times
		if (isset($block->content_id1)) {
			$content1 = Content::find($block->content_id1);
			$block->time = $content1->content_duration;
		}
		if (isset($block->content_id2)) {
			$content2 = Content::find($block->content_id2);
			$block->time = max($content1->content_duration, $content2->content_duration);
		}
		if (isset($block->content_id3)) {
			$content3 = Content::find($block->content_id3);
			$block->time = max($content1->content_duration , $content2->content_duration , $content3->content_duration);
		}
        $block->save();
        return redirect()->route('backend.units.show',[$block->unit_id]);
    } */
    
    public function update_tipp(Request $request, $id)
    {
        $this->validate(request(), [
        'tipp' => 'required',
        ]);
        $block = Block::find($id);
        $block->tips = Purifier::clean($request->tipp);
        $block->save();
        return redirect()->route('backend.units.show',[$block->unit_id]);
    }

	public function update_orderup($id)
    {
        $blockorder_temp = 0;
        	//find the sorted block
        $block_sorted = Block::FindOrFail($id); 
        	//Check if there are other blocks with the same unit and order	
        	$alternativeBlocks_sorted = Block::where([
        		['unit_id',$block_sorted->unit_id],
        		['order',$block_sorted->order],
        		['id','!=',$block_sorted->id],
        	])->get(); 
        	 //search for the previous order in the same unit
        $block_previous_order = Block::where ([
        		['order','<', $block_sorted->order],
        		['unit_id',$block_sorted->unit_id],
        ])->max('order');
        	// get the first block with the previous order
        $block_previous = Block::where([
        		['order', $block_previous_order],
        		['unit_id',$block_sorted->unit_id],
        ])->first(); 
        	//get all blocks with the same unit and order as the previous one
        	$alternativeBlocks_previous = Block::where([
        		['unit_id',$block_previous->unit_id],
        		['order',$block_previous->order],
        		['id','!=',$block_previous->id],
        	])->get(); 
        	//Exchange order
        $blockorder_temp = $block_sorted->order;
        $block_sorted->order = $block_previous->order;
        $block_previous->order = $blockorder_temp; 
        $block_sorted->save();
        	// save all alternative blocks if sorted had alternatives
        	if($alternativeBlocks_sorted != NULL){
        		foreach ($alternativeBlocks_sorted as $alternativeBlock_sorted){
        			$alternativeBlock_sorted->order = $block_sorted->order;
        			$alternativeBlock_sorted->save();
        		}
        	} 
        $block_previous->save();
        	// save all alternative blocks if previous had alternatives
        	if($alternativeBlocks_previous != NULL){
        		foreach ($alternativeBlocks_previous as $alternativeBlock_previous){
        			$alternativeBlock_previous->order = $block_previous->order;
        			$alternativeBlock_previous->save();
        		}
        	} 
        return redirect()->route('backend.units.show',[$block_sorted->unit_id]);
    }

public function update_orderdown($id)
    {
        $blockorder_temp = 0;
        $block_sorted = Block::FindOrFail($id);
        	$alternativeBlocks_sorted = Block::where([
        		['unit_id',$block_sorted->unit_id],
        		['order',$block_sorted->order],
        		['id','!=',$block_sorted->id],
        	])->get();
        $block_next_order = Block::where([
        		['order','>', $block_sorted->order],
        		['unit_id',$block_sorted->unit_id],
        ])->min('order');
        	$block_next = Block::where([
        		['order',$block_next_order],
        		['unit_id',$block_sorted->unit_id],
        	])->first();
        	$alternativeBlocks_next = Block::where([
        		['unit_id',$block_next->unit_id],
        		['order',$block_next->order],
        		['id','!=',$block_next->id],
        	])->get();
        	$blockorder_temp = $block_sorted->order;
        $block_sorted->order = $block_next->order;
        $block_next->order = $blockorder_temp;
        $block_sorted->save();
        	if($alternativeBlocks_sorted != NULL){
        		foreach ($alternativeBlocks_sorted as $alternativeBlock_sorted){
        			$alternativeBlock_sorted->order = $block_sorted->order;
        			$alternativeBlock_sorted->save();
        		}
        	}
        	
        $block_next->save();
        	
        	if($alternativeBlocks_next != NULL){
        		foreach ($alternativeBlocks_next as $alternativeBlock_next){
        			$alternativeBlock_next->order = $block_next->order;
        			$alternativeBlock_next->save();
        		}
        	}
        return redirect()->route('backend.units.show',[$block_sorted->unit_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $block = Block::findOrFail($id);
        $unit_id =$block->unit_id;
        $block->delete();
        return redirect()->route('backend.units.show',[$unit_id]);
    }
}
