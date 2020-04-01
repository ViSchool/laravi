@extends('layout')  <!-- Body  -->

@section('stylesheets')
	<link href="/css/rotating-card.css" rel="stylesheet" />
@endsection
    
<!-- Hauptteil der Seite -->
@section('content')

@include('layouts.hero')

@if(count($featuredElements) == 3);
    @include('layouts.featured') 
@endif
      <!-- Subjects   
     ================================================== -->
@include('layouts.subjects')

      <!-- About ViSchool   
     ================================================== -->
@include('layouts.about')

      <!-- Team   
     ================================================== -->
@include('layouts.team')

      <!-- Blog   
     ================================================== -->
@include('layouts.blog')
	
@endsection

@section('scripts')

<script>$(function () {
  $('[data-toggle="tooltip"]').tooltip({
  	trigger: 'hover focus'
  })
});
</script>

<script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();

        $('a.scroll-down').click(function(e){
            e.preventDefault();
            scroll_target = $(this).data('href');
             $('html, body').animate({
                 scrollTop: $(scroll_target).offset().top - 60
             }, 1000);
        });

    });

    function rotateCard(btn){
        var $card = $(btn).closest('.card-container-flip');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }
</script>

@endsection