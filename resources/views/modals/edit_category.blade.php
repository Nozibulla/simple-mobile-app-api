<!-- Modal for editing an existing subject -->

<div class="modal fade" id="edit_category" tabindex="-1" role="dialog" aria-labelledby="editSubjectLabel">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">&times;</span></button>

					<h4 class="modal-title" id="editSubjectLabel"> Edit Category</h4>

				</div>

				{!! Form::open(['url'=>'/save_edited_category','data-remote'=>'data-remote','data-remote-success'=>'changes saved successfully']) !!}

				<div class="modal-body">

					<div class="form-group @if($errors->first('category')) has-error @endif">

						{!! Form::label('category', 'Category Name:') !!}

						{!! Form::text('category', null, ['class' => 'form-control category', 'required' => 'required','placeholder'=>'Enter Category','value'=>'']) !!}

						<small class="text-danger">{{ $errors->first('category') }}</small>

					</div>

					{!! Form::hidden("category_id",null, ['value'=>'','class'=>'category_id']) !!}

				</div>

				<div class="modal-footer">

					{!! Form::submit("Never Mind", ['class' => 'btn btn-default','data-dismiss'=>'modal']) !!}

					{!! Form::submit("Save Changes", ['class' => 'btn btn-primary btnGo']) !!}

				</div>

				{!! Form::close() !!}

			</div>

		</div>

	</div>