@extends('admin.layouts.master')

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-inbox bg-blue"></i>
                <div class="d-inline">
                    <h5>Profesionales</h5>
                    <span>Lista de los Profesionales</span>
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
                        <a href="#">Profesionales</a>
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
                @if(count($professionals)>0)
                <table id="data_table" class="table">
                    <thead>
                        <tr>
                            <th>Nombre </th>
                            <th class="nosort">Foto</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Dirección</th>
                            <th>Área</th>
                            <th class="nosort">&nbsp;</th>
                            <th class="nosort">&nbsp;</th>
                            <th class="nosort">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($professionals as $professional)
                        <tr>
                            <td>{{$professional->name}} {{$professional->lastnames}}</td>
                            <td><img width="60" height="60" src="{{asset('/img/professionals')}}/{{$professional->image}}" class="thumb1" alt=""></td>
                            <td>{{$professional->email}}</td>
                            <td>{{$professional->phone}}</td>
                            <td>{{$professional->address}}</td>
                            <td>{{$professional->department}}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="#" data-toggle="modal" data-target="#exampleModal{{$professional->id}}"><i class="ik ik-eye"></i></a>
                                    <a href="{{route('professionals.edit',[$professional->id])}}"><i class="ik ik-edit-2"></i></a>
                                    <a href="{{route('professionals.show',[$professional->id])}}"><i class="ik ik-trash-2"></i></a>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        @include('admin.professional.modal')
                    @endforeach
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
