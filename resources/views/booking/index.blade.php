@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Citas Agendadas ({{$appointments->count()}})</div>

                <div class="card-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Profesional</th>
                          <th scope="col">Hora</th>
                          <th scope="col">Fecha</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($appointments as $key => $appointment)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td>{{$appointment->professional->name}}</td>
                          <td>{{$appointment->time}}</td>
                          <td>{{$appointment->date}}</td>
                          <td>
                              @if($appointment->status==0)
                              <button class="btn btn-primary">Pendiente</button>
                              @else
                              <button class="btn btn-success"> Terminada</button>
                              @endif
                          </td>
                        </tr>
                        @empty
                        <td>No hay citas agendadas</td>
                        @endforelse

                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
