<?php

namespace App\Http\Controllers;

use App\Portal;
use App\Subject;
use Purifier;
use Illuminate\Http\Request;
use Image;
use App\Type;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portals = Portal::orderBy('portal_title','asc')->paginate(10);
        return view ('backend.index_portals',compact ('portals'));
    }

    public function index_frontend()
    {
        $portals = Portal::orderBy('portal_title','asc')->get();
        $subjects = Subject::all();
        $types = Type::all();
        $prices = $portals->unique('price_model')->pluck('price_model');        return view ('frontend.portals.portals',compact ('portals','subjects','types','prices'));
    }

    public function index_frontend_filtered(Request $request)
    {
        // dd($request);
        if($request->has('subjects')) {
            $subjects = Subject::whereIn('id',$request->subjects)->get();
            $filter_subjects = 1;
        } else {
            $subjects = Subject::all();
            $filter_subjects = 0;
            
        }
        if($request->has('types')) {
            $types = Type::whereIn('id',$request->types)->get();
            $filter_types = 1;
        } else {
            $types = Type::all();
            $filter_types = 0;
        }
        
        if($request->has('prices')) {
            $prices = $request->prices;
            $filter_prices = 1;
        } else {
            $prices = Portal::all()->unique('price_model')->pluck('price_model'); 
            $filter_prices = 0;
        }

        $merged_subject = collect();
        $merged_type = collect();
        $merged_price = collect();

        foreach ($subjects as $subject) {
            $portals_subject = $subject->portals()->get();
            $merged_subject = $portals_subject->merge($merged_subject);
        }
        foreach ($types as $type) {
            $portals_type = $type->portals()->get();
            $merged_type = $portals_type->merge($merged_type);
        }
        $portals_price = Portal::whereIn('price_model',$prices)->get();

        $portals_step01 = $merged_type->intersect($merged_subject);
        $portals = $portals_step01->intersect($portals_price);
        
        return view ('frontend.portals.portals_filtered',compact ('portals','subjects','types','prices','filter_subjects','filter_types','filter_prices'));

        
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $types = Type::all();
        return view ('backend.create_portals', compact('subjects','types'));
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
        'portal_title' => 'required',
        'portal_url' => 'url',
        'portal_img' => 'image' 
        
        ]);
        $portal =new Portal;
        $portal->portal_title = request('portal_title');
        $portal->portal_description = Purifier::clean($request->portal_description);
        $portal->portal_url = request('portal_url');
        $portal->price_model = request('price_model');
        
                
        //Save Image
		if ($request->hasFile('portal_img')){
			$image = $request->file('portal_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$filename_thumb = 'thumb'. $filename;
			//save big image
			$location = public_path('images/portals/'.$filename);
			Image::make($image)->resize(null, 200, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$portal->portal_img = $filename;
			//save thumb image
			$location_big = public_path('images/portals/'.$filename_thumb);
			Image::make($image)->resize(null, 50, function ($constraint) {
				$constraint->aspectRatio();})->save($location_big);
			$portal->portal_img_thumb = $filename_thumb;
		};
		
		//Save all data from create_topics form
       	$portal->save(); 
       	$portal->subjects()->sync($request->subjects, false);
       	$portal->types()->sync($request->content_types, false);
       	
       	
       	//return to overview of topics
        return redirect('backend/portals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Portal  $portal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portal = Portal::find($id);
        $types = Type::all();
        $subjects = Subject::all();
        return view ('backend.show_portals', compact ('portal','subjects','types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portal  $portal
     * @return \Illuminate\Http\Response
     */
    public function edit(Portal $portal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portal  $portal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
        'portal_title' => 'required',
        'portal_url' => 'url',
        'portal_img' => 'image' 
        
        ]);
        $portal =Portal::find($id);
        $portal->portal_title = request('portal_title');
        $portal->portal_description = Purifier::clean($request->portal_description);
        $portal->portal_url = request('portal_url');
        $portal->price_model = request('price_model');
        
                
        //Save Image
		if ($request->hasFile('portal_img')){
			$image = $request->file('portal_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$filename_thumb = 'thumb'. $filename;
			//save big image
			$location = public_path('images/portals/'.$filename);
			Image::make($image)->resize(null, 200, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$portal->portal_img = $filename;
			//save thumb image
			$location_big = public_path('images/portals/'.$filename_thumb);
			Image::make($image)->resize(null, 50, function ($constraint) {
				$constraint->aspectRatio();})->save($location_big);
			$portal->portal_img_thumb = $filename_thumb;
		};
		
		//Save all data from create_portals form
       	$portal->save(); 
       	$portal->subjects()->sync($request->subjects);
       	$portal->types()->sync($request->content_types);
       	
       	
       	//return to overview of topics
        return redirect('backend/portals');
    }

    /**
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portal  $portal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portal = Portal::findOrFail($id);
        $portal->subjects()->detach();
        $portal->types()->detach();
        $portal->delete();
        return redirect('backend/portals');
    }
}
