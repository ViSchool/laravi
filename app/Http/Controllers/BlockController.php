<?php

namespace App\Http\Controllers;

use App\Block;
use Illuminate\Http\Request;
use App\Unit;
use App\Content;
use App\Tool;
use App\Differentiation;
use Purifier;
use Auth;

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
    
    /* WIRD IM MOMENT NICHT MEHR GEBRAUCHT
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
    */
    public function teacher_store(Request $request)
    {
        $this->validate(request(), [
        'block_title' => 'required', 
        'task' => 'required',
        'time' => 'required'
        ]);
        
        $block = new Block;
        $block->title = $request->block_title;
        $block->task = Purifier::clean($request->task);
        $block->tips = Purifier::clean($request->tipp);
        if(isset($request->content_id)) {
            $block->content_id = $request->content_id;
        } else {
        $block->content_id = $request->chooseContent;
        };
        $block->time = $request->time;
        $block->unit_id = $request->unit_id;
        $unit = Unit::find($request->unit_id);
        //  if block ist created with differentiation, 
        if (isset($request->differentiation_id)) {
           
            if ($request->differentiation_id != 13) {
            $block->differentiation_id = $request->differentiation_id;
            $block->order = $unit->blocks->max('order') + 1;
            //get other differentiation_ids from the same group
            $currentDifferentiation = Differentiation::find($request->differentiation_id);
            $otherDifferentiations = Differentiation::where([
                ['differentiation_group',$currentDifferentiation->differentiation_group],
                ['id','!=',$currentDifferentiation->id]
            ])->get();
            //loop over all of them and make for each differentiation a copy of the first task
            foreach ($otherDifferentiations as $otherDifferentiation) {
                $newblock = $block->replicate();
                $newblock->differentiation_id = $otherDifferentiation->id;
                $newblock->push();
                }
            $block->save();
            } else {
                $block->differentiation_id = 13;
                $block->order = $unit->blocks->max('order') + 1;
                $block->save();
            } 
            
        } else {
            $block->differentiation_id = 13;
            $block->order = $unit->blocks->max('order') + 1;
            $block->save();
        }
        $block->save();
        
        return redirect()->route('teacher.unit.block', ['unit'=> $unit->id]);
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
    public function teacher_show($id)
    {
        $unit = Unit::find($id);
        return view('teacher.teacher_blocks', compact('unit'));
    }

    public function teacher_edit($id)
    {
        $block = Block::find($id);
        $teacher = Auth::user();
        $unit = $block->unit;
        $contents = Content::where('topic_id', $block->unit->topic_id)->get();
        $tools = Tool::orderBy('tool_title','asc')->get();
        
        $differentiations = Differentiation::where([
            ['user_id',$teacher->id],
            ['differentiation_group',$block->unit->differentiation_group]
        ])->get();
        return view('teacher.teacher_blocksEdit', compact('block','teacher','contents','differentiations','tools','unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    
    
    public function teacher_update(Request $request, $id)
    {
        $this->validate(request(), [
        'block_title' => 'required', 
        'task' => 'required',
        'differentiation_id'=> 'required',
        ]);
        $block = Block::findOrFail($id);
        $block->title = $request->block_title;
        $block->task = Purifier::clean($request->task);
        $block->tips = Purifier::clean($request->tipp);
        $block->content_id = $request->chooseContent;
        $block->time = $request->time;
        if ($block->differentiation_id !== $request->differentiation_id) {
            if ($block->differentiation_id == 13) {
            $block->differentiation_id = $request->differentiation_id;
            $block->save();
            //get other differentiation_ids from the same group
            $currentDifferentiation = Differentiation::find($block->differentiation_id);
            $otherDifferentiations = Differentiation::where([
                ['differentiation_group',$currentDifferentiation->differentiation_group],
                ['id','!=',$currentDifferentiation->id]
            ])->get();
            //loop over all of them and make for each differentiation a copy of the first task
            foreach ($otherDifferentiations as $otherDifferentiation) {
                $newblock = $block->replicate();
                $newblock->differentiation_id = $otherDifferentiation->id;
                $newblock->push();
                }
            $block->save();
            
            } else {
            //get other blocks of the same differentiation_group
            $currentDifferentiation = Differentiation::find($block->differentiation_id);
            $otherDifferentiations = Differentiation::where([
                ['differentiation_group',$currentDifferentiation->differentiation_group],
                ['id','!=',$currentDifferentiation->id]
            ])->pluck('id');
            $otherBlocks = Block::where('unit_id',$block->unit_id)->whereIn('differentiation_id',$otherDifferentiations)->get();
            //loop over all of them and delete the others
            foreach ($otherBlocks as $otherBlock) {
                $otherBlock->delete();
            }
            $block->differentiation_id = $request->differentiation_id;
            $block->save();
            }
       }    
        
        return redirect()->route('teacher.unit.block',['unit' => $block->unit_id]);
    }
    
    
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
    public function teacher_destroy($id)
    {
        $block = Block::findOrFail($id);
        $otherDifferentiationBlocks = Block::where('unit_id',$block->unit_id)->where('order',$block->order)->get();
        foreach($otherDifferentiationBlocks as $otherDifferentiationBlock) {
            $otherDifferentiationBlock->delete();
        }
        $block->delete();
        return redirect()->back();
    }
}
