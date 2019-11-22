@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <div><h2>Lerneinheiten administrieren
          <a href="/backend/units/create"><i class="far fa-plus-square"></i></a></h2></div>
          

<div class="container">
	<div class="my-4">
	<p>Inhalte nach Fächern filtern:</p>
	@foreach($subjects->sortBy('subject_title') as $subject)
		<a class="btn btn-info m-1" href="/backend/units/subjectfilter/{{$subject->id}}">{{$subject->subject_title}}</a>
	@endforeach
	</div>
		<table class="table table-hover table-sm">
			<thead>
				<tr>
					<th>Titel der Lerneinheit</th>
					<th>Thema</th>
					<th>Fach</th>
					<th>dazugehörige Serie</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($units as $unit)
				<tr>
				<td><a href="/backend/units/{{$unit->id}}">{{$unit->unit_title}}</a></td>	
					<td>{{$unit->topic->topic_title}}</td>
					<td>{{$unit->subject->subject_title}}</td>
					<td>
						@if ($unit->serie_id !== NULL)
							{{$unit->serie->serie_title}}
						@endif
					</td>
				<td class="text-center"><i id="unit_status" class="{{$unit->status->status_icon}}" data-toggle="tooltip" title="{{$unit->status->status_name}}"></i></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<ul class="pagination">{{$units->links()}}</ul>
		<hr>
	<a class="btn btn-primary" href="/backend/units/create">Neue Lerneinheit erstellen</a>
	
</div>
@endsection

@section('scripts')
<script>
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})
</script>	 

@endsection
