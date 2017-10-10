<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Solicitud de servicio</title>
</head>
<body>
<style>
	body{
		font-family: Helvetica;
	}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr bgcolor="#008D92" style="text-align: center; color: #fff;">
		<td height="120px">
			<h1>CONTACTO DE UN CLIENTE</h1>
		</td>
	</tr>
	<tr>
		<td>
			<br>
		</td>
	</tr>
	<tr style="text-align: justify;">
		<td>
			¡Feliz dia!
			<p>
				El usuario <strong>{{ $user->nombre.' '.$user->apelllido }}</strong> ha enviado un correo solicitando atencion, acontinuacion se agrega los detalles:
				<br>
				<strong>Asunto: {{ $req->asunto }}</strong><br>
				<strong>Fecha registrada en el sistema: {{ $registro->created_at->format('d-m-Y h:m:i A') }}</strong><br>
				<strong>Fecha solicitada: {{ $registro->fecha_solicitada->format('d-m-Y') }}</strong><br>
				<strong>Descripcion: {{ $req->descripcion }}</strong>
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