@section('main')
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		<h1>Dashboard</h1>
	<div class="container">
		<section class="row text-center placeholders">
			<div class="border-0 card col-6 col-sm-3">
				<img src="/images/topic_back.jpeg" width="200" height="200" class=" card-img img-fluid rounded-circle" alt="Generic placeholder thumbnail">		
				<div class="card-img-overlay">
					<h2 class="card-text text-info">{{$nrSubjects}}</h2>
				</div>
				<p class="mt-4">Fächer</p>
			</div>
			
			<div class="border-0 card col-6 col-sm-3">
				<img src="/images/topic_back.jpeg" width="200" height="200" class=" card-img img-fluid rounded-circle" alt="Generic placeholder thumbnail">		
				<div class="card-img-overlay">
					<h2 class="card-text text-info">{{$nrTopics}}</h2>
				</div>
				<p class="mt-4">Themen</p>
			</div>
			
			<div class="border-0 card col-6 col-sm-3">
				<img src="/images/topic_back.jpeg" width="200" height="200" class=" card-img img-fluid rounded-circle" alt="Generic placeholder thumbnail">		
				<div class="card-img-overlay">
					<h2 class="card-text text-info">{{$nrContents}}</h2>
				</div>
				<p class="mt-4">Inhalte</p>
			</div>
			
			<div class="border-0 card col-6 col-sm-3">
				<img src="/images/topic_back.jpeg" width="200" height="200" class=" card-img img-fluid rounded-circle" alt="Generic placeholder thumbnail">		
				<div class="card-img-overlay">
					<h2 class="card-text text-info">{{$nrUnits}}</h2>
				</div>
				<p class="mt-4">Unterrichtseinheiten</p>
			</div>
		</section>
		</div>


	<h4>Letzte gemeldete Fehler</h4>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Inhalt Titel (ID)</th>
						<th>Inhalt Typ</th>
						<th>Fehler Art</th>
						<th>Fehler Beschreibung</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($mistakes as $mistake)
					<tr>
						
						<td><small>{{$mistake->content->content_title}} ({{$mistake->content_id}})</small></td>
						<td><small>{{$mistake->content->type->content_type}}</small></td>
						<td><small>{{$mistake->mistake_type}}</small></td>
						<td><small>{{$mistake->mistake_description}}</small></td>
						
					</tr>
					@endforeach
				</tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
@endsection