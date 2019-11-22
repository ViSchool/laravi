<div class="modal fade" id="newContentModal" tabindex="-1" role="dialog" aria-labelledby="newContentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="/lehrer/inhalte" enctype="multipart/form-data">
                @csrf 
                                
                    <div class="modal-header">
                        <h5 class="modal-title" id="newContentModalLabel">Einen neuen Inhalt erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        
                        <input type="hidden" value="{{$teacher->id}}" name="user_id">
                        
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
                             <input id="content_title" type="text" class="form-control" name="content_title" value="{{ old('content_title') }}" required>
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
                                <input id="content_link" type="text" class="form-control" name="content_link" value="{{ old('content_link') }}" placeholder="" required>
                                @if ($errors->has('content_link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('subject_id') ? ' invalid' : '' }}">
                            <label for="topic_id" class="col-10 col-form-label">Der Inhalt gehört zu folgendem Fach</label>
                             <div class="col-10">
                               <select class="form-control" id="subject_id" name="subject_id">
				                    @if((old('subject_id')) !== null)
                                        @php 
                                            $subject_id_old = old('subject_id');
                                            $subject_old = App\Subject::where('id', '=' , $subject_id_old)->first();
                                        @endphp
                                        <option value="{{$subject_id_old}}">{{$subject_old->subject_title}}</option>
				                    @endif
				                    @empty(old('subject_id'))
					                    <option value=""></option>
				                    @endempty
				                    @foreach ($subjects as $subject)	
					                    <option value="{{$subject->id}}">{{$subject->subject_title}}</option>
				                    @endforeach
                             </select>
                                @if ($errors->has('topic_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topic_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('topic_id') ? ' invalid' : '' }}">
                            <label for="topic_id" class="col-10 col-form-label">Der Inhalt gehört zu folgendem Thema</label>
                             <div class="col-10">
                                <select class="form-control" id="topic_id" name="topic_id">
                                    @if((old('topic_id')) !== null)
                                        @php 
                                            $topic_id_old = old('topic_id');
                                            $topic_old = App\Topic::where('id', '=' , $topic_id_old)->first();
                                        @endphp
                                        <option value="{{$topic_id_old}}">{{$topic_old->topic_title}}</option>
                                    @endif
                                    @empty(old('topic_id'))
                                        <option>Zuerst Fach auswählen</option>
                                    @endempty
                                </select>
			                    <div class="col-md-2">
				                    <span id="loader" style="visibility: hidden;">
					                    <i class="far fa-spinner fa-spin"></i>
				                    </span>
			                    </div>
                                @if ($errors->has('topic_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topic_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>         
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Inhalt speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>