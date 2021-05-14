@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

              <div class="card-header" >

                     Citas ({{$patients->count()}})
                 </div>

                <div class="card-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Foto</th>
                          <th scope="col">Fecha</th>
                          <th scope="col">Usuario</th>
                          <th scope="col">Email</th>
                          <th scope="col">Celular</th>
                          <th scope="col">Genero</th>

                          <th scope="col">Hora</th>
                          <th scope="col">Profesional</th>
                          <th scope="col">Estados</th>
                          <th scope="col">Ficha</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($patients as $key=>$patient)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td><img src="/profile/{{$patient->user->image}}" width="80" style="border-radius: 50%;">
                          </td>
                          <td>

</td>
                          <td>{{$patient->user->name}}</td>
                          <td>{{$patient->user->email}}</td>
                          <td>{{$patient->user->phone}}</td>
                          <td>{{$patient->user->gender}}</td>
                          <td>{{$patient->time}}</td>
                          <td>{{$patient->professional->name}}</td>
                          <td>
                            @if($patient->status==1)
                             Lista
                             @endif
                          </td>
                          <td>
                              <!-- Button trigger modal -->

                            <a href="{{route('record.show',[$patient->user_id,$patient->date])}}" class="btn btn-secondary">Ver Ficha</a>



                          </td>
                        </tr>
                        @empty
                        <td>No hay Citas</td>
                        @endforelse

                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
