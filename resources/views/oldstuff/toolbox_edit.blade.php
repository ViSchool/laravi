@extends('layout_teacher')

@section('stylesheets')
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection
		
@section ('page-header')

	<section id="page-header">
	<div class="container-fluid ml-4 p-4">
		<h4>Unterrichtseinheiten erstellen</h4>
		
	</div>
	
	</section>
@endsection
		
@section ('content')
<div class="container mt-5">
	<div class="alert alert-warning d-md-none d-lg-none">
			<p class="lead">Die Toolbox zum Erstellen eigener Unterrichtseinheiten ist für die Benutzung mit Tablets oder größeren Bildschirmen konzipiert. Die Toolbox funktioniert deshalb nicht auf dem Smartphone.</p>
		</div>
			
		<h4 style="color:#03c4eb;" class="text-uppercase">Titel der Lerneinheit: {{$unit->unit_title}}</h4>	
			
		<!-- Tabs für Schüler-/Lehrersicht -->
		<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="schueler-tab" data-toggle="tab" href="#schueler" role="tab" aria-controls="schueler" aria-selected="true">Schülersicht</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="lehrer-tab" data-toggle="tab" href="#lehrer" role="tab" aria-controls="lehrer" aria-selected="false">Lehrersicht</a>	
			</li>
		</ul>
		
		<div class="tab-content" id="myTabContent">
			
		<!-- Tabinhalt Schüler -->
			 <div class="tab-pane fade show active" id="schueler" role="tabpanel" aria-labelledby="schueler-tab">
				<div id="accordion" role="tablist">
					<div class="card">
						<!-- CardHeader1 -->
						<div class="card-header text-white" role="tab" id="start_block" style="background-color:#03c4eb">
							<div class="row">
								<div class="col">
									<h3 class="pt-2 font-weight-bold" style="color:#ff3333;">Das wirst Du heute machen:</h3>
									<p>{{$unit->unit_description}}</p>
								</div>
							</div>
						</div>
					</div>
						
					@foreach ($unit->blocks as $block)
					<!-- Block1 -->		
					
					<form method="POST" action="{{route('blocks.update',[$block->id])}}" enctype="multipart/form-data" id="blockheader_{{$block->id}}">
					{{ csrf_field() }} {{ method_field('PATCH') }}
			
					<div class="card my-1" style="border-color:#03c4eb">
						<!-- CardHeader1 -->
						<div class="card-header text-white" role="tab" style="background-image: url('/images/banner.jpg')">
							<div class="row">
								<div class="col-8">	
									<h4 id="title_{{$block->id}}" class="pt-4 pb-1 m-0">{{$block->title}}:</h4>
									<input class="d-none" type="text" id="titleInput_{{$block->id}}" name="title" value="{{$block->title}}"/>
								</div>
								<div class="col d-sm-none d-none d-md-block">
									<div class="ml-auto d-flex justify-content-end">
										<button type="button" class="btn btn-link p-0 m-2 text-white" data-toggle="modal" data-target="#deleteblock_{{$block->id}}"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
										<span class="btn btn-link p-0 m-2 text-white" onclick="showInputs({{$block->id}})"><i class="fas fa-edit fa-fw" aria-hidden="true"></i></span>
										<button form="blockheader_{{$block->id}}" type="submit" class="btn btn-link p-0 m-2 text-white"><i class="far fa-save fa-fw" aria-hidden="true"></i></button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<p id="task_{{$block->id}}">{!!$block->task!!}</p>
									<div id="taskInput_{{$block->id}}" class="d-none">
										<textarea class="form-control mb-3 task-summernote" rows="8"  name="task" aria-label="task" aria-describedby="task">@if (isset($block->id)){!!$block->task!!}@endif</textarea>
										 <input type="hidden" name="unit_id" value="{{$unit->id}}">
									</div>
								</div>
								<div class="col">
										<i class="far fa-clock"><input class="d-none" type="text" size="2" maxlength="2" id="timeInput_{{$block->id}}" name="time" value="{{$block->time}}"></i><span id="time_{{$block->id}}"> {{$block->time}}</span> Minuten
								</div>
								<div class="col">
									<a class="collapsed" data-toggle="collapse" href="#collapse{{$block->id}}" role="button" aria-expanded="false" aria-controls="collapseTwo"><i class="mx-5 far fa-caret-down fa-2x" style="color:#ffff00;"></i></a>
								</div>
							</div>
						</div>
					</form>
					
					<!-- Modal Delete Block -->
					@component('teacher.teacher_components.delete_block', ['id' => $block->id])
					@endcomponent
					
						<!-- CardBody -->
						<div id="collapse{{$block->id}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
							
							<!-- Differenzierung1 -->
