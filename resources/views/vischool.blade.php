@extends('layout')  <!-- Body  -->

    
<!-- Hauptteil der Seite -->
@section('content')

@include('layouts.hero')

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