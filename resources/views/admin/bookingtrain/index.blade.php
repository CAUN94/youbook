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
                    <h6 class="m-0 font-weight-bold text-primary">Clases agendadas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="accordion accordion-flush border" id="accordionPanelsStayOpenExample">
                        @foreach($trainAppointments as $trainAppointment)
                        <div class="accordion-item ">
                            <h2 class="accordion-header" id="flush-headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#code{{$trainAppointment->id}}" aria-expanded="false" aria-controls="code{{$trainAppointment->id}}">
                                {{$trainAppointment->name}} &nbsp
                                {{$trainAppointment->date}} &nbsp
                                {{$trainAppointment->time}} &nbsp
                                {{$trainAppointment->training()->name}} &nbsp
                                {{$trainAppointment->training()->format}} &nbsp
                                @if($trainAppointment->status == 1)
                                    <span class="badge bg-success">Realizada</span>
                                @else
                                    <span class="badge bg-danger">No Realizada</span>
                                @endif
                              </button>
                            </h2>
                            <div id="code{{$trainAppointment->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body">
                                <h5 class="card-title">
                                    {{$trainAppointment->name}}
                                    {{$trainAppointment->trainer()->name}}
                                    {{$trainAppointment->trainer()->lastnames}}
                                </h5>

                                <p>Estado:
                                @if($trainAppointment->status == 1)
                                  <a class="btn btn-sm btn-primary"  href="{{route('class.training.toogle',['id' => $trainAppointment->id])}}">Realizada</a>
                                @else
                                   <a class="btn btn-sm btn-primary" href="{{route('class.training.toogle',['id' => $trainAppointment->id])}}">No Realizada</a>
                                @endif
                                </p>
                                Estudiante registrados: {{$trainAppointment->bookscount()}}
                                <ul class="list-group">
                                @foreach($trainAppointment->books() as $book)
                                    <li class="list-group-item">
                                        {{$book->student()['id']}}
                                        {{$book->student()['lastnames']}}
                                        {{$book->id}}
                                        @if($book->status == 1)
                                            <a href="{{route("admin.training.toogleid",["id" => $book->id])}}"><button class="badge bg-success"> Asistio</button></a>
                                          @else
                                            <a href="{{route("admin.training.toogleid",["id" => $book->id])}}"><button class="badge bg-danger"> No Asistio</button></a>
                                          @endif
                                    </li>
                                @endforeach
                                </ul>

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
                    <h6 class="m-0 font-weight-bold text-primary">Resumen</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
