@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Clase: {{$training->name}}  {{$days_dias[date_format(date_create($training->date), 'l')]}}  {{$training->hour}} {{$students->count()}} Alumnos</h3>
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
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td>
                            <img src="/profile/{{$student->image}}" width="80" style="border-radius: 50%;">
                          </td>
                          <td>{{$student->name}} {{$student->lastnames}}</td>
                          <td>{{$student->email}}</td>
                          <td>{{$student->phone}}</td>
                          <td>{{$student->gender}}</td>
                          <td>
                              @if($student->classesStatus($id)->status == 1)
                              <a href="{{route('admin.training.toogle',['student_id' => $student->id, 'book_id' => $id])}}"><button class="btn btn-primary"> No Asistio</button></a>
                              @else
                               <a href="{{route('admin.training.toogle',['student_id' => $student->id, 'book_id' => $id])}}"><button class="btn btn-success"> Asistio</button></a>
                              @endif
                          </td>
                        </tr>
                        @empty
                        <td>No Hay Horas</td>
                        @endforelse

                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
