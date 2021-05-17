@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              @if(Session::has('message'))
              <div class="alert alert-success">
                  {{Session::get('message')}}
              </div>
              @endif
              <div class="card-header" >
                    Citas: ({{$bookings->count()}})
                 </div>
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
                          <th scope="col">Professional</th>
                          <th scope="col">Estado</th>
                          <th scope="col">Ficha</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($bookings as $key=>$booking)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td><img src="/profile/{{$booking->user->image}}" width="80" style="border-radius: 50%;">
                          </td>
                          <td>
                             {{$booking->date}}
                          </td>
                          <td>{{$booking->user->name}}</td>
                          <td>{{$booking->user->email}}</td>
                          <td>{{$booking->user->phone}}</td>
                          <td>{{$booking->user->gender}}</td>
                          <td>{{$booking->time}}</td>
                          <td>{{$booking->professional->name}}</td>
                          <td>
                            @if($booking->status==1)
                              Finalizada
                            @endif
                          </td>
                          <td>
                              <!-- Button trigger modal -->

                          @if(!App\Models\Record::where('date',date('Y-m-d'))->where('professional_id',auth()->user()->id)->where('user_id',$booking->user->id)->exists())
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$booking->user_id}}">
                               Ficha
                          </button>
                          @include('record.form')

                          @else
                            <a href="{{route('record.show',[$booking->user_id,$booking->date])}}" class="btn btn-secondary">Ver Ficha
                            </a>
                          @endif


                          </td>
                        </tr>
                        @empty
                        <td>No hay citas</td>
                        @endforelse
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"defer></script>


@endsection
