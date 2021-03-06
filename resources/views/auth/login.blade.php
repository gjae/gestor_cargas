@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('correcto'))
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="alert alert-success">
                    <strong> {{ Session::get('correcto') }} </strong>
                </div>
            </div>
            @elseif(Session::has('error'))
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="alert alert-danger">
                    <strong> {{ Session::get('error') }} </strong>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
       <div class="col-md-8 col-md-offset-2">
            <img src="{{ asset('images/user-img-background4.jpeg') }}" alt="" class="img-responsive">
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inicio de sesion</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Clave</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
