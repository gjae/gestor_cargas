@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de requisiciones')
@section('contenedor')

<div class="row clearfix">
	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="card">
	
	<div class="body">
		<form action="#" method="post" id="form-requisicion">
			{{ csrf_field() }}
			<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
			<div class="container">
				
				<div class="row">
					<div class="col-sm-3 col-md-3 col-lg-3">
						<label for="">Codigo dela requisicion</label>
						<input style="text-align: center;" type="text" class="form-control" id="codigo_requisicion" name="codigo_requisicion" value="{{ $codigo }}" readonly="">
					</div>
					<div class="col-sm-5 col-md-5 col-lg-5">
						<label for="">Fecha requerida (AAAA-MM-DD / DD-MM-AAAA)</label>
						<input style="text-align: center;" type="date" placeholder="Fecha que se requiere el material"  class="form-control" id="fecha_requerida" name="fecha_requerida">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<label for="">Tipo de requisicion</label>
						<select id="tipo_requisicion" class="form-control" name="tipo_requisicion">
							<option value="BIENES">Bienes / Materiales</option>
							<option value="SERVICIOS">Servicios</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-11 col-md-11 col-lg-11">
						<label for="">Concepto de la requisicion</label>
						<input type="text" placeholder="Concepto" name="concepto_requisicion" id="concepto_requisicion" class="form-control">
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4 col-md-4 col-lg-4">
						<a class="btn btn-success" onclick="agregarFila(event, this)" id="agregar_fila">AGREGAR BIENES</a>

					</div>
					<div class="col-sm-4 col-md-4 col-lg-4">
						<a  class="btn btn-primary disabled" id="guardar" onclick="guardar(event, this)">
							GUARDAR REQUISICION
						</a>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4">
						<a  class="btn btn-primary" id="guardar" onclick="calcular(event, this)">
							CALCULAR REQUISICION
						</a>	
					</div>
				</div>
				<div class="row">
					
					<div class="col-sm-11 col-md-11 col-lg-11">
						
						<table class="table table-bordered table-responsive table-striped table-hover">
							<thead>
								<tr>
									<th>CODIGO</th>
									<th>DESCRIPCION</th>
									<th>U. MEDIDA</th>
									<th>CANTIDAD</th>
									<th>COSTO ESTIMADO</th>
									<th>% IMPUESTOS</th>
									<th>TOTAL</th>
								</tr>
							</thead>
							<tbody id="filas_detalles"></tbody>
						</table>

					</div>

				</div>

				<div class="row">
					<div class="col-sm-4 col-md-4 col-lg-4">
						<label for="">Sub-Total</label>
						<input type="text" class="form-control" name="sub_total" readonly="" id="sub_total">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-4 col-lg-4">
						<label for="">Total impuesto</label>
						<input type="text" class="form-control" id="total_impuestos" name="total_impuestos" readonly="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-4 col-lg-4">
						<label for="">Total requisicion</label>
						<input type="text" class="form-control" name="total_requisicion" readonly="" id="total_requisicion">
					</div>
				</div>

			</div>

		</form>
	</div>

</div>

</div>

</div>

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

<script src="{{ asset('js/requisiciones/requisicion.js') }}"></script>

@endsection