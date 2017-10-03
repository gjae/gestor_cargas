<div class="container">
	<div class="row">
		{{ csrf_field() }}
		<input type="hidden" name="accion" value="autorizar">
		<input type="hidden" name="post_id" value="{{ $id }}">
		<div class="col-sm-12 col-lg-8 col-md-8">
			<label for="">USUARIOS DISPONIBLES</label>
			<select name="user_id" id="user" class="form-control" required>
				<option value="">-- SELECCIONE UNO --</option>
				@foreach(App\User::where('edo_reg', 1)->get() as $user)
					@php
						$tiene = App\Models\PostUser::where('post_id', $id)
												->where('user_id', $user->id)
												->where('edo_reg', 1)->get();

						if( count($tiene) > 0 ){
							continue;
						}
					@endphp					
					<option value="{{ $user->id }}">

						{{ $user->nombre.' '.$user->apellido  }} ( {{ $user->email }} )
					</option>
				@endforeach
			</select>
		</div>
	</div>
</div>