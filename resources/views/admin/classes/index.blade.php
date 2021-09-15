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
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseForm{{$plan->id}}" aria-expanded="false" aria-controls="collapseForm{{$plan->id}}">
                                    Crear Nueva Clase
                                </button>
                                </p>
                                <div>
                                  <div class="collapse collapse-horizontal" id="collapseWidth{{$plan->id}}">
                                    <div class="card card-body" style="width: 100%;">
                                        <ul class="list-group">
                                            @foreach($plan->monthAppointments() as $appointment)
                                                <li class="list-group-item d-flex">
                                                    {{$appointment->name}}
                                                    {{$appointment->date}}
                                                    {{$appointment->time}}
                                                    {{$appointment->trainer()->name}}
                                                    {{$appointment->trainer()->lastnames}}
                                                    <form method="post" class="ml-2" action="/booking/{{$appointment->id}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                        class="badge rounded-pill bg-danger"
                                                        onclick="return confirm('are you sure?')"
                                                        >Borrar</button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="mt-4">
                                  <div class="collapse collapse-horizontal" id="collapseForm{{$plan->id}}">
                                    <div class="card card-body" style="width: 100%;">
                                        <form action="{{url('/booking')}}" method="POST" class="row g-3 needs-validation" novalidate>
                                            @csrf
                                            <input name="plan" type="hidden" value="{{$plan->id}}">

                                          <div class="col-md-6">
                                            <label for="validationCustom01" class="form-label">Entrenador</label>
                                            <select class="form-select" name="train" aria-label="Default select example" required>>
                                              <option value='null' selected>Entrenador</option>
                                              @foreach(App\Models\User::alltrainers() as $trainer)
                                                <option value="{{$trainer->id}}">
                                                    {{$trainer->name}}
                                                    {{$trainer->lastnames}}
                                                </option>
                                              @endforeach
                                            </select>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="validationCustom01" class="form-label">Clase</label>
                                            <select class="form-select" name="class" aria-label="Default select example" required>
                                              <option value='null' selected>Clase</option>
                                              @foreach(App\Models\ TrainAppointments::all()->unique('name') as $class)
                                                <option value="{{$class->name}}">
                                                    {{$class->name}}
                                                </option>
                                              @endforeach
                                            </select>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="validationCustom02" class="form-label">Fecha</label>
                                            <input type="date" name="date" class="form-control" id="validationCustom02"  required>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="validationCustom02" class="form-label">Hora</label>
                                            <input type="time" name="time" class="form-control" id="validationCustom02"  required>
                                          </div>
                                          <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Cargar</button>
                                          </div>
                                        </form>
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
                    <h6 class="m-0 font-weight-bold text-primary">Crear Nueva Clase</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
