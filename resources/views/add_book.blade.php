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

                            {!! Form::open(['url'=>'/save_product', 'method'=> 'post', 'data-remote'=>'data-remote','data-remote-success'=>'Product saved successfully', 'file' => true, 'class' => 'form-horizontal']) !!}

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

                            <div class="form-group @if($errors->first('book')) has-error @endif">
                                {!! Form::label('book', 'Upload Book') !!}
                                {!! Form::file('book', ['required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('book') }}</small>
                            </div>

                            <div class="progress" style="display:none">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%">
                                    <span class="sr-only">100% Complete</span>
                                </div>
                            </div>


                            <div class="btn-group pull-right">
                                {!! Form::submit("Insert", ['class' => 'btn btn-success']) !!}
                            </div>

                            {!! Form::close() !!}

                        </div>

                        <!-- </div> -->
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


