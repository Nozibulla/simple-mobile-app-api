@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Add New Category</div>
				<div class="main panel-body">

				@include ('modals.edit_category')

					<div class="add_category col-lg-6 col-md-offset-3">
						{!! Form::open(['url'=>'/save_category', 'method'=> 'post', 'data-remote'=>'data-remote','data-remote-success'=>'Category saved successfully', 'class' => 'form-horizontal']) !!}

						<div class="form-group @if($errors->first('category')) has-error @endif">
							{!! Form::label('category', 'Category Name') !!}
							{!! Form::text('category', null, ['class' => 'form-control', 'required' => 'required']) !!}
							<small class="text-danger">{{ $errors->first('category') }}</small>
						</div>

						<div class="btn-group pull-right">
							{!! Form::submit("Insert", ['class' => 'btn btn-success']) !!}
						</div>

						{!! Form::close() !!}
					</div>

				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Category List</div>
				<div class="main panel-body">

					<div class="category_list">

					@if (count($categories)>0)

				<div class="table-responsive">

					<table class="table">

						<tr class="success">

							<td>Serial</td>

							<td>Category</td>

							<td>Edit</td>

							<td>Delete</td>

						</tr>

						@foreach ($categories as $key => $category)

						<tr>

							<td>{{ $key+1 }}</td>

							<td>{{ $category->name }}</td>

							<td >

								<a href="#" class="editClass" data-id="{{ $category->id }}" data-category-name="{{ $category->name }}" >
									Edit

								</a>

							</td>

							<td ><a href="#" class="deleteClass" data-id="{{ $category->id }}">Delete</a></td>

						</tr>

						@endforeach

					</table>

				</div>

				{!! $categories->render() !!}

				@else

				<h5>Sorry No category available yet.</h5>

				@endif


					</div>

				</div>
			</div>

		</div>
	</div>
</div>


@endsection