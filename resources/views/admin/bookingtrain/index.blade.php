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
                    <div class="accordion accordion-flush border" id="accordionPanelsStayOpenExample">
                        @foreach($bookings as $book)
                        <div class="accordion-item ">
                            <h2 class="accordion-header" id="flush-headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#code{{$book->id}}" aria-expanded="false" aria-controls="code{{$book->id}}">
                                {{$book->train_appointment()->name}} &nbsp
                                {{$book->train_appointment()->date}} &nbsp
                                {{$book->train_appointment()->time}} &nbsp
                                {{$book->train_appointment()->training()->name}} &nbsp
                                {{$book->train_appointment()->training()->format}} &nbsp
                                @if($book->train_appointment()->status == 1)
                                    <span class="badge bg-success">Realizada</span>
                                @else
                                    <span class="badge bg-danger">No Realizada</span>
                                @endif
                              </button>
                            </h2>
                            <div id="code{{$book->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body">
                                <h5 class="card-title">
                                    {{$book->train_appointment()->name}}
                                    {{$book->train_appointment()->trainer()->name}}
                                    {{$book->train_appointment()->trainer()->lastnames}}
                                </h5>

                                <p>Estado:
                                @if($book->train_appointment()->status == 1)
                                  <a class="btn btn-sm btn-primary"  href="{{route('class.training.toogle',['id' => $book->train_appointment()->id])}}">Realizada</a>
                                @else
                                   <a class="btn btn-sm btn-primary" href="{{route('class.training.toogle',['id' => $book->train_appointment()->id])}}">No Realizada</a>
                                @endif
                                </p>
                                Estudiante registrados: {{$book->studentcount()}}
                                <ul class="list-group">
                                @foreach($book->student() as $student)
                                    <li class="list-group-item">{{$student->name}} {{$student->lastnames}}</li>
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
