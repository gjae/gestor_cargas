<div class="container">
	<div class="row">
		{{ csrf_field() }}
		<input type="hidden" name="accion" id="accion" value="guardar">
		<input type="hidden" name="user_id" id="accion" value="{{ Auth::user()->id }}">
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">NOMBRE DE LA CATEGORIA</label>
			<input type="text" required name="nombre_categoria" class="form-control" id="nombre_categoria">
		</div>
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">DESCRIPCION</label>
			<input type="text" required name="descripcion_categoria" class="form-control" id="descripcion_categoria">
		</div>
	</div>
</div>