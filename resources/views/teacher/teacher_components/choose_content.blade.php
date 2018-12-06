	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			@php 
			$contents = App\Content::where('topic_id', '=', $topic_id)->get();
			@endphp
			<section id="topic_contents">
				<div class="container-fluid my-4">
					Hier geht es um die Block-ID: {{$block->id}}
					<div class="row justify-content-start">
						@empty ($contents)
						<div>
							Bislang wurden noch keine Inhalte zu diesem Thema angelegt. Sag der ViSchool Bescheid und wir kümmern uns drum, versprochen!
							Button mit Mail an Vischool!
							
						</div>
						@endempty
						@foreach ($contents as $content)
							<div class="col">
								<div class="card m-3" style="width:200px">
									@isset ($content->content_img_thumb)
										<a href="/content/{{$content->id}}"><img class="card-img-top" src="/images/contents/{{$content->content_img}}" alt="Bild:{{$content->content_title}}"></img></a>
									@endisset
									@empty ($content->content_img_thumb) 
										@switch($content->tool_id)
											@case(1)
												<a href="/content/{{$content->id}}"><img class="card-img-top" src="https://img.youtube.com/vi/{{$content->toolspecific_id}}/mqdefault.jpg"></img></a>
											@break
											@default
											@isset ($content->portal->portal_img)
												<a href="/content/{{$content->id}}"><img class="card-img-top" src="/images/portals/{{$content->portal->portal_img}}"></img></a>
											@endisset
										@endswitch
									@endempty	
									<div class="card-body">
										<a href="/content/{{$content->id}}"><h4 class="card-title">{{$content->content_title}}</h4></a>
										<p class="card-text">			
											@php $rating = 1.3; @endphp  

            										@foreach(range(1,5) as $i)
                										<span class="fa-stack" style="width:1em"><i class="far fa-star fa-stack-1x"></i>
													@if($rating >0)
														@if($rating >0.5)
															<i class="fas fa-star fa-stack-1x"></i>
														@else
															<i class="fas fa-star-half fa-stack-1x"></i>
                        								@endif
													@endif
													@php $rating--; @endphp 
													</span>
												@endforeach
										</p>
									</div>
								
									<form method="POST" action="{{route('blocks.update',[$block->id])}}" enctype="multipart/form-data" id="selectContent_{{$block->id}}">
									{{ csrf_field() }} {{ method_field('PATCH') }}
	     								<div class="card-footer d-flex justify-content-between">
      										<small class="text-muted"><i class="{{$content->type->type_icon}} fa-2x"></i> {{$content->type->content_type}}</small>
      										<input type="hidden" value="{{$content->id}}" name="content_id"/>
											<input type="hidden" value="{{$contentnumber}}" name="contentnumber"/>
											<input type="hidden" value="{{$block->task}}" name="task"/>
											<input type="hidden" value="{{$block->title}}" name="title"/>
											<input type="hidden" value="{{$block->unit_id}}" name="unit_id"/>
											<button class="badge badge-pill bg-primary" type="submit" form="selectContent_{{$block->id}}" value="Submit">Submit</button>	
										</div>
									</form>
  								</div>
  							</div>
  						@endforeach	
  					</div>
				</div>
				<div class="modal-footer">
					
				</div>
			</section>
		</div>
	</div>	
