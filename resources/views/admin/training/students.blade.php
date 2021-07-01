@extends('admin.layouts.master')

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-inbox bg-blue"></i>
                <div class="d-inline">
                    <h5>Alumnos</h5>
                    <span>Lista de Alumnos</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="../index.html"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Alumnos</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lista</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
        @endif
        <div class="card">
            <div class="card-header"><h3>Data Table</h3></div>
            <div class="card-body">
                @if(count($students)>0)
                <table id="data_table" class="table">
                    <thead>
                        <tr>
                            <th>Nombre </th>
                            <th class="nosort">Foto</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Dirección</th>
                            <th class="nosort">&nbsp;</th>
                            <th class="nosort">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->name}} {{$student->lastnames}}</td>
                            <td><img width="60" height="60" src="{{asset('/img/professionals')}}/{{$student->image}}" class="thumb1" alt=""></td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->phone}}</td>
                            <td>{{$student->address}}</td>
                            <td>
                                <div class="table-actions">
                                    {{-- <a href="#" data-toggle="modal" data-target="#exampleModal{{$student->id}}"><i class="ik ik-eye"></i></a> --}}
                                    <a href="#"><i class="ik ik-eye"></i></a>
                                    {{-- <a href="{{route('professionals.show',[$student->id])}}"><i class="ik ik-trash-2"></i></a> --}}
                                    <a href="#"><i class="ik ik-trash-2"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    {{-- @include('admin.professional.modal') --}}
                    </tbody>
                </table>
                @else
                    <p class="alert alert-warning">Nada que mostrar</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
