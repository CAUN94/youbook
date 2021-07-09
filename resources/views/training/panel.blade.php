@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Datos Entrenamiento</div>
                <div class="card-body">
                    <p>Prestación medilink: {{$summary['Prestación']}}</p>
                    <p>Abono medilink: {{$summary['Abono']}}</p>
                    <p>Pagos YouBook: {{$sum}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Datos Clases</div>
                <div class="card-body">
                    @foreach($trainings as $training)
                        @php
                            $train = App\Models\Training::find($training)
                        @endphp
                        <p>
                            <b>{{$train->name}}: {{$train->hasStudents()}} x {{$train->monedaPrice()}}</b>
                            <br>
                            @foreach($train->hasAppointments as $appoinment)
                                @if($appoinment->booksCount() > 0)
                                    {{$appoinment->name}} {{$appoinment->time}} {{$appoinment->date}} {{$appoinment->trainer()->name}} {{$appoinment->trainer()->lastnames}} {{$appoinment->booksCount()}}<br>
                                @endif
                            @endforeach
                        </p>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
