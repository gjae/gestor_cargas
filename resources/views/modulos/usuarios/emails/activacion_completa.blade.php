<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Activacion completada</title>
</head>
<style>
	body{
		font-family: Helvetica;
	}
</style>
<body>
	
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr bgcolor="#008D92" style="text-align: center; color: #fff;">
		<td height="120px">
			<h1>ACTIVACION COMPLETA</h1>
		</td>
	</tr>
	<tr>
		<td>
			<br>
		</td>
	</tr>
	<tr style="text-align: justify;">
		<td>
			¡Hola {{ $user->nombre.' '.$user->apellido }}!
			<p>
				Tu cuenta ha sido <strong>activada</strong> correctamente, ya puedes comenzar a usarla, te damos la bienvenida formal a nuestra plataforma.
			</p>
		</td>
	</tr>
	<tr style="text-align: center;">
		<td>
			<strong>Este es un correo enviado de manera automatica, por favor, no responda.</strong>
		</td>
	</tr>
</table>

</body>
</html>