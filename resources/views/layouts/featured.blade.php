<div class="bg-white container my-5" id="featured">
   <h3 class="text-center text-uppercase">Nutze fertige Unterrichtseinheiten und passe sie an:</h3>  
   <div class="card-deck justify-content-center">
      @foreach ($featuredElements as $featuredElement)
         @php
            if (isset ($featuredElement->serie_id)) {
               $serie = App\Serie::find($featuredElement->serie_id);
               $subject = $serie->units->first()->subject;
            } else {
               $unit = App\Unit::find($featuredElement->unit_id);
               $subject = $unit->subject;
            }
              $color = rand(1,3);  
         @endphp

         @isset($serie)
         <div class="d-flex justify-content-center mb-3" id="featuredSerie">
         <a href="/lerneinheiten/serie/{{$serie->id}}">
            <div class="card m-2 h-100" style="width: 13rem;">
               <div class="card-header m-0 p-0 bg-white border-0">
                  <img class="card-img-top pb-5" src="/images/topic_back.jpeg" alt="">
                  <div class="fa-2x text-center card-img-overlay">
                     <span class="fa-stack m-2" style="position:relative; top:9rem;">
                        <i class="fas fa-circle fa-stack-2x" style="color:#03c4eb;"></i>
                        <i class="fa {{$subject->subject_icon}} fa-stack-1x fa-inverse"></i>
                     </span>
                  </div>
                  <div class="card-img-overlay text-center">
                     <small class="text-white">{{$subject->subject_title}}:</small>
                  <h3  
                     @switch($color)
                        @case(1)
                           class="text-uppercase text-center text-wrap card-title mt-3 text-brand-yellow"
                        @break
                        @case(2)
                           class="text-uppercase text-center text-wrap card-title mt-3 text-brand-blue"
                        @break
                        @case(3)
                           class="text-uppercase text-center text-wrap card-title mt-3 text-brand-red"
                        @break
                     @endswitch">
                     {{$serie->serie_title}}
                  </h3>
                  </div>
                  <div class="card-body">
                     <small class="text-center mb-auto">{{$serie->serie_description}}</small>
                  </div>  
               </div>
            </div>
         </a>
         </div>
         @php
          $serie = Null;   
         @endphp
         @endisset

         @isset($unit)
            <div class="d-flex justify-content-center mb-3" id="featuredUnit">
            <a href="/lerneinheit/{{$unit->id}}">
               <div class="card m-2 h-100" style="width: 13rem;">
                  <div class="card-header m-0 p-0 bg-white border-0">
                     <img class="card-img-top pb-5" src="/images/topic_back.jpeg" alt="">
                     <div class="fa-2x text-center card-img-overlay">
                        <span class="fa-stack m-2" style="position:relative; top:9rem;">
                           <i class="fas fa-circle fa-stack-2x" style="color:#03c4eb;"></i>
                           <i class="fa {{$subject->subject_icon}} fa-stack-1x fa-inverse"></i>
                        </span>
                     </div>
                     <div class="card-img-overlay text-center">
                        <small class="text-white">{{$subject->subject_title}}:</small>
                     <h3  
                        @switch($color)
                           @case(1)
                              class="text-uppercase text-center text-wrap card-title mt-3 text-brand-yellow"
                           @break
                           @case(2)
                              class="text-uppercase text-center text-wrap card-title mt-3 text-brand-blue"
                           @break
                           @case(3)
                              class="text-uppercase text-center text-wrap card-title mt-3 text-brand-red"
                           @break
                        @endswitch">
                        {{$unit->unit_title}}
                     </h3>
                     </div>
                     <div class="card-body">
                        <small class="text-center mb-auto">{{$unit->unit_description}}</small>
                     </div>  
                  </div>
               </div>
            </a>
            </div>
         @php
          $unit = Null;   
         @endphp
         @endisset
         
      @endforeach
   </div>
   </div>
</div>


