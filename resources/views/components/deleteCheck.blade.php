  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganz sicher? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p> Du möchtest <strong>"{{$title}}"</strong>  löschen? @if($typeDelete == 'block') Wenn die Aufgabe für mehrere Lernniveaus eingerichtet ist, werden alle Lernniveaus gelöscht. @endif </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
         @switch($typeDelete)
            @case('block')
               <form method="POST" action="/lehrer/lerneinheiten/aufgabe/löschen/{{$id}}">
                  @csrf @method('DELETE')
			         <button class=" form-control btn btn-warning" type="submit"> Aufgabe löschen</button>
		         </form>
            @break 
         
            @case('content')
               <form method="POST" action="/backend/contents/{{$id}}">
                  @csrf @method('DELETE')
			         <button class=" form-control btn btn-warning" type="submit"> Inhalt löschen</button>
		         </form>
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
               <form method="POST" action="/lehrer/newTopicDelete/{{$id}}">
                  @csrf @method('DELETE')
			         <button class="form-control btn btn-info" type="submit"> Thema löschen</button>
		         </form>
            @break

            @case('unit')
               <form method="POST" action="/lehrer/newUnitDelete/{{$id}}">
                  @csrf @method('DELETE')
			         <button class="form-control btn btn-info" type="submit"> Lerneinheit löschen</button>
		         </form>
            @break

            @case('faq')
               <form method="POST" action="/backend/faq/{{$id}}">
                  @csrf @method('DELETE')
			         <button class="form-control btn btn-info" type="submit"> Frage löschen</button>
		         </form>
            @break

            @default
               Default case...
         @endswitch
        
      </div>
    </div>
  </div>