@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

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
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<a href="{{ url('dashboard/solicitudes/solicitudes/nueva') }}" class="btn btn-success">
								<strong>CREAR SOLICITUD</strong>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="table-responsive">
							<table class="table table-stripped" id="dataTables-example">  
								<thead>
									<tr>
										<th>Asunto</th>
										<th>Fecha registrada</th>
										<th>Fecha solicitada</th>
									</tr>
								</thead>
								<tbody>
									@foreach($solicitudes as $key => $solicitud)
										<tr>
											<td>{{ $solicitud->asunto }}</td>
											<td>{{ $solicitud->created_at->format('d-m-Y h:m:i a') }}</td>
											<td>{{ $solicitud->fecha_solicitada->format('d-m-Y') }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
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
<script src="{{ asset('/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
<script src="{{ asset('/js/inventario/inventario.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('/js/demo.js') }}"></script>
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