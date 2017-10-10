@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Ultimas publicaciones hechas')
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
<input type="hidden" value="{{ csrf_token() }}" id="token">
	<input type="hidden" id="token" value="{{ csrf_token() }}">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				<div class="container">
					<form action="{{ url('dashboard/publicaciones/publicaciones/salvar') }}" method="post" enctype="multipart/form-data" id="crear">
					{{ csrf_field() }}
					<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
						<div class="row">
							<div class="col-sm-12 col-md-7 col-lg-7">
								<label for="">TITULO DE LA PUBLICACION</label>
								<input type="" class="form-control" name="titulo_post" maxlength="180" required id="titulo_post">
							</div>
							<div class="col-sm-12 col-lg-3 col-md-3">
								<label for="">CATEGORIA</label>
								<select name="categoria_id" id="categoria_id" class="form-control" required>
									<option value="">-- SELECCIONE UNA --</option>
									@foreach($categorias as $key => $categoria)
										<option value="{{ $categoria->id }}">
											{{ $categoria->nombre_categoria }}
										</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<section id="archivos">
								<div class="col-sm-12 col-md-4 col-lg-4">
									<label for="">ARCHIVO</label>
									<input type="file" name="archivo[]" onchange="agregarOtroArchivo(event, this)" class="form-control">
								</div>
							</section>
						</div>
						<div class="row">
							<div class="col-sm-12 col-lg-10 col-md-10">
								<textarea name="descripcion_post" id="descripcion_post" cols="30" rows="22" class="form-control"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-5 col-lg-6">
								<input type="submit" class="btn btn-success" value="GUARDAR">
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
	<div class="modal fade" id="modal-inventario" tabindex="-1" role="dialog">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	           	<div class="modal-header">
	                <h4 class="modal-title" id="largeModalLabel">Gestion de inventario</h4>
	            </div>
	            <div class="modal-body">
	             	<form action="#" id="form-modal">
	             		

	             	</form>
	            </div>
	            <div class="modal-footer">
	            	<div id="footer-datos">
		                <button type="button" id="salvar" class="btn btn-link waves-effect">Guardar datos</button>
		                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
	                </div>
	                <div id="footer-reportes" class="hidden">
		                <button type="button" id="reporte" class="btn btn-link waves-effect">Generar reporte</button>
		                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
	                </div>
	            </div>
	   		</div>
	    </div>
	</div>
</section>
@endsection
@section('jquery')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/inventario/inventario.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});

function eliminar(e, boton){
	if(confirm('¿Usted esta seguro de eliminar esta publicacion?, una vez realizada esta accion no podra ser reversada')){
		var url = 'http://'+location.host+'/dashboard/publicaciones/publicaciones/eliminar'

		var token = document.getElementById('token').value
		$.post(url, {'id': boton.getAttribute('data-id'), '_token':token}, function(resp){
			alert(resp.mensaje)
			if(! resp.error)
				location.reload()
		})
	}
}

function agregarOtroArchivo(event, input){
	var input = `
		
		<div class="col-sm-12 col-md-4 col-lg-4">
			<label for="">ARCHIVO</label>
			<input type="file" name="archivo[]" onchange="agregarOtroArchivo(event, this)" class="form-control">
		</div>
	`

	$("#archivos").append(input)
}
</script>
@endsection