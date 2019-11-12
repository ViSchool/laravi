<!-- Section for subjects -->
	<section id="vischool-subjects">
		<div class="row">
			<div class="col-lg col-lg-offset text-center m-5">
				<h2>Fächer</h2>
			</div>
		</div>
		<div class="container">
		<div class="row">
			@foreach ($subjects as $subject)
			<div class="col text-center m-5">
				<div class="fa-3x">
					<span class="fa-stack m-2">
						<a href="/subjects/{{$subject->id}}">
							<i class="fas fa-circle fa-stack-2x" style="color:#03c4eb;"></i>
							<i class="fa {{$subject->subject_icon}} fa-stack-1x fa-inverse"></i>
						</a>
					</span>
				</div>
				<h4><a href="/subjects/{{$subject->id}}">{{$subject->subject_title}}</a></h4>
			</div>
			@endforeach
			</div>
	</section>		


