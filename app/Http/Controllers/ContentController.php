<?php

namespace App\Http\Controllers;

use App\Content;
use App\Topic;
use App\Subject;
use Illuminate\Http\Request;
use Image;
use App\Tag;
use App\Device;
use App\Tool;
use App\Portal;
use App\Type;
use App\Video;
use Youtube;
use Session;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responsede
     */
    public function index()
    {
    	$contents = Content::orderBy('created_at', 'desc')->paginate(10);
      $subjects = Subject::orderBy('subject_title','asc')->get();
      return view('/backend/index_contents', compact('contents','subjects'));
    }
    
    public function index_subject($id)
    {
    	$contents = Content::where('subject_id',$id)->orderBy('content_title', 'desc')->paginate(10);
        $currentSubject = Subject::find($id);
        $topics = $currentSubject->topics()->orderBy('topic_title','asc')->get();
        return view('/backend/index_contents_subjectfilter', compact('contents','topics','currentSubject'));
    }

	public function index_topic($subject,$topic)
    {
    	$contents = Content::where('topic_id',$topic)->orderBy('content_title', 'desc')->paginate(10);
        $currentTopic = Topic::find($topic);
        $currentSubject = Subject::find($subject);
        $topics = $currentSubject->topics()->orderBy('topic_title','asc')->get();
        return view('/backend/index_contents_topicfilter', compact('contents','currentTopic','currentSubject','topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::orderBy('subject_title', 'asc')->get();
        $topics = Topic::orderBy('topic_title', 'asc')->get();
        $tags = Tag::orderBy('tag_name','asc')->get();
        $devices = Device::all();
        $portals = Portal::orderBy('portal_title','asc')->get();
        $tools = Tool::all();
        $types = Type::all();
        return view('backend.create_contents', compact('subjects','topics','tags','devices','portals','tools','types') );

    }
     
    public function store(Request $request)
    {
        $this->validate(request(), [
        'topic_id' => 'required', 
        'subject_id' => 'required',
        'content_link'=> 'required|url',
        'content_img' => 'image',
        'content_duration' => 'required|Numeric',
        'license' => 'required',
        
        ]);
        $content =new Content;
        switch ($request->tool_id) {
        	case 1:
        		$content->toolspecific_id = Content::parse_yturl($request->content_link); //get Youtube ID
        		break;
        	case 7:
        		$vimeodata = Content::parse_vimeo($request->content_link);
        		$content->toolspecific_id = $vimeodata->video_id; //get Vimeo ID
        		break;
        	case 6:
        		$content->toolspecific_id = Content::parse_h5p($request->content_link);
        		break;
        	}
        $content->subject_id = request('subject_id');
        $content->topic_id = request('topic_id');
        $content->portal_id = request('portal_id');
        $content->content_link = request('content_link');
        $content->tool_id = request('tool_id');
        $content->license = request('license');
        $content->didactics_type = request('didactics_type');
        $content->how_to_analogue = request('how_to');
        $content->technical_limitations = request('technical_limitations');
        $content->type_id = request('type_id');
        $content->content_duration = request('content_duration');
        $content->content_title = request('content_title');
        
        
        //Save Image
		if ($request->hasFile('content_img')){
			$image = $request->file('content_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$filename_thumb = 'thumb'. $filename;
			//save big image
			$location = public_path('images/contents/'.$filename);
			Image::make($image)->resize(null, 400, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$content->content_img = $filename;
			//save thumb image
			$location_big = public_path('images/contents/'.$filename_thumb);
			Image::make($image)->resize(null, 200, function ($constraint) {
				$constraint->aspectRatio();})->save($location_big);
			$content->content_img_thumb = $filename_thumb;
		}
		
		//Save all data from create_topics form
       	$content->save(); 
       	if (isset($request->content_title)) {
        		$content->content_title = request('content_title');
        }
        elseif (
        	$content->content_title =$content->portal->portal_title . "-" . $content->topic->topic_title
        	)
        	$content->save();
        	
        	//save new tags and sync
        	if ($request->filled('tags')){
         	 $tags = Tag::syncTags($request);
         	 $content->tags()->sync($tags, false);
         } elseif (
        	$content->tags()->sync($request->tags, false)
        );
        $content->devices()->sync($request->devices, false);       	
       	
       	//get all Video-Data from youtube and save them in new Video object
       	if(($content->tool_id == 1) And isset($content->toolspecific_id)) {
       			$video_attributes = Youtube::getVideoInfo($content->toolspecific_id);
       			$video = new Video;
       			$video->content_id = $content->id;
       			$video->video_title = $video_attributes->snippet->title;
       			$video->video_description = $video_attributes->snippet->description;
       			$video->video_tags = serialize($video_attributes->snippet->tags);
       			if (isset($video_attributes->snippet->defaultAudioLanguage)) (
       				$video->video_audio_language = $video_attributes->snippet->defaultAudioLanguage
       			);
       			$video->video_duration = Video::convertDuration($video_attributes->contentDetails->duration);
       			$video->video_dimension = $video_attributes->contentDetails->dimension;
       			$video->video_definition = $video_attributes->contentDetails->definition;
       			$video->video_caption = $video_attributes->contentDetails->caption;
       			$video->video_YoutubePP = $video_attributes->contentDetails->licensedContent;
       			
       			$video->video_youtubeLicense = $video_attributes->status->license;
       			if(isset($video_attributes->player->embedHeight)){
       			$video->video_maxHeight = $video_attributes->player->embedHeight;
       			$video->video_maxWidth = $video_attributes->player->embedWidth;
       			} else {
       			$video->video_maxHeight = Video::getHeight($video_attributes->player->embedHtml);
       			$video->video_maxWidth = Video::getWidth($video_attributes->player->embedHtml);
       			};
       			$video->save();
       			$content->content_duration = ceil($video->video_duration/60);
       			$content->save();

       	};  
       	//        		Vimeo Daten speichern	
       	if ($content->tool_id == 7) {
       			$video = new Video;
       			$video->content_id = $content->id;
       			
       			$video->video_title = $vimeodata->title;
       			$video->video_description = $vimeodata->description;
       			$video->video_duration = $vimeodata->duration;
       			$video->video_maxHeight = $vimeodata->height;
       			$video->video_maxWidth = $vimeodata->width;
       			$video->save();
       			
    ;
       			if (empty($content->content_img_thumb)) {
       				$content->img_thumb_url = $vimeodata->thumbnail_url;
       			}
       			$content->content_duration = ceil($video->video_duration/60);
       			$content->save();
       	}	
       	
       	//return to overview of contents
        return redirect('backend/contents');
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = Content::find($id);
        $subjects = Subject::where('id','!=',$content->subject_id)->orderBy('subject_title','asc')->get();
        $tools = Tool::where('id','!=',$content->tool_id)->orderBy('tool_title','asc')->get();

        $currentSubject = $content->subject;
        $tags = Tag::orderBy('tag_name','asc')->get();
        $devices = Device::all();
        $portals = Portal::orderBy('portal_title','asc')->get();
        $types = Type::all();
        return view ('backend.show_contents', compact('content','subjects','tags','devices','currentSubject','tools','portals','types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $this->validate(request(), [
        'topic_id' => 'required', 
        'subject_id' => 'required',
        'content_link'=> 'required|url',
        'content_duration' => 'required|Numeric',
        'license' => 'required',
        'content_img' => 'image',
        'type_id' => 'required'
        
        ]);
        $content = Content::findOrFail($id);
        $content->subject_id = request('subject_id');
        $content->topic_id = request('topic_id');
        $content->portal_id = request('portal_id');
        $content->content_link = request('content_link');
        $content->tool_id = request('tool_id');
        $content->license = request('license');
        $content->didactics_type = request('didactics_type');
        $content->content_duration = request('content_duration');
        $content->how_to_analogue = request('how_to');
        $content->technical_limitations = request('technical_limitations');
        $content->type_id = request('type_id');
        
        
        //Save Image
		if ($request->hasFile('content_img')){
			$image = $request->file('content_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$filename_thumb = 'thumb'. $filename;
			//save big image
			$location = public_path('images/contents/'.$filename);
			Image::make($image)->resize(null, 400, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$content->content_img = $filename;
			//save thumb image
			$location_big = public_path('images/contents/'.$filename_thumb);
			Image::make($image)->resize(null, 200, function ($constraint) {
				$constraint->aspectRatio();})->save($location_big);
			$content->content_img_thumb = $filename_thumb;
		}
		
		//Save all data from create_topics form
       	$content->save(); 
       	if (isset($request->content_title)) {
        		$content->content_title = request('content_title');
        }
        elseif (
        	$content->content_title =$content->portal->portal_title . "-" . $content->topic->topic_title
        	)
        	$content->save();
        	if ($request->filled('tags')){
         	 $tags = Tag::syncTags($request);
         	 $content->tags()->sync($tags);
         } elseif (
        	$content->tags()->sync($request->tags)
        );
        $content->devices()->sync($request->devices);
       	
       	//get toolspecific id
       	switch ($request->tool_id) {
        	case 1:
        		$content->toolspecific_id = Content::parse_yturl($request->content_link); //get Youtube ID
        		break;
        	case 7:
        		$vimeodata = Content::parse_vimeo($request->content_link);
        		$content->toolspecific_id = $vimeodata->video_id; //get Vimeo ID
        		break;
        	case 6:
        		$content->toolspecific_id = Content::parse_h5p($request->content_link);
        		break;
        	}       	
       	$content->save();
       	//get all Video-Data from youtube and save them in new Video object
       	if(($content->tool_id == 1) And isset($content->toolspecific_id)) {
       			$video_attributes = Youtube::getVideoInfo($content->toolspecific_id);
       			$video = Video::where('content_id' ,$content->id)->first();
       			if (empty($video)) 
       			{
       			$video = new Video;
       			$video->content_id = $content->id;
       			};
       			
       			$video->video_title = $video_attributes->snippet->title;
       			$video->video_description = $video_attributes->snippet->description;
       			$video->video_tags = serialize($video_attributes->snippet->tags);
       			if (isset($video_attributes->snippet->defaultAudioLanguage)) (
       				$video->video_audio_language = $video_attributes->snippet->defaultAudioLanguage
       			);
       			$video->video_duration = Video::convertDuration($video_attributes->contentDetails->duration);
       			$video->video_dimension = $video_attributes->contentDetails->dimension;
       			$video->video_definition = $video_attributes->contentDetails->definition;
       			$video->video_caption = $video_attributes->contentDetails->caption;
       			$video->video_YoutubePP = $video_attributes->contentDetails->licensedContent;
       			
       			$video->video_youtubeLicense = $video_attributes->status->license;
       			if(isset($video_attributes->player->embedHeight)){
       			$video->video_maxHeight = $video_attributes->player->embedHeight;
       			$video->video_maxWidth = $video_attributes->player->embedWidth;
       			} else {
       			$video->video_maxHeight = Video::getHeight($video_attributes->player->embedHtml);
       			$video->video_maxWidth = Video::getWidth($video_attributes->player->embedHtml);
       			};

       			$video->save();
       			
       			$content->content_duration = ceil($video->video_duration/60);
       			$content->save();
       	};
       	//return to overview of topics
        return redirect('backend/contents');

	}
	
	public function teacher_store(Request $request) 
	{
		
		$this->validate(request(), [
			'content_title' => 'required',
			'topic_id' => 'required', 
			'subject_id' => 'required',
			'content_link'=> 'required|url',
			'tool_id'=> 'required']);

        $content =new Content;
        switch ($request->tool_id) {
        	case 1: //youtube
        		$content->toolspecific_id = Content::parse_yturl($request->content_link); //get Youtube ID
				$content->type_id = 1;
				break;
			case 2: //kahoot
        		$content->toolspecific_id = Content::parse_kahoot($request->content_link); //get Kahoot ID
				$content->type_id = 2;
				break;
			case 3: //powtoon
        		$content->toolspecific_id = Content::parse_powtoon($request->content_link); //get Powtoon ID
				$content->type_id = 1;
				break;
			case 4: //any
				$content->type_id = 7;
				break;
			case 5: //PDF
				$content->type_id = 4;
				break;
			case 6: //h5p
        		$content->toolspecific_id = Content::parse_h5p($request->content_link);
				$content->type_id = 7;  
				  break;
			case 7: //vimeo
        		$vimeodata = Content::parse_vimeo($request->content_link);
        		$content->toolspecific_id = $vimeodata->video_id; //get Vimeo ID
				$content->type_id = 1;  
				break;
			case 8: //geogebra
				$content->type_id = 7;
				break;
			case 10: //h5p moodle
				$content->toolspecific_id = Content::parse_h5p_moodle($request->content_link);
				$content->type_id = 7;
				break;
        	}
		$content->user_id = request('user_id');
		$content->subject_id = request('subject_id');
        $content->topic_id = request('topic_id');
        $content->content_link = request('content_link');
        $content->tool_id = request('tool_id');
		$content->content_title = request('content_title');
		$content->license = "unbekannt";
		if($request->teacherOrStudent == "teacher") {
			$content->status_id = 3;
		}
		else {
			$content->status_id = 5;
		}
        
        
		
		//Save all data from create_topics form
       	$content->save(); 
       	
       	//get all Video-Data from youtube and save them in new Video object
       	if(($content->tool_id == 1) And isset($content->toolspecific_id)) {
       			$video_attributes = Youtube::getVideoInfo($content->toolspecific_id);
       			$video = new Video;
       			$video->content_id = $content->id;
       			$video->video_title = $video_attributes->snippet->title;
       			$video->video_description = $video_attributes->snippet->description;
       			$video->video_tags = serialize($video_attributes->snippet->tags);
       			if (isset($video_attributes->snippet->defaultAudioLanguage)) (
       				$video->video_audio_language = $video_attributes->snippet->defaultAudioLanguage
       			);
       			$video->video_duration = Video::convertDuration($video_attributes->contentDetails->duration);
       			$video->video_dimension = $video_attributes->contentDetails->dimension;
       			$video->video_definition = $video_attributes->contentDetails->definition;
       			$video->video_caption = $video_attributes->contentDetails->caption;
       			$video->video_YoutubePP = $video_attributes->contentDetails->licensedContent;
       			
       			$video->video_youtubeLicense = $video_attributes->status->license;
       			if(isset($video_attributes->player->embedHeight)){
       			$video->video_maxHeight = $video_attributes->player->embedHeight;
       			$video->video_maxWidth = $video_attributes->player->embedWidth;
       			} else {
       			$video->video_maxHeight = Video::getHeight($video_attributes->player->embedHtml);
       			$video->video_maxWidth = Video::getWidth($video_attributes->player->embedHtml);
       			};
       			$video->save();
       			$content->content_duration = ceil($video->video_duration/60);
       			$content->save();

       	};  
       	//        		Vimeo Daten speichern	
       	if ($content->tool_id == 7) {
       			$video = new Video;
       			$video->content_id = $content->id;
       			
       			$video->video_title = $vimeodata->title;
       			$video->video_description = $vimeodata->description;
       			$video->video_duration = $vimeodata->duration;
       			$video->video_maxHeight = $vimeodata->height;
       			$video->video_maxWidth = $vimeodata->width;
       			$video->save();
       			
    ;
       			if (empty($content->content_img_thumb)) {
       				$content->img_thumb_url = $vimeodata->thumbnail_url;
       			}
       			$content->content_duration = ceil($video->video_duration/60);
					$content->save();
					 
			}
			if (isset($request->instant)) {
				$instantContent = session(['content_title' => $content->content_title, 'content_id' => $content->id]);
				return redirect()->back()->withInput($request->session()->all());
			}
       	else {
       	//return to overview of contents
		  return redirect()->back();
		  }
    }
	
	//als privaten Inhalt veröffentlichen
	public function teacherContentPrivate($id)
    {
        $content = Content::findOrFail($id);
        $content->status_id = 3;
        $content->save();	
       	//return to overview of topics
        return redirect('lehrer/inhalte');
    }

    //An ViSChool zur Freigabe schicken - vom Lehrer erstelltes Thema
    public function teacherContentViSchool($id)
    {
        $content = Content::findOrFail($id);
        $content->status_id = 2;
        $content->save();	
       	//return to overview of topics
        return redirect('lehrer/inhalte');
    }

    //ViSchool Admin gibt Thema frei
    public function teacherContentApprove($id)
    {
        $content = Content::findOrFail($id);
        $content->status_id = 1;
        $content->save();	
       	//return to overview of topics
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$content = Content::find($id);
    	$content->tags()->detach();
    	$content->devices()->detach();
    	$content->delete();
    	
    	return redirect('backend/contents');
    }
    
    
}
