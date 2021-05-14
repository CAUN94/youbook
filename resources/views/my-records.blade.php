@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My prescriptions</div>

                <div class="card-body">

                  <table class="table table-striped">
                      <thead>
                        <tr>

                          <th scope="col">Fecha</th>
                          <th scope="col">Professional</th>
                          <th scope="col">Motivo</th>
                          <th scope="col">Sintomas</th>
                          <th scope="col">Recomendaciones</th>
                          <th scope="col">Instrucciones</th>
                          <th scope="col">Comentarios</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($records as $record)
                        <tr>

                          <td>{{$record->date}}</td>
                          <td>{{$record->professional->name}}</td>
                          <td>{{$record->motive}}</td>
                          <td>{{$record->symptoms}}</td>
                          <td>{{$record->indications}}</td>
                          <td>{{$record->instructions}}</td>
                          <td>{{$record->feedback}}</td>
                        </tr>
                        @empty
                        <td>No hay fichas</td>
                        @endforelse

                      </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
