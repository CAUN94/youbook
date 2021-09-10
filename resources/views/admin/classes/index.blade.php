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
                  <ol class="list-group list-group-numbered">
                    @foreach($plans as $plan)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">{{$plan->name}} <strong>{{$plan->format}}</strong></div>
                        Descripción: {{$plan->description}}
                      </div>
                      <span class="badge bg-primary rounded-pill">{{$plan->hasStudents()}}</span>
                    </li>
                    @endforeach
                  </ol>
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
