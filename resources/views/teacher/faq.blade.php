@extends('layout')

@section('page-header')
<section id="page-header">
    <div class="container p-3">
    <h4>Frequently Asked Questions </h4>
    </div>
</section> 
@endsection

@section('content')
<section id="vischool_faq">    
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-{{$minFirstCategory}}-list" data-toggle="list" href="#list-{{$minFirstCategory}}" role="tab" aria-controls="{{$minFirstCategory}}"><small>{{$firstCategory}}</small></a>
                    @foreach ($categories as $category)
                    @php
                        $minCategory = trim(preg_replace('/\s+/','', $category));
                    @endphp
                        <a class="list-group-item list-group-item-action" id="list-{{$minCategory}}-list" data-toggle="list" href="#list-{{$minCategory}}" role="tab" aria-controls="{{$minCategory}}"><small>{{$category}}</small></a>
                    @endforeach
                    
                </div>
            </div>
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-{{$firstCategory}}" role="tabpanel" aria-labelledby="list-{{$firstCategory}}-list">  
                        {{-- Akkordion für die erste Kategorie --}}
                        <div class="accordion" id="accordionFirstCategory">
                            @foreach ($faqs->where('faq_category',$firstCategory) as $faq)
                                <div class="card border border-light">
                                    <div class="card-header bg-white" id="question_{{$faq->id}}">
                                        <h2 class="mb-0">
                                            <button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapse_{{$faq->id}}" aria-expanded="true" aria-controls="collapse_{{$faq->id}}">
                                                {{$faq->faq_question}}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapse_{{$faq->id}}" class="collapse" aria-labelledby="question_{{$faq->id}}" data-parent="#accordionFirstCategory">
                                        <div class="card-body">
                                            {{$faq->faq_answer}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    @foreach ($categories as $category)
                        @php
                            $minCategory = trim(preg_replace('/\s+/', '', $category));
                        @endphp
                        <div class="tab-pane fade" id="list-{{$minCategory}}" role="tabpanel" aria-labelledby="list-{{$minCategory}}-list">
                            {{-- Akkordion für alle weiteren Kategorien --}}
                            <div class="accordion" id="accordion_{{$minCategory}}">
                                @foreach ($faqs->where('faq_category',$category) as $faq)
                                    <div class="card border border-light">
                                        <div class="card-header bg-white" id="question_{{$faq->id}}">
                                            <h2 class="mb-0">
                                                <button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapse_{{$faq->id}}" aria-expanded="true" aria-controls="collapse_{{$faq->id}}">
                                                    {{$faq->faq_question}}
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapse_{{$faq->id}}" class="collapse" aria-labelledby="question_{{$faq->id}}" data-parent="#accordion_{{$minCategory}}">
                                            <div class="card-body">
                                                {{$faq->faq_answer}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>  
    </div>  
</section>

@endsection