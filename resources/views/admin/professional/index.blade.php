@extends('admin.layouts.master')

@section('content')
<div class="page-header">

</div>

<div class="row mx-2">
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
                                <a href="#" data-toggle="modal" data-target="#exampleModal{{$professional->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{route('professionals.edit',[$professional->id])}}"><i class="fas fa-edit"></i></a>
                                <a href="{{route('professionals.show',[$professional->id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
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
