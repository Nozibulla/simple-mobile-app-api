<!-- Modal for editing an existing subject -->

<div class="modal fade" id="edit_writer" tabindex="-1" role="dialog" aria-labelledby="editSubjectLabel">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">&times;</span></button>

					<h4 class="modal-title" id="editSubjectLabel"> Edit Writer</h4>

				</div>

				{!! Form::open(['url'=>'/save_edited_writer','data-remote'=>'data-remote','data-remote-success'=>'changes saved successfully']) !!}

				<div class="modal-body">

					<div class="form-group @if($errors->first('writer')) has-error @endif">
					    {!! Form::label('writer', 'Writer Name') !!}
					    {!! Form::text('writer', null, ['class' => 'form-control writer', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('writer') }}</small>
					</div>

					{!! Form::hidden("writer_id",null, ['value'=>'','class'=>'writer_id']) !!}

				</div>

				<div class="modal-footer">

					{!! Form::submit("Never Mind", ['class' => 'btn btn-default','data-dismiss'=>'modal']) !!}

					{!! Form::submit("Save Changes", ['class' => 'btn btn-primary btnGo']) !!}

				</div>

				{!! Form::close() !!}

			</div>

		</div>

	</div>