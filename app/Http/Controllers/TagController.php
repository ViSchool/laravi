<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index() 
    {
        $tags = Tag::orderBy('tag_name','asc')->get();
        $taggroups = $tags->where('tag_group','!=','ohne')->unique('tag_group')->pluck('tag_group')->all();
        return view('/backend/tags', compact('tags','taggroups'));
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
        'tag_name' => 'required',
     ]);
        $tag = new Tag;
        $tag->tag_name = $request->tag_name;
        if ($request->tag_group == 'new') {
            $tag->tag_group = $request->new_tag_group;
        } else {
            $tag->tag_group = $request->tag_group;
        }
        $tag->save();
        return redirect('backend/tags');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        $tags = Tag::orderBy('tag_name','asc')->get();
        $taggroups = $tags->where('tag_group','!=','ohne')->where('tag_group','!=',$tag->tag_group)->unique('tag_group')->pluck('tag_group')->all();
        return view('backend/single_tag', compact('tag','taggroups'));
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
        'tag_name' => 'required',
     ]);
        $tag = Tag::find($id);
        $tag->tag_name = $request->tag_name;
        if ($request->tag_group == 'new') {
            $tag->tag_group = $request->new_tag_group;
        } else {
            $tag->tag_group = $request->tag_group;
        }
        $tag->save();
        return redirect('backend/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        {
		$tag = Tag::findOrFail($id);
		$tag->posts()->detach();
		$tag->contents()->detach();
		$tag->series()->detach();
		$tag->delete();
        return redirect('backend/tags');
    }
    }
}
