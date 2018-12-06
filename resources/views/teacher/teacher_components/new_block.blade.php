<form method="POST" action="{{route('blocks.store')}}" enctype="multipart/form-data">
{{ csrf_field() }} 
	<div class="form-group">			
		<div class="card" style="border-color:#03c4eb;">
			<!-- CardHeader1 -->
			<div class="card-header" role="tab">
				<div class="row py-3">
					<div class="col-6">	
						<input class="form-control mb-5" type="text" id="titleInput" name="title" placeholder="Überschrift für die Aufgabe"/>
					</div>
					<div class="col">
						<div class="form-row">
							<div class="col-9 my-2">
								<small class="d-flex justify-content-end">Anzahl unterschiedlicher Lernniveaus</small>
							</div>
							<div class="col">
								<select class="my-2 form-control" id="differentiation" name="differentiation">
									<option selected>1</option>
									<option>2</option>
									<option>3</option>
								</select>
							</div>	
						</div>
					</div>
				</div>
				<div class="row my-3">
					<div class="col-7">
						<textarea class="form-control mb-3 task-summernote" rows="8" id="task" name="task" aria-label="task" aria-describedby="task"></textarea>
						<input type="hidden" name="unit_id" value="{{$id}}">
					</div>
					<div class="col">
						<p class="pt-0 mt-0"><label for="time"><small >Wie lange sollen die Schüler mit der Aufgabe maximal verbringen?</small></label></p>
						<i class="my-0 py-0"><input type="text" size="2" maxlength="2" id="time" name="time"></input></i> Minuten
					</div>
				</div>
				<div class="row justify-content-end">
					<button style="background-color:#03c4eb" class="badge mx-4 p-3 border-white" type="submit">Neue Aufgabe speichern</button>
				</div>
			</div>
		</div>
	</div>
</form>