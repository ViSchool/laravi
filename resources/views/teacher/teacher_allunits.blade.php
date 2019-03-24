@extends('layout')
		
@section ('page-header')
	
@endsection

@section ('content')
<div class="container">
	<div class="row">
	<h2 class=" mt-5 text-brand-blue">Fächer</h2>
	</div>
	<div class="row">
	@foreach ($subjects as $subject)
		<div class="col">
			<div class="item">
				<div class="card m-4 text-white" style="width:100px" >
  					<a href="#">
  						<img class="card-img rounded img-thumbnail" src="/images/topic_back.jpeg" alt="Card image">
  					</a>
  					<div class="card-img-overlay">
    					<div class="card-text">
    						<span class="align-middle text-center">
    							<a href="">
    								<h5 class="text-white mt-5">{{$subject->subject_title}}</h5>
    							</a>
    						</span>
    					</div>
  					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	
<hr></hr>

</div>

@endsection

