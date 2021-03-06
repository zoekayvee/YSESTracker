@extends('template')

@section('title')
  YSES Tracker
@stop

@section('includes')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('/css/login.css') }}">
@stop

@section('content')

<div class="container">
    <div class="container" id="login-panel">

        <img src="{{ asset('images/logo.png') }}" id="logo" alt="logo">

        @if($errors->any())
            <span class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </span>
        @endif
        <h2 id="welcome">Welcome to YSES Tracker</h2>
        {!! Form::open(['url' => 'account/login']) !!}

            <div class="form-group">
            {!! Form::label('email', 'Email:') !!}<br>
            {!! Form::email('email', null) !!}

            {!! Form::label('password', 'Password:') !!}<br>
            {!! Form::password('password', null) !!}
            </div>
            <br>

            {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
        <br>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Sign Up</button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Sign up</h4>
                    </div>

                    <div class="modal-body">
                        <div>
                        {!! Form::open(['url' => 'account/register']) !!}
                            <div class="form-group">
                            {!! Form::label('fname', 'First Name:') !!}
                            {!! Form::text('fname', null, ['class' => 'form-control']) !!}

                            {!! Form::label('mname', 'Middle Name:') !!}
                            {!! Form::text('mname', null, ['class' => 'form-control']) !!}

                            {!! Form::label('lname', 'Last Name:') !!}
                            {!! Form::text('lname', null, ['class' => 'form-control']) !!}

                            {!! Form::label('username', 'Username:') !!}
                            {!! Form::text('username', null, ['class' => 'form-control']) !!}

                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}

                            {!! Form::label('password', 'Password:') !!}
                            {!! Form::password('password', null, ['class' => 'form-control']) !!}

                            {!! Form::label('confirmpassword', 'Confirm Password:') !!}
                            {!! Form::password('confirmpassword', null, ['class' => 'form-control']) !!}


                            <br>

                            {!! Form::label('studno', 'Student Number:') !!}
                            {!! Form::text('studno', null, ['class' => 'form-control']) !!}

                            {!! Form::label('department', 'Department:') !!}
                            {!! Form::select('department', array('Executive Department'=>'Executive Department','Finance Department'=>'Finance Department','Human Resources Department'=>'Human Resources Department', 'Projects and Activites Department'=>'Projects and Activities Department', 'Scholastics Department'=>'Scholastics Department', 'Secretariat Department'=>'Secretariat Department','Visuals and Logistics Department'=>'Visuals and Logistics Department'), null, ['class' => 'form-control']) !!}

                            <br>

                            {!! Form::label('batch', 'YSES Batch:') !!}
                            {!! Form::select('batch', array('4tified'=>'4tified','blendeD'=>'blendeD','Jenga'=>'Jenga','Prautes Canonical'=>'Prautes Canonical','RAMpage'=>'RAMpage','rainByte'=>'rainByte'), null, ['class' => 'form-control']) !!}

                            {!! Form::hidden('debt', '0') !!}
                            {!! Form::hidden('standing', 'unconfirmed') !!}

                            <br><br>
                            {!! Form::submit('Register', ['class' => 'btn btn-primary form-control']) !!}

                            </div>
                        {!! Form::close() !!}

                        @if($errors->any())
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
