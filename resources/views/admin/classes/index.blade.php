@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Planes</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="accordion" id="accordionFlushExample">
                        @foreach($plans as $plan)
                        <div class="accordion-item ">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$plan->id}}" aria-expanded="false" aria-controls="collapse{{$plan->id}}">
                                {{$plan->name}}<strong>&nbsp
                                {{$plan->format}}</strong>&nbsp
                                <span class="badge bg-primary rounded-pill">Estudiantes: {{$plan->hasStudents()}}</span>
                              </button>
                            </h2>
                            <div id="collapse{{$plan->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$plan->id}}" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                               <p>Description: {{$plan->description}}</p>
                               <p>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidth{{$plan->id}}" aria-expanded="false" aria-controls="collapseWidth{{$plan->id}}">
                                    Clases del Mes
                                </button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidth{{$plan->id}}" aria-expanded="false" aria-controls="collapseWidth{{$plan->id}}">
                                    Crear Nueva Clase
                                </button>
                                </p>
                                <div>
                                  <div class="collapse collapse-horizontal" id="collapseWidth{{$plan->id}}">
                                    <div class="card card-body" style="width: 800px;">
                                        <ul class="list-group">
                                            @foreach($plan->monthAppointments() as $appointment)
                                                <li class="list-group-item">
                                                    {{$appointment->name}}
                                                    {{$appointment->date}}
                                                    {{$appointment->time}}
                                                    {{$appointment->trainer()->name}}
                                                    {{$appointment->trainer()->lastnames}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Lorem</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
