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
    <form action="{{url('/')}}" method="GET">
        <div class="card">
            <div class="card-body">
                <div class="card-header">Buscar Profesional</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" id="datepicker" name="date" class="form-control" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="card mt-3">
        <div class="card-body">
            <div class="card-header">Nuestro Equipo</div>
            <div class="card-body">
                @if(count($professionals)>0)
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Profesional</th>
                            <th>Área</th>
                            <th>Agendar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($professionals as $key => $professional)
                        <tr>
                            <td scope="row">{{$key+1}}</td>
                            <td><img src="{{asset('img/professionals')}}/{{$professional->professional->image}}" style="border-radius: 50%;object-fit: cover;width: 80px;height: 80px;"></td>
                            <td>{{$professional->professional->name}} {{$professional->professional->lastnames}}</td>
                            <td>{{$professional->professional->department}}</td>
                            <td><a href="{{route('create.appointment',[$professional->user_id,$professional->date])}}" class="btn btn-primary">Agendar</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="alert alert-warniing">Profesionales sin horas disponiibles</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
