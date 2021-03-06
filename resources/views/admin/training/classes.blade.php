@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">Clase: {{$training->training()->name}} {{$training->name}}  {{$days_dias[date_format(date_create($training->date), 'l')]}}  {{$training->hour}} {{$students->count()}} Alumnos
                      <div>
                        Estado:
                        @if($training->status == 1)
                          <a class="btn btn-sm btn-primary"  href="{{route('class.training.toogle',['id' => $training->id])}}">Realizada</a>
                        @else
                           <a class="btn btn-sm btn-primary" href="{{route('class.training.toogle',['id' => $training->id])}}">No Realizada</a>
                        @endif
                      </div>

                    </h4>
                 </div>
                <div class="card-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Foto</th>
                          <th scope="col">Paciente</th>
                          <th scope="col">Email</th>
                          <th scope="col">Telefono</th>
                          <th scope="col">Genero</th>
                          <th scope="col">Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($students as $key => $student)
                        @if($student->classesStatus($id)->status == 0)
                          <tr class="table-warning">
                        @else
                          <tr class="table-success">
                        @endif
                          <th scope="row">{{$key+1}}</th>
                          @if(!is_null($student->image))
                                <td><img width="60" height="60" src="{{asset('/img/professionals')}}/{{$student->image}}" class="thumb1" alt=""></td>
                          @else
                              <td><img width="60" height="60" src="{{asset('/img/logo-basic-naranjo.png')}}" class="thumb1" alt=""></td>
                          @endif
                          <td>{{$student->name}} {{$student->lastnames}}</td>
                          <td>{{$student->email}}</td>
                          <td>{{$student->phone}}</td>
                          <td>{{$student->gender}}</td>
                          <td>
                              @if($student->classesStatus($id)->status == 1)
                              <a href="{{route('admin.training.toogle',['student_id' => $student->id, 'book_id' => $id])}}"><button class="btn btn-primary"> Asistio</button></a>
                              @else
                               <a href="{{route('admin.training.toogle',['student_id' => $student->id, 'book_id' => $id])}}"><button class="btn btn-primary"> No Asistio</button></a>
                              @endif
                          </td>
                        </tr>
                        @empty
                        <td>No Hay Reservas</td>
                        @endforelse

                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
