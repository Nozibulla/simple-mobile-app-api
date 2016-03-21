@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            <h1>In Maintenance Mode Come back later</h1>
            <div class="panel-heading"> This section still not done yet! Work on progress </div>

                <div class="panel-body">
                    <div class="main col-lg-6 col-md-offset-3">

                        <div class="add_product">

                            {!! Form::model($book, ['action'=>['ProductController@updateProduct', $book->id ], 'method'=> 'PATCH', 'class' => 'form-horizontal']) !!}

                            <div class="form-group @if($errors->first('book_name')) has-error @endif">
                                {!! Form::label('book_name', 'Product Name') !!}
                                {!! Form::text('book_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('book_name') }}</small>
                            </div>

                            <div class="form-group @if($errors->first('writer')) has-error @endif">
                                {!! Form::label('writer', 'Select Writer Name') !!}
                                {!! Form::select('writer', $writers, null, ['id' => 'writer', 'class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('writer') }}</small>
                            </div>

                            <div class="form-group @if($errors->first('book_link')) has-error @endif">
                                {!! Form::label('book_link', 'Book Link') !!}
                                {!! Form::text('book_link', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('book_link') }}</small>
                            </div>

                            <div class="form-group @if($errors->first('category')) has-error @endif">
                                {!! Form::label('category_list', 'Select Categories') !!}
                                {!! Form::select('category_list[]', $categories, null, ['id' => 'category_id', 'class' => 'form-control', 'required' => 'required', 'multiple']) !!}
                                <small class="text-danger">{{ $errors->first('category') }}</small>
                            </div>

                            <div class="form-group @if($errors->first('thumbnail')) has-error @endif">
                                {!! Form::label('thumbnail', 'Book Thumbnail') !!}
                                {!! Form::file('thumbnail', ['required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                            </div>

                            <div class="btn-group pull-right">
                                {!! Form::submit("Insert", ['class' => 'btn btn-success']) !!}
                            </div>

                            {!! Form::close() !!}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')

    <script type="text/javascript">

        $('#category_id').select2();

    </script>

@endsection


