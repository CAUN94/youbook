@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{asset('img/you-completo-nn.png')}}" class="img-fluid" style="border:1px solid #ccc;">
            <div class="mt-5">
               <a href="{{url('/register')}}"> <button class="btn btn-success">Registrarme</button></a>
                <a href="{{url('/login')}}"><button class="btn btn-secondary">Iniciar Sesión</button></a>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Crear Cuenta o Agendar hora</h2>
            <p>You, Just Better es un centro integral de salud y medicina deportiva que promueve los estilos de vida saludables. Desde su fundación en agosto de 2018, You busca reubicar el foco de la salud hacia las personas, poniendo al paciente en el centro de la atención en salud y personalizando sus servicios. Con una visión basada en el nuevo paradigma de la salud informática y centrada en la tecnología (Salud 4.0 o healthtech), You trabaja en el desarrollo tecnológico en la salud y en la creación de medios digitales que permiten lograr la personalización y la atención de alto valor centrada en el paciente en todo el proceso de atención en salud.</p>

        </div>
    </div>
    <hr>
    {{-- Vue --}}
    <find-professional></find-professional>

</div>

@endsection
