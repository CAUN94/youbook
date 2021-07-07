@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Información') }}</div>

                <div class="card-body">
                    Hola {{Auth::user()->name}} {{Auth::user()->lastname}}. Tu plan de deporte es {{$training->name}} {{$training->format}}

                </div>
            </div>
        </div>
        <div class="col-md-6">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach

            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif

            @if(Session::has('errmessage'))
                <div class="alert alert-danger">
                    {{Session::get('errmessage')}}
                </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Plan') }}</div>
                <div class="card-body">
                    @if($training_user->settled)

                        @foreach($training->appointments as $appoinment)
                            @if($appoinment->status() == 0)
                                <form action="{{route('booking.train')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="getid" value="{{ $appoinment->id }}">
                                    <div style="display: block;margin: 0 0 10px 10px;">
                                        {{$appoinment->name}}
                                        {{$days_dias[date_format(date_create($appoinment->date), 'l')]}}
                                        {{$appoinment->time}}
                                        {{$appoinment->trainer()->name}}
                                        {{$appoinment->trainer()->lastnames}}
                                        <input type="submit" class="btn btn-primary ml-2" style="color:#fff;" value="Reservar">
                                    </div>
                                </form>
                            @else
                                <form action="{{route('delete.booking.train')}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="getid" value="{{ $appoinment->id }}">
                                    <div style="display: block;margin: 0 0 10px 10px;">
                                        {{$appoinment->name}}
                                        {{$days_dias[date_format(date_create($appoinment->date), 'l')]}}
                                        {{$appoinment->time}}
                                        <input type="submit" class="btn btn-success ml-2" style="color:#fff;" value="Cancelar">
                                    </div>
                                </form>
                            @endif
                        @endforeach
                        </form>

                    @else
                        Pago Pendiente
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
