<?php

namespace App\Http\Controllers;

use App\Tool;
use App\Device;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tools = Tool::orderBy('tool_title','asc')->paginate(8);
        return view('backend.index_tools' , compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $devices = Device::all();
        return view('backend.create_tools', compact ('devices'));
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
        'tool_title' => 'required', 
        'privacy_score' => 'required',
        
        ]);
        $tool =new Tool;
        $tool->tool_title = request('tool_title');
        $tool->tool_description = request('tool_description');
        $tool->embed_code = request('embed_code');
        $tool->technical_requirements = request('technical_requirements');
        $tool->price_model = request('price_model');
        $tool->registration_for_create = request('registration_for_create');
        $tool->registration_for_use = request('registration_for_use');
        $tool->url_creation = request('url_creation');
        $tool->url_use = request('url_use');
        $tool->privacy_score = request('privacy_score');
        $tool->privacy_description = request('privacy_description');
        $tool->tutorials = request('tutorials');
        $tool->didactics = request('didactics');
        $tool->tool_owner = request('tool_owner');
        
                
        //Save Image
		if ($request->hasFile('tool_img')){
			$image = $request->file('tool_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$filename_thumb = 'thumb'. $filename;
			//save big image
			$location = public_path('images/tools/'.$filename);
			Image::make($image)->resize(null, 200, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$tool->tool_img = $filename;
			//save thumb image
			$location_big = public_path('images/tools/'.$filename_thumb);
			Image::make($image)->resize(null, 50, function ($constraint) {
				$constraint->aspectRatio();})->save($location_big);
			$tool->tool_img_thumb = $filename_thumb;
		};
		
		//Save all data from create_topics form
       	$tool->save(); 
       	$tool->devices()->sync($request->devices, false);
       	
       	
       	//return to overview of topics
        return redirect('backend/tools');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tool = Tool::find($id);
        $devices = Device::all();
        return view ('backend.show_tools', compact('tool','devices') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function edit(Tool $tool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
        'tool_title' => 'required', 
        'privacy_score' => 'required',
        
        ]);
        $tool = Tool::findOrFail($id);
        $tool->tool_title = request('tool_title');
        $tool->tool_description = request('tool_description');
        $tool->embed_code = request('embed_code');
        $tool->technical_requirements = request('technical_requirements');
        $tool->price_model = request('price_model');
        $tool->registration_for_create = request('registration_for_create');
        $tool->registration_for_use = request('registration_for_use');
        $tool->url_creation = request('url_creation');
        $tool->url_use = request('url_use');
        $tool->privacy_score = request('privacy_score');
        $tool->privacy_description = request('privacy_description');
        $tool->tutorials = request('tutorials');
        $tool->didactics = request('didactics');
        $tool->tool_owner = request('tool_owner');
        
                
        //Save Image
		if ($request->hasFile('tool_img')){
			$image = $request->file('tool_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$filename_thumb = 'thumb'. $filename;
			//save big image
			$location = public_path('images/tools/'.$filename);
			Image::make($image)->resize(null, 200, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$tool->tool_img = $filename;
			//save thumb image
			$location_big = public_path('images/tools/'.$filename_thumb);
			Image::make($image)->resize(null, 50, function ($constraint) {
				$constraint->aspectRatio();})->save($location_big);
			$tool->tool_img_thumb = $filename_thumb;
		};
		
		//Save all data from create_topics form
       	$tool->save(); 
       	$tool->devices()->sync($request->devices);
       	
       	
       	//return to overview of topics
        return redirect('backend/tools');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tool = Tool::findOrFail($id);
		$tool->devices()->detach();	
		$tool->delete();
        return redirect('backend/tools');
    }
}
