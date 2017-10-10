<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Activacion de cuenta</title>
</head>
<style>
	body{
		font-family: Helvetica;
	}
</style>
<body>
<h1>Bienvenido</h1>
<p>
	Se ha procesado la creacion de tu usuario dentro del sistema de <strong>CEROC</strong>, unicamente resta activar tu cuenta desde <a href="{{ url('account/active?token='.$user->active_token) }}"> <strong>AQUI</strong> </a>. <br>
	usuario: <strong>{{ $user->email }}</strong> .<br>
	usted debera ingresar una nueva clave al momento de activar su usuario.
</p>
<strong>Si el enlace superior no funciono, pruebe copiar la siguiente url en una pestaña del navegador: {{ url('account/active?token='.$user->active_token) }} </strong>

</body>
</html>