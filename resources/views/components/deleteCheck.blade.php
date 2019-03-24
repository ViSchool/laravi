  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganz sicher? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Du möchtest <strong>"{{$title}}"</strong>  löschen? Dann klicke unten auf Löschen, ansonsten kannst Du es auch einfach lassen. 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
         @switch($typeDelete)
            @case('block')
               <form method="POST" action="/lehrer/unterrichtseinheiten/aufgabe/löschen/{{$id}}">
                  @csrf @method('DELETE')
			         <button class=" form-control btn btn-warning" type="submit"> Aufgabe löschen</button>
		         </form>
            @break
         
            @case('content')
               Second case...
            @break

            @case('differentiation')
               Second case...
            @break

            @case('portal')
               Second case...
            @break

            @case('post')
               Second case...
            @break

            @case('question')
               Second case...
            @break

            @case('school')
               Second case...
            @break

            @case('serie')
               Second case...
            @break

            @case('subject')
               Second case...
            @break

            @case('tool')
               Second case...
            @break

            @case('topic')
               Second case...
            @break

            @case('unit')
               <form method="POST" action="/lehrer/newUnitDelete/{{$id}}">
                  @csrf @method('DELETE')
			         <button class="form-control btn btn-info" type="submit"> Unterrichtseinheit löschen</button>
		         </form>
            @break

            @default
               Default case...
         @endswitch
        
      </div>
    </div>
  </div>