<!-- ..................................................................................... -->
							<div class="card-body">
								<div class="row">
									<div class="col d-flex align-items-start flex-column">
										<div class="mb-auto">
											@if (isset ($block->content_id1))
												@php $content1 = App\Content::find($block->content_id1); @endphp
												@isset ($content1->content_img_thumb)
													<a href="/content/{{$content1->id}}" target="_blank"><img src="/images/contents/{{$content1->content_img}}" alt="Bild:{{$content1->content_title}}"></img></a>
												@endisset
												@empty ($content1->content_img_thumb) 
													@switch($content1->tool_id)
														@case(1)
														<a href="/content/{{$content1->id}}" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/{{$content1->toolspecific_id}}/mqdefault.jpg"></img></a>
														@break
														@default
														@isset ($content1->portal->portal_img)
															<a href="/content/{{$content1->id}}" target="_blank"><img src="/images/portals/{{$content1->portal->portal_img}}"></img></a>
														@endisset
													@endswitch
												@endempty		
											@elseif (isset ($block->specialcontent1))
												<div class="container">
													{!!$block->specialcontent1!!}
												</div>
											@else
											<span class="rounded bg-light border border-info" style="display:inline-block;width:267px;height:150px;overflow:auto">
												<div class="container-fluid">
													<div class="row mt-4">
														<div class="col-3">
															<button type="button" class="btn btn-link text-info" data-toggle="modal" data-target="#choosecontent1_{{$block->id}}">
																<i class="fas fa-external-link-alt fa-2x"></i>
															</button>
														</div>
														<div class="col m-4">
															<p class="text-info">Inhalt aussuchen</p>
														</div>
													</div>
													<div class="row">
														<div class="col-3">
															<button class="btn btn-link text-info" data-toggle="modal" data-target="#specialcontent1_{{$block->id}}">
																<i class="fas fa-file-alt fa-2x"></i>
															</button>
														</div>
														<div class="col mt-1 my-4">
															<a href="#specialcontent1_{{$block->id}}" data-toggle="modal" data-target="#specialcontent1_{{$block->id}}"><p class="text-info">Aufgabentext eingeben</p></a>
														</div>
													</div>
												</div>
											</span>
											@endif
										</div>
									</div>
									<div class="col d-flex align-items-end flex-column">
										@if($block->differentiation > 1)<span class="badge badge-pill bg-info">block1_differenzierung_name1</span>
										@else 
										@endif
										<div class="mt-auto">
											<button type="button" class="btn mr-5 p-0" data-toggle="popover" title="Noch Fragen?" data-content="Tip_Text"><i class="fas fa-question-circle" style="color:orange"></i>												
											</button>
										</div>
									</div>
								</div>
							</div>
								
							<!-- Differenzierung2 -->
<!-- .............................................................................. -->
							@if($block->differentiation > 1)
							<hr></hr>
							<div class="card-body">
								<div class="row">
									<div class="col d-flex align-items-start flex-column">
										<div class="mb-auto">
											@if (isset ($block->content_id2))
												@php $content2 = App\Content::find($block->content_id2); @endphp
												@isset ($content2->content_img_thumb)
													<a href="/content/{{$content2->id}}" target="_blank"><img src="/images/contents/{{$content2->content_img}}" alt="Bild:{{$content2->content_title}}"></img></a>
												@endisset
												@empty ($content2->content_img_thumb) 
													@switch($content2->tool_id)
														@case(1)
														<a href="/content/{{$content2->id}}" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/{{$content2->toolspecific_id}}/mqdefault.jpg"></img></a>
														@break
														@default
														@isset ($content2->portal->portal_img)
															<a href="/content/{{$content2->id}}" target="_blank"><img src="/images/portals/{{$content2->portal->portal_img}}"></img></a>
														@endisset
													@endswitch
												@endempty		
											@elseif (isset ($block->specialcontent2))
												<div class="container">
													{!!$block->specialcontent2!!}
												</div>
											@else
											<span class="rounded bg-light border border-info" style="display:inline-block;width:267px;height:150px;overflow:auto">
												<div class="container-fluid">
													<div class="row mt-4">
														<div class="col-3">
															<button type="button" class="btn btn-link text-info" data-toggle="modal" data-target="#choosecontent2_{{$block->id}}">
																<i class="fas fa-external-link-alt fa-2x"></i>
															</button>
														</div>
														<div class="col m-4">
															<p class="text-info">Inhalt aussuchen</p>
														</div>
													</div>
													<div class="row">
														<div class="col-3">
															<button class="btn btn-link text-info" data-toggle="modal" data-target="#specialcontent2_{{$block->id}}">
																<i class="fas fa-file-alt fa-2x"></i>
															</button>
														</div>
														<div class="col mt-1 my-4">
															<a href="#specialcontent2_{{$block->id}}" data-toggle="modal" data-target="#specialcontent2_{{$block->id}}"><p class="text-info">Aufgabentext eingeben</p></a>
														</div>
													</div>
												</div>
											</span>
											@endif
										</div>
									</div>
									<div class="col d-flex align-items-end flex-column">
										<span class="badge badge-pill bg-info">block1_differenzierung_name2</span>
										<div class="mt-auto">
											<button type="button" class="btn mr-5 p-0" data-toggle="popover" title="Noch Fragen?" data-content="Tip_Text"><i class="fas fa-question-circle" style="color:orange"></i>												
											</button>
										</div>
									</div>
								</div>
							</div>
							@endif
					


							<!-- Differenzierung3 -->
