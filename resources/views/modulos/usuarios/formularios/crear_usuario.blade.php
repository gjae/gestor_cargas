<div class="container">
	<div class="row">
		<input type="hidden" name="accion" value="guardar" id="accion">
		<input type="hidden" name="active_token" value="{{ csrf_token() }}">
		{{ csrf_field() }}
		<div class="col-sm-12 col-md-4 col-lg-4">
			<label for="">NOMBRE(s)</label>
			<input type="text" maxlength="170" required name="nombre" id="nombre" class="form-control">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<label for="">APELLIDO(s)</label>
			<input type="text" maxlength="170" required name="apellido" id="apellido" class="form-control">
		</div>

	</div>

	<div class="row">
		<div class="col-sm-12 col-lg-3 col-md-3">
			<label for="">NOMBRE DE USUARIO</label>
			<input type="text" maxlength="100" class="form-control" required name="email" id="email">
		</div>
		<div class="col-sm-12 col-lg-3 col-md-3">
			<label for="">Correo</label>
			<input type="email" class="form-control" name="correo_electronico" id="correo_electronico" placeholder="Indique un correo electronico">
		</div>
		<div class="col-sm-12 col-lg-3 col-md-3">
			<label for="">TIPO DE USUARIO</label>
			<select name="tipo_usuario" required id="tipo_usuario" class="form-control">
				<option value="">-- SELECCIONE UNA --</option>
				<option value="ADMIN">ADMINISTRADOR</option>
				<option value="USER">USUARIO</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="">Clave del usuario</label>
			<input type="password" name="clave" required min="6" class="form-control">
		</div>
		<div class="col-sm-4">
			<label for="">Repita la clave</label>
			<input type="password" name="clave2" required min="6" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-4 col-md-4">
			<input type="hidden" value="{{ csrf_token() }}" minlength="6" maxlength="12" required name="password" class="form-control" id="password_1">
		</div>
	</div>
</div>