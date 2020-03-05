<div class="modal fade" id="editContentModal_{{$content->id}}" tabindex="-1" role="dialog" aria-labelledby="newContentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/lehrer/inhalte/{{$content->id}}" enctype="multipart/form-data">
                @csrf @method('PATCH')
                                
                <div class="modal-header">
                    <h5 class="modal-title" id="editContentModalLabel">Inhalt bearbeiten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>                        </button>
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
                         <input id="content_title" type="text" class="form-control" name="content_title" value="{{ $content->content_title}}" required>
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
                                <option value="{{$content->tool->id}}">{{$content->tool->tool_title}}</option>
				                @foreach ($tools as $tool)	
					                <option value="{{$tool->id}}">{{$tool->tool_title}}</option>
                                @endforeach
                            </select>
                        </div>    
                    </div>

                    <div class="form-group{{ $errors->has('content_link') ? ' invalid' : '' }}">
                        <label for="content_link" class="col-10 col-form-label">Link zum Inhalt</label>
                        <br>
                        <div class="col-11">
                            <input id="content_link" type="text" class="form-control" name="content_link" value="{{$content->content_link}}" placeholder="" required>
                            @if ($errors->has('content_link'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content_link') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('subject_id') ? ' invalid' : '' }}">
                        <label for="subject_id" class="col-10 col-form-label">Der Inhalt gehört zu folgendem Fach</label>
                        <div class="col-10">
                            <select class="form-control" id="subject_id" name="subject_id">
                                <option value="{{$content->subject->id}}">{{$content->subject->subject_title}}</option>
				                @foreach ($subjects as $subject)	
					                <option value="{{$subject->id}}">{{$subject->subject_title}}</option>
				                @endforeach
                            </select>
                            @if ($errors->has('subject_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('topic_id') ? ' invalid' : '' }}">
                        <label for="topic_id" class="col-10 col-form-label">Der Inhalt gehört zu folgendem Thema</label>
                        <div class="col-10">
                            <select class="form-control" id="topic_id" name="topic_id">
                                <option value="{{$content->topic->id}}">{{$content->topic->topic_title}}</option>
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