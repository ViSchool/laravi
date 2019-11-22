<div class="modal fade" id="newInstantContentModal" tabindex="-1" role="dialog" aria-labelledby="newContentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="newInstantContentForm" method="POST" action="/lehrer/inhalte" enctype="multipart/form-data">
                @csrf 
                    <div class="modal-header">
                        <h5 class="modal-title" id="newInstantContentModalLabel">Einen neuen Inhalt erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        
                        <input type="hidden" value="{{$teacher->id}}" name="user_id">
                        <input type="hidden" value="{{$subject_id}}" name="subject_id">
                        <input type="hidden" value="{{$topic_id}}" name="topic_id">
                        <input type="hidden" value="instant" name="instant">
                        

                        
                        <input type="hidden" 
                            @if ($teacher->teacher_id == $teacher->id)
                                value="teacher" 
                            @else 
                                value="student"
                            @endif
                        name="teacherOrStudent">


                        <div class="form-group{{ $errors->has('content_title') ? ' invalid' : '' }}">
                            <label for="content_title" class="col-10 col-form-label">Name des Inhalts</label>
                             <div class="col-10">
                             <input id="new_content_title" type="text" class="form-control" name="content_title" value="{{ old('content_title') }}" >
                                @if ($errors->has('content_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tool_id') ? ' invalid' : '' }}">
                            <label for="content_provider" class="col-10 col-form-label">Der Inhalt stammt von folgendem Anbieter:</label>
                            <div class="col-10">
                                <select class="form-control" id="tool_id" name="tool_id">
				                    @if((old('tool_id')) !== null)
                                        @php 
                                            $tool_id_old = old('tool_id');
                                            $tool_old = App\Tool::where('id', '=' , $tool_id_old)->first();
                                        @endphp
                                        <option value="{{$tool_id_old}}">{{$tool_old->tool_title}}</option>
				                    @endif
				                    @empty(old('tool_id'))
					                    <option value=""></option>
				                    @endempty
				                    @foreach ($tools as $tool)	
					                    <option value="{{$tool->id}}">{{$tool->tool_title}}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>

                        <div class="form-group{{ $errors->has('content_link') ? ' invalid' : '' }}">
                            <label for="content_link" class="col-10 col-form-label">Link zum Inhalt</label>
                            <br>
                            <small id="examplelink" class="text-muted col-10">Beispiellink</small>
                             <div class="col-11">
                                <input id="content_link" type="text" class="form-control" name="content_link" value="{{ old('content_link') }}" placeholder=""">
                                @if ($errors->has('content_link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" form="newInstantContentForm" class="btn btn-primary">Inhalt speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>