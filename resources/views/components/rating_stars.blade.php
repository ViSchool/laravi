@if ($average_score == 0)

@else
	@php $rating = $average_score; @endphp  
	@foreach(range(1,5) as $i)
		@if($rating >0)
			@if($rating >0.5)
				<i class="fas fa-star"></i>
			@else
				<i class="fas fa-star-half-alt"></i>
			@endif
		@else
			<i class="far fa-star"></i>
		@endif
			@php $rating--; @endphp
	@endforeach
@endif