<!-- ......................................................................................... -->
							@if($block->differentiation > 2)
							<hr></hr>

							<div class="card-body">
								<div class="row">
									<div class="col d-flex align-items-start flex-column">
										<div class="mt-auto">
											@if (isset ($block->content_id3))
												@php $content3 = App\Content::find($block->content_id3); @endphp
												@isset ($content3->content_img_thumb)
													<a href="/content/{{$content3->id}}" target="_blank"><img src="/images/contents/{{$content3->content_img}}" alt="Bild:{{$content3->content_title}}"></img></a>
												@endisset
												@empty ($content3->content_img_thumb) 
													@switch($content3->tool_id)
														@case(1)
														<a href="/content/{{$content3->id}}" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/{{$content2->toolspecific_id}}/mqdefault.jpg"></img></a>
														@break
														@default
														@isset ($content3->portal->portal_img)
															<a href="/content/{{$content3->id}}" target="_blank"><img src="/images/portals/{{$content3->portal->portal_img}}"></img></a>
														@endisset
													@endswitch
												@endempty		
											@elseif (isset ($block->specialcontent3))
												<div class="container">
													{!!$block->specialcontent3!!}
												</div>
											@else
											<span class="rounded bg-light border border-info" style="display:inline-block;width:267px;height:150px;overflow:auto">
												<div class="container-fluid">
													<div class="row mt-4">
														<div class="col-3">
															<button type="button" class="btn btn-link text-info" data-toggle="modal" data-target="#choosecontent3_{{$block->id}}">
																<i class="fas fa-external-link-alt fa-2x"></i>
															</button>
														</div>
														<div class="col m-4">
															<p class="text-info">Inhalt aussuchen</p>
														</div>
													</div>
													<div class="row">
														<div class="col-3">
															<button class="btn btn-link text-info" data-toggle="modal" data-target="#specialcontent3_{{$block->id}}">
																<i class="fas fa-file-alt fa-2x"></i>
															</button>
														</div>
														<div class="col mt-1 my-4">
															<a href="#specialcontent2_{{$block->id}}" data-toggle="modal" data-target="#specialcontent3_{{$block->id}}"><p class="text-info">Aufgabentext eingeben</p></a>
														</div>
													</div>
												</div>
											</span>
											@endif
										</div>
									</div>
									<div class="col d-flex align-items-end flex-column">
										<span class="badge badge-pill bg-info">block1_differenzierung_name3</span>
										<div class="mt-auto">
											<button type="button" class="btn mr-5 p-0" data-toggle="popover" title="Noch Fragen?" data-content="Tip_Text"><i class="fas fa-question-circle" style="color:orange"></i>												
											</button>
										</div>
									</div>
								</div>
							</div>
							@endif
						</div> <!-- close accordion collapse div -->
					</div> <!-- close card div -->
					
					<!-- Modal choose_content -->
					<div class="modal fade" id="choosecontent1_{{$block->id}}" tabindex="-1" role="dialog" aria-labelledby="choose_content" aria-hidden="true">
					@component('teacher.teacher_components.choose_content', ['topic_id'=>$unit->topic_id , 'block'=>$block , 'contentnumber'=>'1'])
					@endcomponent
					</div>
					
					<div class="modal fade" id="choosecontent2_{{$block->id}}" tabindex="-1" role="dialog" aria-labelledby="choose_content" aria-hidden="true">
					@component('teacher.teacher_components.choose_content', ['topic_id'=>$unit->topic_id , 'block'=>$block , 'contentnumber'=>'2'])
					@endcomponent
					</div>
					
					<div class="modal fade" id="choosecontent3_{{$block->id}}" tabindex="-1" role="dialog" aria-labelledby="choose_content" aria-hidden="true">
					@component('teacher.teacher_components.choose_content', ['topic_id'=>$unit->topic_id , 'block'=>$block , 'contentnumber'=>'3'])
					@endcomponent
					</div>
					
					<!-- Modal specialcontent -->
					<div class="modal fade" id="specialcontent1_{{$block->id}}" tabindex="-1" role="dialog" aria-labelledby="specialcontent" aria-hidden="true">
					@component('teacher.teacher_components.specialcontent', ['block'=>$block , 'contentnumber'=>'1'])
					@endcomponent
					</div>
					
					<div class="modal fade" id="specialcontent2_{{$block->id}}" tabindex="-1" role="dialog" aria-labelledby="specialcontent" aria-hidden="true">
					@component('teacher.teacher_components.specialcontent', ['block'=>$block , 'contentnumber'=>'2'])
					@endcomponent
					</div>
					
					<div class="modal fade" id="specialcontent3_{{$block->id}}" tabindex="-1" role="dialog" aria-labelledby="specialcontent" aria-hidden="true">
					@component('teacher.teacher_components.specialcontent', ['block'=>$block , 'contentnumber'=>'3'])
					@endcomponent
					</div>
					
					
					
					@endforeach
					
					<hr></hr>
					<div class="alert mt-5 mb-0 p-4 text-white font-weight-bold border border-white" style="background-color:#03c4eb; font-size:18px;">Hier kannst Du eine weitere Aufgabe hinzufügen: </div>
					
					<!-- new block -->
					@component('teacher.teacher_components.new_block', ['id' => $unit->id])
					@endcomponent
						
										
				</div> <!-- close accordion -->
			</div> <!-- close tab content schueler -->		
						
			<div class="tab-pane fade" id="lehrer" role="tabpanel" aria-labelledby="lehrer-tab">		
				<div class="text-white alert pt-2" style="background-color:#03c4eb">
					<p class="lead">Folgende Materialien/Geräte werden benötigt:</p>Smartphone, Beamer, Bildschirm, Internetzugang 16Mbit/s
				</div>
						
				<table class="table">
					<thead class="thead-light">
						<tr>
							<th>...</th>
							<th>Blockname / Verwendete Inhalte</th>
							<th>Dauer</th>
							<th>Unterrichtszeit</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td><p class="lead">{{$unit->start_text}}</p></td>
							<td>{{$unit->start_time}} Min</td>
							<td class="text-right"><time>{{$passed_time}}</time></td>
						</tr>
						@foreach ($unit->blocks as $block)
						<tr>	
							<td>{{$block->order}}</td>
							<td>
								<p class="lead" >{{$block->title}}</p>
								@if($block->differentiation = 1)
								<p><a href="#"></a></p>
								@else
								<p>{{$block->differentiation_name1}}:<a href="#">Titel Video2</a></p>
								<p>Mittel:<a href="#">Titel Video2</a></p>
								<p>Schwer:<a href="#">Titel Video3</a></p>
								@endif
							</td>
							<td>10 Min</td>
							<td class="text-right">0:15</td>
						</tr>
						@endforeach
						<tr>	
							<td>5</td>
							<td><p class="lead" >Orga/Verabschiedung/Hardware wegräumen</p></td>
							<td>5 Min</td>
							<td class="text-right">0:42</td>
						</tr>
					</tbody>
				</table>
			</div> <!-- close tab for Lehrersicht -->
		</div> <!-- close content for tabs -->
	</div> <!-- close col with Schüler/Lehrersicht -->
	@include('layouts.errors')
	</div> <!-- close container for page -->
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
      $('.task-summernote').summernote({
        height:100,
        toolbar: [
  		],
  		placeholder: 'Beschreibe hier kurz was der Schüler für die nächste Aufgabe tun muss (z.B. "Schau Dir das Video an." oder "Löse die folgenden Aufgaben:")'
      });
</script>
<script>
      $('.specialcontent-summernote').summernote({
        height: 130,
        toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		],
      });
</script>

@endsection