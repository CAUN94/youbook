@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

              <div class="card-header" >


                </div>

                <div class="card-body">
                    <p>Fecha:{{$record->date}}</p>
                    <p>Paciente:{{$record->user->name}}</p>
                    <p>Profesional:{{$record->professional->name}}</p>
                    <p>Motivo Consulta:{{$record->motive}}</p>
                    <p>Sintomas:{{$record->symptoms}}</p>
                    <p>Receta o Ejercicio:{{$record->indications}}</p>
                    <p>Instruccioines:{{$record->instructions}}</p>
                    <p>Comentarios:{{$record->feedback}}</p>
                    <p>Firma:{{$record->signature}}</p>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
