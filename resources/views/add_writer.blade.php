@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Add New Category</div>
				<div class="main panel-body">

				@include ('modals.edit_writer')

					<div class="add_writer col-lg-6 col-md-offset-3">
						{!! Form::open(['url'=>'/save_writer', 'method'=> 'post', 'data-remote'=>'data-remote','data-remote-success'=>'Writer saved successfully', 'class' => 'form-horizontal']) !!}

						<div class="form-group @if($errors->first('writer')) has-error @endif">
						    {!! Form::label('writer', 'Writer Name') !!}
						    {!! Form::text('writer', null, ['class' => 'form-control', 'required' => 'required']) !!}
						    <small class="text-danger">{{ $errors->first('writer') }}</small>
						</div>

						<div class="btn-group pull-right">
							{!! Form::submit("Insert", ['class' => 'btn btn-success']) !!}
						</div>

						{!! Form::close() !!}
					</div>

				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Writer List</div>
				<div class="main panel-body">

					<div class="writer_list">

					@if (count($writers)>0)

				<div class="table-responsive">

					<table class="table">

						<tr class="success">

							<td>Serial</td>

							<td>Writer</td>

							<td>Edit</td>

							<td>Delete</td>

						</tr>

						@foreach ($writers as $key => $writer)

						<tr>

							<td>{{ $key+1 }}</td>

							<td>{{ $writer->writer }}</td>

							<td >

								<a href="#" class="edit_writer" data-id="{{ $writer->id }}" data-writer-name="{{ $writer->writer }}" >
									Edit

								</a>

							</td>

							<td ><a href="#" class="delete_writer" data-id="{{ $writer->id }}">Delete</a></td>

						</tr>

						@endforeach

					</table>

				</div>

				{!! $writers->render() !!}

				@else

				<h5>Sorry No writer available yet.</h5>

				@endif


					</div>

				</div>
			</div>

		</div>
	</div>
</div>


@endsection