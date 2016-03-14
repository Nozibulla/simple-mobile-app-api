<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container col-lg-4 col-md-offset-4">

            <div class="add_product">

            {!! Form::open(['url'=>'/save_product', 'method'=> 'post', 'data-remote'=>'data-remote','data-remote-success'=>'Student saved successfully', 'class' => 'form-horizontal']) !!}

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

                <div class="form-group @if($errors->first('category')) has-error @endif">
                    {!! Form::label('category', 'Category') !!}
                    {!! Form::text('category', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('category') }}</small>
                </div>

                <div class="form-group @if($errors->first('thumbnail')) has-error @endif">
                    {!! Form::label('thumbnail', 'Book Thumbnail') !!}
                    {!! Form::file('thumbnail', ['required' => 'required']) !!}
                    <p class="help-block">Help block text</p>
                    <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                </div>

                <div class="btn-group pull-right">
                    {!! Form::submit("Insert", ['class' => 'btn btn-success']) !!}
                </div>

            {!! Form::close() !!}

            </div>

        </div>
        <script
              src="https://code.jquery.com/jquery-2.2.1.min.js"
              integrity="sha256-gvQgAFzTH6trSrAWoH1iPo9Xc96QxSZ3feW6kem+O00="
              crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>
