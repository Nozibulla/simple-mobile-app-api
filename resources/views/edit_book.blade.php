@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            <div class="panel-heading">Edit Book </div>

                <div class="panel-body">

                    <div class="main col-lg-6 col-lg-offset-3">

                        <div class="add_product">

                            {!! Form::model($book, ['action'=>['ProductController@updateProduct', $book->id ], 'method'=> 'PATCH', 'class' => 'form-horizontal', 'files' => true]) !!}

                            <div class="form-group @if($errors->first('book_name')) has-error @endif">
                                {!! Form::label('book_name', 'Product Name') !!}
                                {!! Form::text('book_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('book_name') }}</small>
                            </div>

                            <div class="form-group @if($errors->first('writer')) has-error @endif">
                                {!! Form::label('writer', 'Select Writer Name') !!}
                                {!! Form::select('writer', $writers, $book->writer_id, ['id' => 'writer', 'class' => 'form-control', 'required' => 'required']) !!}
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
                                {!! Form::file('thumbnail') !!}
                                <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                                <br />
                                {{  Html::image($book->thumbnail,'Image not found', array( 'width' => 70, 'height' => 70 )) }}
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


