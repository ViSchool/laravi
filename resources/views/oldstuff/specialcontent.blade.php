<div class="modal-dialog modal-dialog-centered modal-lg">
	<div class="modal-content">
		<div class="modal-header" style="background-color:#03c4eb;">
			<p class="modal-title text-white text-right font-weight-bold">Gestalte hier den Text für die Arbeitsanweisung für die Schüler</p>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        		</button>
		</div>
		<div class="modal-body container-fluid my-4">
			
			<form method="POST" action="{{route('blocks.update',[$block->id])}}" enctype="multipart/form-data">
				{{ csrf_field() }} {{ method_field('PATCH') }}
				<div class="form-group">
					<input type="hidden" value="{{$contentnumber}}" name="contentnumber"/>
					<input type="hidden" value="{{$block->task}}" name="task"/>
					<input type="hidden" value="{{$block->title}}" name="title"/>
					<input type="hidden" value="{{$block->unit_id}}" name="unit_id"/>
					<textarea class="specialcontent-summernote" name="specialcontent" aria-label="specialcontent" aria-describedby="specialcontent">@if (isset($block->id)){!!$block->specialcontent!!}@endif</textarea>
					<div class="d-flex justify-content-between">
					<button class="badge badge-pill bg-warning mt-4" type="button" data-dismiss="modal" aria-label="Close">Abbrechen</button>
					<button class="badge badge-pill mt-4" type="submit" value="speichern" style="background-color:#03c4eb;">Speichern</button>	
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
					
	</div>
</div>	
