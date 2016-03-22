@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

				@include ('modals.edit_category')

			<div class="panel panel-default">
				<div class="panel-heading">Book List</div>
				<div class="main panel-body">

					<div class="book_list">

					@if (count($products)>0)

				<div class="table-responsive">

					<table class="table">

						<tr class="success">

							<td>Serial</td>

							<td>Book Name</td>

							<td>Categories</td>

							<td>Writer</td>

							<td>Edit</td>

							<td>Delete</td>

						</tr>

						@foreach ($products as $key => $product)

						<tr>

							<td>{{ $key+1 }}</td>

							<td>{{ $product->book_name }}</td>
							<td>@for ($x = 0; $x < count($product->categories); $x++){{ $product->categories[$x]['name'] }}, @endfor</td>
							<td>{{ $product->writer->writer }}</td>

							<td >

								<a href="/edit_product/{{ $product->id }}" class="editbook" data-id="{{ $product->id }}" data-product-name="{{ $product->book_name }}" >
									Edit

								</a>

							</td>

							<td ><a href="#" class="deletebook" data-id="{{ $product->id }}">Delete</a></td>

						</tr>

						@endforeach

					</table>

				</div>

				{!! $products->render() !!}

				@else

				<h5>Sorry No product available yet.</h5>

				@endif


					</div>

				</div>
			</div>

		</div>
	</div>
</div>


@endsection