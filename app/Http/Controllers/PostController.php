<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Illuminate\Http\Request;
use Purifier;
use Image;
use Storage;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view ('backend.index_posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('backend.create_posts' , compact('tags'));
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
        'post_title' => 'required',
        'post_body' =>'required',
        'post_img' => 'sometimes|image'
        ]);
        $post = new Post;
        $admin = \App\Admin::get_current_admin();
        $post->post_title = $request->post_title;
        $post->post_body = Purifier::clean($request->post_body);
        $post->admin_id = $admin->id;
        
        if ($request->hasFile('post_img')) {
			$image = $request->file('post_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			
			$location = public_path('/images/posts/'.$filename);
			Image::make($image)->resize(null, 600, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$post->post_img = $filename;
        }
        
         $post->save();
         if ($request->filled('tags')){
         	 $tags = Tag::syncTags($request);
         	 $post->tags()->sync($tags, false);
         }
        else {
        	$post->tags()->sync($request->tags, false);
        };

        
        return redirect(route('backend.blog.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        return view ('backend.show_posts')->withPost($post)->withTags($tags);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
        'post_title' => 'required',
        'post_body' =>'required',
        'post_img' => 'sometimes|image'
        ]);
        
        $post = Post::find($id);
        $admin = \App\Admin::get_current_admin();
        $post->post_title = $request->post_title;
        $post->post_body = Purifier::clean($request->post_body);
        $post->admin_id = $admin->id;
         
         if ($request->hasFile('post_img')) {
         	$image = $request->file('post_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$location = public_path('/images/posts/'.$filename);
			Image::make($image)->resize(null, 600, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$oldFilename = $post->post_img;
	
			$post->post_img = $filename;
			Storage::delete('/images/posts/' . $oldFilename);
        		};
        $post->save();
        if ($request->filled('tags')){
         	 $tags = Tag::syncTags($request);
         	 $post->tags()->sync($tags );
         }
        else {
        	$post->tags()->sync($request->tags);
        };
        return redirect(route('backend.blog.index'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
		$post->delete();
        return redirect('backend/blog');
    }
    
    public function index_frontend() 
    {
    	$posts = Post::orderBy('created_at', 'desc')->get();
    	return view ('frontend/posts/index_posts' , compact ('posts'));
    }
    public function tag_frontend($id) 
    {
    	$tag = Tag::find($id);
    	return view ('frontend/posts/tags_posts' , compact ('tag'));
    }
    
    public function show_frontend($id) 
    {
    	$post = Post::find($id);
    	return view ('/frontend/posts/show_post' , compact ('post'));
    }
}
