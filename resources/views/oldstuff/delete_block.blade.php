
<div class="modal fade" id="deleteblock_{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Soll die Aufgabe mit allen Inhalten gelöscht werden?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('blocks.destroy',[$id])}}">
					{{ csrf_field() }} {{ method_field('DELETE') }}
					<button type="submit" class="btn btn-link p-0 m-2">Ja, Aufgabe löschen</i></button>
				</form>
			</div>
		</div>
	</div>
</div>
