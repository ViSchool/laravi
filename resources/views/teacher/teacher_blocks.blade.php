@extends('layout')

@section('stylesheets')
@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
    <h4>Aufgaben zur Lerneinheit "{{$unit->unit_title}}"</h4>
    </div>
</section> 
@endsection

@section('content')



<div class="container mt-3">
    <h3>Bereits erstellte Aufgaben</h3>
    <p>Klicke auf die einzelnen Aufgaben, um sie zu ändern oder füge eine neue Aufgabe ein.</p>
</div>
<div class="container">
    <a class="btn btn-primary form-control" href="/lehrer/lerneinheiten/{{$unit->id}}/aufgabe">Eine neue Aufgabe einfügen</a>
</div>

<!--Anzeige der Inhalte-->


<div class="container mt-3 mb-5">
    <hr> 
    <h3>Diese Aufgaben gibt es bereits in der Lerneinheit:</h3>
    <div class="table-responsive">
        <table class="table table-striped table-sm my-5">
            <thead class="table-primary">
                <tr>
                    <th class="text-center" scope="col">Reihenfolge<br>ändern</th>
                    <th class="text-center" scope="col">Überschrift für die Aufgabe</th>
                    <th class="text-center" scope="col">Lernniveau</th>
                    <th class="text-center" scope="col">Zeit für die<br> Aufgabe</th>
                    <th class="text-center" scope="col">Löschen</th>
                </tr>
            </thead>
            <tbody>
                @php
					$maxOrder = $unit->blocks->max('order');
					$minOrder = $unit->blocks->min('order');
				@endphp
				@foreach($unit->blocks->sortBy('order') as $block)
                @php 
                if (App\Block::where([
                    ['order', $block->order],
                    ['unit_id',$block->unit_id]
                    ])->count() > 1) {
                        $alternative = 1;
                    }
                else {$alternative = 0;}
                @endphp
                <tr>
                    <td class="text-center">
						@if ($block->order != $minOrder)
						<form method="POST" action="{{route('backend.blocks.update_orderup', $block->id)}}">
						{{ csrf_field() }} {{ method_field('PATCH') }} 
							<button class="btn btn-link" type="submit"><i class="fas fa-lg fa-chevron-up"></i></button>
						</form>
						@endif
						@if ($block->order != $maxOrder)
						<form method="POST" action="{{route('backend.blocks.update_orderdown', $block->id)}}">
						{{ csrf_field() }} {{ method_field('PATCH') }} 
							<button class="btn btn-link" type="submit"><i class="fas fa-lg fa-chevron-down"></i></button>
						</form>
						@endif
					</td>
                    <td>
                        @if ($alternative == 1)
                            <i class="mr-3 fas fa-exchange-alt" style="color:orange;"></i>
					    @endisset
                        <a href="/lehrer/lerneinheiten/aufgabe/bearbeiten/{{$block->id}}">{{$block->title}}</a> 
                    </td>
                    <td class="text-center">{{$block->differentiation->differentiation_title}}</td>	
                    <td class="text-center">{{$block->time}}</td>
                    <td class="text-center"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#deleteModal_{{$block->id}}"><i class="far fa-trash-alt"></i></button></td>
                    
                </tr>
                <div class="modal fade" id="deleteModal_{{$block->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    @include('components.deleteCheck',['typeDelete'=>'block','id'=>$block->id,'title'=>$block->title])
                </div>
                @endforeach    
            </tbody>
        </table>
        
    </div>
</div>
@endsection

@section('scripts')  

@endsection