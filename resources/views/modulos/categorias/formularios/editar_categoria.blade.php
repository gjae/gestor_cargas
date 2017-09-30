@php
$categoria = App\Models\Categoria::find($id);
@endphp
<div class="container">
	<div class="row">
		{{ csrf_field() }}
		<input type="hidden" name="accion" id="accion" value="editar">
		<input type="hidden" name="categoria_id" id="categoria_id" value="{{ $categoria->id }}">
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">NOMBRE DE LA CATEGORIA</label>
			<input type="text" required value="{{ $categoria->nombre_categoria }}" name="nombre_categoria" class="form-control" id="nombre_categoria">
		</div>
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">DESCRIPCION</label>
			<input type="text" required value="{{ $categoria->descripcion_categoria }}" name="descripcion_categoria" class="form-control" id="descripcion_categoria">
		</div>
	</div>
</div>