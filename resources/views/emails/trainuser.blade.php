Hola <strong>{{ $user->name }}</strong>,

<p>
	@if($user->gender == 'masculino')
		Bienvenido
	@elseif($user->gender == 'femenino')
		Bienvenida
	@else
		Bienvenide
	@endif
	al plan '{{$info->name}} {{$info->format}}'.
	<br><br>
	Recuerda que tu plan se activará cuando pages la mensualidad de {{$price}} en http://yjb.cl/pago.
	<br><br>
	saludos,<br>
	TeamYou
</p>
