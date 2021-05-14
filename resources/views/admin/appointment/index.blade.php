@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-edit bg-blue"></i>
                    <div class="d-inline">
                        <h5>Horarios</h5>
                        <span>Revisar Horario</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Horario</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lista</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
        	@if(Session::has('message'))
        		<div class="alert alert-success">
        			{{Session::get('message')}}
        		</div>
        	@endif
          @if(Session::has('errmessage'))
            <div class="alert alert-warning">
              {{Session::get('errmessage')}}
            </div>
          @endif
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            @endforeach
            <div class="card">
                <div class="card-header">
                  <h3>Horario
                  @if(isset($date))
                    :&nbsp; Día: {{$date}}
                  @endif
                </h3>
                </div>
                <div class="card-body">
                    <form action="{{route('appointments.check')}}" method="POST" class="forms-sample">
                    	@csrf
                        <div class="card">
                            <div class="card-header">
                                Seleccionar Fecha
                            </div>
                            <div class="card-body">
                             <input type="text" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="date" autocomplete="off">
                             <br>
                             <button type="submit" class="btn btn-primary">Revisar</button>
                            </div>
                        </div>
                      </form>
                      @if(Route::is('appointments.check'))
                      <form action="{{route('update')}}" method="POST" class="forms-sample">
                        <input type="hidden" name="appoinmentId" value="{{$appointmentId}}">
                        @csrf
                        <div class="card">
                          <div class="card-header">
                              Horario Am
                             <span style="margin-left: 60%">Seleccionar Todas
                                 <input type="checkbox" onclick=" for(c in document.getElementsByClassName('AM')) document.getElementsByClassName('AM').item(c).checked=this.checked" >
                             </span>
                          </div>
                          <div class="card-body">

                              <table class="table table-striped">
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td><input type="checkbox" name="time[]"  value="6am"  @if(isset($times)){{$times->contains('time','6am')?'checked':''}}@endif class="AM">&nbsp;6am</td>
                                    <td><input type="checkbox" name="time[]"  value="7am"  @if(isset($times)){{$times->contains('time','7am')?'checked':''}}@endif class="AM">&nbsp;7am</td>
                                    <td><input type="checkbox" name="time[]"  value="8am"  @if(isset($times)){{$times->contains('time','8am')?'checked':''}}@endif class="AM">&nbsp;8am</td>
                                  </tr>
                                   <tr>
                                    <th scope="row">2</th>
                                    <td><input type="checkbox" name="time[]"  value="9am"  @if(isset($times)){{$times->contains('time','9am')?'checked':''}}@endif class="AM">&nbsp;9am</td>
                                    <td><input type="checkbox" name="time[]"  value="10am"  @if(isset($times)){{$times->contains('time','10am')?'checked':''}}@endif class="AM">&nbsp;10am</td>
                                    <td><input type="checkbox" name="time[]"  value="11am"  @if(isset($times)){{$times->contains('time','11am')?'checked':''}}@endif class="AM">&nbsp;11am</td>
                                  </tr>
                                   <tr>
                                    <th scope="row">3</th>
                                    <td><input type="checkbox" name="time[]"  value="12am"  @if(isset($times)){{$times->contains('time','12am')?'checked':''}}@endif class="AM">&nbsp;12am</td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                        </div>

                        <div class="card">
                          <div class="card-header">
                              Horario PM
                              <span style="margin-left: 60%">Seleccionar Todas
                                 <input type="checkbox" onclick=" for(c in document.getElementsByClassName('PM')) document.getElementsByClassName('PM').item(c).checked=this.checked" >
                             </span>
                          </div>
                          <div class="card-body">

                            <table class="table table-striped">


                              <tbody>
                                <tr>
                                  <th scope="row">7</th>
                                  <td><input type="checkbox" name="time[]"  value="1pm" @if(isset($times)){{$times->contains('time','1pm')?'checked':''}}@endif class="PM">&nbsp;1pm</td>
                                  <td><input type="checkbox" name="time[]"  value="2pm" @if(isset($times)){{$times->contains('time','2pm')?'checked':''}}@endif class="PM">&nbsp;2pm</td>
                                  <td><input type="checkbox" name="time[]"  value="3pm" @if(isset($times)){{$times->contains('time','3pm')?'checked':''}}@endif class="PM">&nbsp;3pm</td>
                                </tr>
                                <tr>
                                  <th scope="row">7</th>
                                  <td><input type="checkbox" name="time[]"  value="4pm" @if(isset($times)){{$times->contains('time','4pm')?'checked':''}}@endif class="PM">&nbsp;4pm</td>
                                  <td><input type="checkbox" name="time[]"  value="5pm" @if(isset($times)){{$times->contains('time','5pm')?'checked':''}}@endif class="PM">&nbsp;5pm</td>
                                  <td><input type="checkbox" name="time[]"  value="6pm" @if(isset($times)){{$times->contains('time','6pm')?'checked':''}}@endif class="PM">&nbsp;6pm</td>
                                </tr>
                                <tr>
                                  <th scope="row">8</th>
                                  <td><input type="checkbox" name="time[]"  value="7pm" @if(isset($times)){{$times->contains('time','7pm')?'checked':''}}@endif class="PM">&nbsp;7pm</td>
                                  <td><input type="checkbox" name="time[]"  value="8pm" @if(isset($times)){{$times->contains('time','8pm')?'checked':''}}@endif class="PM">&nbsp;8pm</td>
                                  <td><input type="checkbox" name="time[]"  value="9pm" @if(isset($times)){{$times->contains('time','9pm')?'checked':''}}@endif class="PM">&nbsp;9pm</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Cargar</button>
                            </div>
                        </div>
                      </form>
                    @else
                      <h3>Your appoinment time list: {{$myappointments->count()}}</h3>

                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Professioinal</th>
                            <th scope="col">Fechas</th>
                            <th scope="col">Ver/Actualizar</th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach($myappointments as $appoinment)
                          <tr>

                            <th scope="row"></th>
                            <td>{{$appoinment->professional->name}}</td>
                            <td>{{$appoinment->date}}</td>
                            <td>
                                  <form action="{{route('appointments.check')}}" method="post">@csrf
                                      <input type="hidden" name="date" value="{{$appoinment->date}}">
                                  <button type="submit" class="btn btn-primary">View/Update</button>


                                  </form>


                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    input[type="checkbox"]{
        zoom:1.1;

    }
    body{
        font-size: 18px;
    }
</style>

@endsection
