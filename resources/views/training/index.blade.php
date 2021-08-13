@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Información') }}</div>
                <div class="card-body">
                    <p class="card-text">Hola {{Auth::user()->name}},</p>
                    <p>Tu plan es {{$training->name}} {{$training->format}}</p>
                    <p>{{$training->description}}</p>
                    @if($training_user->settled)
                        <a href="#" class="badge badge-success">Pagado</a>
                    @else
                        <a href="{{url('/padpow')}}" class="badge badge-danger">Por Pagar</a>
                    @endif
                    <a href="#" class="badge badge-info">Cambiar Plan</a>
                    <form class="d-inline" method="post" action="/training">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="getid" value="{{ Auth::user()->id }}">
                        <span class="badge badge-secondary"><button type="submit">Desinscribirme</button></span>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach

            @if(Session::has('errmessage'))
                <div class="alert alert-danger">
                    {{Session::get('errmessage')}}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    {{ __('Clases') }}
                    @if(Session::has('message'))
                        <span class="ml-2 badge rounded-pill bg-primary" style="color:#fff;">
                            {{Session::get('message')}}
                        </span>
                    @endif
                </div>
                <div class="card-body">
                    @if($training_user->settled)
                        <table class="table table-hover table-striped table-borderless ">
                            @foreach($training->appointments as $appoinment)
                                @if($appoinment->status() == 0)
                                    <tr>
                                @else
                                    <tr class="table-success">
                                @endif
                                    <td>{{$days_dias[date_format(date_create($appoinment->date), 'l')]}}
                                    {{$appoinment->time}}</td>
                                    <td>
                                        {{$appoinment->name}} con
                                        {{$appoinment->trainer()->name}}
                                        {{$appoinment->trainer()->lastnames}}
                                    </td>
                                    <td>

                                            @csrf

                                            <span class="badge badge-secondary">
                                                @if($appoinment->status() == 0)
                                                    <form action="{{route('booking.train')}}" method="post">@csrf
                                                    <input type="hidden" name="getid" value="{{ $appoinment->id }}">
                                                    <input type="submit" style="color:#fff;" value="Reservar">
                                                @else
                                                    <form action="{{route('delete.booking.train')}}" method="post">
                                                    @csrf @method('DELETE')
                                                    <input type="hidden" name="getid" value="{{ $appoinment->id }}">
                                                    <input type="submit" style="color:#fff;" value="Cancelar">
                                                @endif
                                            </span>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        Pago Pendiente
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
