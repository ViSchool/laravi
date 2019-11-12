@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>FAQs - Übersicht</h1>

<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th>Kategorie</th>
					<th>Frage</th>
					<th>Frage löschen</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($faqs as $faq)
				<tr>
					<td>{{$faq->faq_category}}</td>
					<td><a href="/backend/faq/{{$faq->id}}">{{$faq->faq_question}}</a></td>	
					<td><button class="btn btn-link mb-3" type="button" title="FAQ Frage löschen" data-toggle="modal" data-target="#deleteModal_{{$faq->id}}"><i class="fas fa-trash"></i></button></td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<div class="modal fade" id="deleteModal_{{$faq->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         @include('components.deleteCheck',['typeDelete'=>'faq','id'=>$faq->id, 'title'=>$faq->faq_question])
      </div>

		{{$faqs->links()}}
		
		<hr></hr>
	<a class="btn btn-primary my-3"href="/backend/faq/create">Neue Frage einfügen</a>
</div>
@endsection
