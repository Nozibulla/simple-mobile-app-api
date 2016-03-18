@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            <div class="panel-heading">Insert Product</div>

                <div class="panel-body">
                    <div class="main col-lg-6 col-md-offset-3">

                        <div class="add_product">

                            {!! Form::open(['url'=>'/save_product', 'method'=> 'post', 'data-remote'=>'data-remote','data-remote-success'=>'Product saved successfully', 'class' => 'form-horizontal']) !!}

                            <div class="form-group @if($errors->first('product_name')) has-error @endif">
                                {!! Form::label('product_name', 'Product Name') !!}
                                {!! Form::text('product_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('product_name') }}</small>
                            </div>

                            <div class="form-group @if($errors->first('writer')) has-error @endif">
                                {!! Form::label('writer', 'Writer Name') !!}
                                {!! Form::text('writer', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('writer') }}</small>
                            </div>

                            <div class="form-group @if($errors->first('book_link')) has-error @endif">
                                {!! Form::label('book_link', 'Book Link') !!}
                                {!! Form::text('book_link', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('book_link') }}</small>
                            </div>

                            <div class="form-group @if($errors->first('category')) has-error @endif">
                                {!! Form::label('category', 'Select Categories') !!}
                                {!! Form::select('category[]', $categories, null, ['id' => 'category_id', 'class' => 'form-control', 'required' => 'required', 'multiple']) !!}
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


