@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Ultimas solicitudes')
@section('contenedor')

<div class="row">

<div class="col-sm-12 col-lg-12 col-md-12">

@if(Session::has('error'))

<div class="alert alert-danger">
	<strong>{{ Session::get('error') }}</strong>
</div>

@elseif( Session::has('correcto') )
<div class="alert alert-success">
	<strong>{{ Session::get('correcto') }}</strong>
</div>

@endif	

</div>

</div>
<div class="row clearfix">
<input type="hidden" id="modulo" value="solicitudes">
<input type="hidden" id="programa" value="solicitudes">
<input type="hidden" value="{{ csrf_token() }}" id="token">
	<input type="hidden" id="token" value="{{ csrf_token() }}">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				<div class="container-fluid">
					<form action="{{ url('dashboard/solicitudes/solicitudes/guardar') }}" method="post">
					<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
					{{ csrf_field() }}
					<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
						<div class="row">
							<div class="col-sm-12 col-md-4 col-lg-4 col-md-offset-2 col-lg-offset-2">
								<label for="">Asunto</label>
								<input type="text" placeholder="Asunto de la solicitud" class="form-control" name="asunto" required="" id="asunto">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4  ">
								<label for="">Fecha solicitada (dd-mm-aaaa)</label>
								<input type="date" required name="fecha_solicitada" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-4 col-lg-4 col-md-offset-2 col-lg-offset-2">
								<label for="">SEDE</label>
								<select name="sede_id" id="sede_id" class="form-control"  required>
								<option value="">-- SELECCIONE UNA --</option>
								@foreach(\DB::table('sedes')->get() as $key => $sede)
									<option value="{{ $sede->id }}">
										{{ $sede->nombre_sede }}
									</option>
								@endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-4 col-lg-4 col-md-offset-2 col-lg-offset-2">
								<label for="">CC / TI</label>
								<input type="text" class="form-control" name="cc" required id="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-md-offset-1 col-lg-offset-2">
								<label for="">Telefono</label>
								<input type="text" class="form-control" name="telefono" required id="">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-4 col-lg-4 col-md-offset-2 col-lg-offset-2">
								<label for="">Doctor</label>
								<input type="text" class="form-control" required name="nombre_doctor" required id="">
								<label for="">Nombre</label>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-md-offset-1 col-lg-offset-2">
								<label for="">&nbsp;</label>
								<input type="text" class="form-control" required name="apellido_doctor" required id="">
								<label for="">Apellido</label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2" >
								<label for="">Radiografias intraorales</label>
								<select name="radio_intraorales" id="" class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									<option value="Periapical Digital">Periapical Digital</option>
									<option value='Periapical Digital Milimetrada'>Periapical Digital Milimetrada</option>
									<option value="Juego de Periapical Completo">Juego de Periapical Completo</option>
                    
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-4 col-lg-4 col-md-offset-2 col-lg-offset-2" >
								<label for="">Oclusal</label>
								<select name="oclusal" id="oclusal" class="form-control" required>
									<option value="">-- SELECCIONE UNO --</option>
									<option value="Inferior">Inferior</option>
									<option value="Superior">Superior</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2" >
								<label for="">RADIOGRAFIAS EXTRAORALES</label>
								<select name="extraoral" id="extraoral" class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									<option value="Antero-Posterior">Antero-Posterior</option>
									<option value="Postero  Anterior">Postero  Anterior</option>
									<option value="Dinamica A.T.M.">Dinamica A.T.M.</option>
                    '',				<option value="Senos Nasales y Paranasales">Senos Nasales y Paranasales</option>
                    				<option value="Carpograma">Carpograma</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2" >
								<label for="">FOTOGRAFIA CLINICA</label>
								<select name="foto_clinica" id="foto_clinica" class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									<option value="Oclusal  Sup">Oclusal  Sup</option>
									<option value="Oclusal  Inf">Oclusal  Inf</option>
									<option value="Oclusal  Der">Oclusal  Der</option>
									<option value="Oclusal  Izq">Oclusal  Izq</option>
									<option value="Over Yet">Over Yet</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-lg-8 col-md-8 col-md-offset-2 col-lg-offset-2">
								<label for="">Descripcion</label>
								<textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control" required="" placeholder="Escriba aqui la necesidad de su solicitud"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-lg-8 col-md-8 col-md-offset-2 col-lg-offset-2">
								<label for="">Paquete de ortodoncia</label>
								<select name="paquete_ortodoncia" id="paquete_ortodoncia" class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									<option value="Opción 1 (Panorámica, lateral cráneo, modelos)">Opción 1 (Panorámica, lateral cráneo, modelos)</option>
									<option value="Opción 2 (Panorámica Fotografías (5) modelos)">Opción 2 (Panorámica Fotografías (5) modelos)</option>
									<option value="Opción 3 (Panorámica, lateral cráneo, Fotografías (5) modelos)">Opción 3 (Panorámica, lateral cráneo, Fotografías (5) modelos)</option>
									<option value="Opción 4 (Panorámica, lateral cráneo, Fotografías (8) modelos)">Opción 4 (Panorámica, lateral cráneo, Fotografías (8) modelos)</option>
									<option value="Opción 5 (Panorámica, lateral cráneo, Fotografías (8) modelos, Cefalometría)">Opción 5 (Panorámica, lateral cráneo, Fotografías (8) modelos, Cefalometría)</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-lg-3 col-md-3 col-md-offset-2 col-lg-offset-2">
								<label for="">Enviarme una copia al correo</label>
								<select name="copia" required="" id="" class="form-control">
									<option value="">-- SELECCIONE UNA --</option>
									<option value="S">Si</option>
									<option value="N">No</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
								<button class="btn btn-success" type="submit">
									<strong>Guardar</strong>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<section id="modals">
	<!-- Large Size -->
	<div class="modal fade" id="modal-usuarios" tabindex="-1" role="dialog">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	           	<div class="modal-header">
	                <h4 class="modal-title" id="largeModalLabel">Gestion de solicitudes</h4>
	            </div>
	            <div class="modal-body">
	             	<form action="#" method="solicitud" id="form-modal">
	             		

	             	</form>
	            </div>
	   		</div>
	    </div>
	</div>
</section>
@endsection
@section('jquery')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('public/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/js/inventario/inventario.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('public/js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});

function eliminar(e, boton){
	if(confirm('¿Usted esta seguro de eliminar esta publicacion?, una vez realizada esta accion no podra ser reversada')){
		var url = 'http://'+location.host+'/dashboard/solicitudes/solicitudes/eliminar'

		var token = document.getElementById('token').value
		$.solicitud(url, {'id': boton.getAttribute('data-id'), '_token':token}, function(resp){
			alert(resp.mensaje)
			if(! resp.error)
				location.reload()
		})
	}
}
</script>
@endsection