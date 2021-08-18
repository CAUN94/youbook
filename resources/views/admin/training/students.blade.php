@extends('admin.layouts.master')

@section('content')


<div class="row mx-2">
    <div class="col-md-12">
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
        @endif
        <div class="card">
            <div class="card-header"><h3>Alumnos</h3></div>
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
                            @if(!is_null($student->image))
                                <td><img width="60" height="60" src="{{asset('/img/professionals')}}/{{$student->image}}" class="thumb1" alt=""></td>
                            @else
                                <td><img width="60" height="60" src="{{asset('/img/logo-basic-naranjo.png')}}" class="thumb1" alt=""></td>
                            @endif
                            <td>{{$student->email}}</td>
                            <td>{{$student->phone}}</td>
                            <td>{{$student->address}}</td>
                            <td>
                                <div class="table-actions">

                                    <form class="d-inline" method="POST" action="{{ url('/studentsSettled', ['id' => $student->id])}}">
                                      @csrf
                                      @method('PUT')
                                            @if($student->isSettled())
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Seguro? Piensa que haria la Dani')">
                                                    No Pagado
                                            @else
                                                <button type="submit" class="btn btn-success" onclick="return confirm('Seguro? Piensa que haria la Dani')">
                                                Pagado
                                            @endif
                                        </button>
                                    </form>


                                    <form class="d-inline" method="POST" action="{{ url('/students', ['id' => $student->id])}}">
                                      @csrf
                                      @method('DELETE')
                                        <button class="btn btn-secondary" type="submit" onclick="return confirm('Seguro? Piensa que haria la Dani')">
                                            Eliminar
                                        </button>
                                    </form>
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
