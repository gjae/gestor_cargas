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
        @endif
    </div>
    <div class="row">
       <div class="col-md-8 col-md-offset-2">
            <img src="{{ app('config')->get('app')['url'].'/images/user-img-background4.jpeg' }}" alt="" class="img-responsive">
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Ya casi! solo completa el formulario </div>

                <div class="panel-body">
                    <form class="form-horizontal" onsubmit="verificar_datos(event, this)" method="POST" action="{{ url('account/active_save') }}">
                    	<input type="hidden" name="user_id" value="{{ ($user)? $user->id :'' }}">
                        {{ csrf_field() }}

						@if(Session::has('correcto'))
							<input type="hidden" name="token" value="{{ $token }}">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-12 col-md-8 col-md-offset-2">
										<label for="">Ingrese su nueva clave</label>
										<input type="password" placeholder="Ingrese su nueva clave" class="form-control" id="password" name="password" required="Usted necesita ingresar su nueva clave" id="password">
									</div>
									<div class="col-sm-12 col-md-8 col-md-offset-2">
										<label for="">Vuelva a ingresar su clave</label>
										<input type="password" id="password2" placeholder="Ingrese su nueva clave" class="form-control" name="password2" required="Usted necesita ingresar su nueva clave" id="password">
									</div>

			                        <div class="form-group" style="margin-top: 13px;">
			                            <div class="col-md-8 col-md-offset-2">
			                            	<br>
			                                <button type="submit" class="btn btn-primary btn-block">
			                                    Aceptar
			                                </button>
			                            </div>
			                        </div>
								</div>
							</div>

							@elseif(Session::has('user_correcto'))

							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-12 col-md-8 col-md-offset-2">
										<div class="alert alert-success">
											<strong>
												{{ Session::get('user_correcto') }} 
												<a href="{{ url('dashboard') }}">
													Click aqui
												</a>
											</strong>
										</div>
									</div>
								</div>
							</div>
							@elseif(Session::has('error_user'))
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-12 col-md-8 col-md-offset-2">
										<div class="alert alert-danger">
											<strong>
												{{ Session::get('error_user') }} 
												<a href="{{ url('dashboard') }}">
													Click aqui
												</a>
											</strong>
										</div>
									</div>
								</div>
							</div>
						@endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
	function verificar_datos(e , formulario){
		
		e.preventDefault()
		var ps = document.getElementById('password');
		var ps2 = document.getElementById('password2');


		if(ps.value == ps2.value && ps.value != ''){
			if(confirm('¿Seguro que desea realizar esta accion?'))
			{
				formulario.setAttribute('onsubmit', '')
				formulario.submit()
			}
		}else{
			alert("LAS CONTRASEÑAS NO COINCIDEN");
			e.preventDefault();
			return false;
		}
	}
</script>