<div class="container">
	<div class="row">
		{{ csrf_field() }}
		<input type="hidden" name="accion" value="quitar_autorizar">
		<input type="hidden" name="post_id" value="{{ $id }}">
		<div class="col-sm-12 col-lg-8 col-md-8">
			<label for="">USUARIOS RELACIONADOS CON LA PUBLICACION</label>
			<select name="user_id" id="user" class="form-control" required>
				<option value="">-- SELECCIONE UNO --</option>
				@foreach(App\Models\PostUser::where('post_id', $id)->where('edo_reg', 1)->get() as $post)
					<option value="{{ $post->user_id }}">
						@php
							$user = App\User::find($post->user_id);
							echo $user->nombre.' '.$user->apellido;
						@endphp
					</option>
				@endforeach
			</select>
		</div>
	</div>
</div>