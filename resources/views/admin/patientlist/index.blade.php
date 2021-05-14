@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     Horas ({{$bookings->count()}})
                 </div>
                <form action="{{route('patient')}}" method="GET">

                 <div class="card-header">
                     Fecha:&nbsp
                     <div class="row">
                       <div class="col-md-10">
                           <input type="text" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="date" autocomplete="off">
                       </div>
                       <div class="col-md-2">
                          <button type="submit" class="btn btn-primary">Buscar</button>
                       </div>
                    </div>

                 </div>
                 </form>



                <div class="card-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Foto</th>
                          <th scope="col">Fecha</th>
                          <th scope="col">Paciente</th>
                          <th scope="col">Email</th>
                          <th scope="col">Telefono</th>
                          <th scope="col">Genero</th>

                          <th scope="col">Hora</th>
                          <th scope="col">Profesional</th>
                          <th scope="col">Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($bookings as $key=>$booking)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td>
                            <img src="/profile/{{$booking->user->image}}" width="80" style="border-radius: 50%;">
                          </td>
                          <td>{{$booking->date}}</td>
                          <td>{{$booking->user->name}}</td>
                          <td>{{$booking->user->email}}</td>
                          <td>{{$booking->user->phone}}</td>
                          <td>{{$booking->user->gender}}</td>
                          <td>{{$booking->time}}</td>
                          <td>{{$booking->professional->name}}</td>
                          <td>
                              @if($booking->status==0)
                              <a href="{{route('update.status',[$booking->id])}}"><button class="btn btn-primary"> No Atendido</button></a>
                              @else
                               <a href="{{route('update.status',[$booking->id])}}"><button class="btn btn-success"> Atendido</button></a>
                              @endif
                          </td>
                        </tr>
                        @empty
                        <td>No Hay Horas</td>
                        @endforelse

                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
