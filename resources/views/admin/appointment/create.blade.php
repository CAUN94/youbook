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
                        <span>Registrar Horas Dosponibles</span>
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
                        <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
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
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            @endforeach
            <div class="card">
                <div class="card-header"><h3>Nuevo Horario</h3></div>
                <div class="card-body">
                    <form action="{{route('appointments.store')}}" method="POST" class="forms-sample">
                    	@csrf
                        <div class="card">
                            <div class="card-header">
                                Seleccionar Fecha
                            </div>
                            <div class="card-body">
                             <input type="text" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="date" autocomplete="off">
                            </div>
                        </div>
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
                                    <td><input type="checkbox" name="time[]"  value="6am" class="AM">&nbsp;6am</td>
                                    <td><input type="checkbox" name="time[]"  value="7am" class="AM">&nbsp;7am</td>
                                    <td><input type="checkbox" name="time[]"  value="8am" class="AM">&nbsp;8am</td>
                                  </tr>
                                   <tr>
                                    <th scope="row">2</th>
                                    <td><input type="checkbox" name="time[]"  value="9am" class="AM">&nbsp;9am</td>
                                    <td><input type="checkbox" name="time[]"  value="10am" class="AM">&nbsp;10am</td>
                                    <td><input type="checkbox" name="time[]"  value="11am" class="AM">&nbsp;11am</td>
                                  </tr>
                                   <tr>
                                    <th scope="row">3</th>
                                    <td><input type="checkbox" name="time[]"  value="12am" class="AM">&nbsp;12am</td>
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
                                  <td><input type="checkbox" name="time[]"  value="1pm" class="PM">&nbsp;1pm</td>
                                  <td><input type="checkbox" name="time[]"  value="2pm" class="PM">&nbsp;2pm</td>
                                  <td><input type="checkbox" name="time[]"  value="3pm" class="PM">&nbsp;3pm</td>
                                </tr>
                                <tr>
                                  <th scope="row">8</th>
                                  <td><input type="checkbox" name="time[]"  value="4pm" class="PM">&nbsp;4pm</td>
                                  <td><input type="checkbox" name="time[]"  value="5pm" class="PM">&nbsp;5pm</td>
                                  <td><input type="checkbox" name="time[]"  value="6pm" class="PM">&nbsp;6pm</td>
                                </tr>
                                <tr>
                                  <th scope="row">9</th>
                                  <td><input type="checkbox" name="time[]"  value="7pm" class="PM">&nbsp;7pm</td>
                                  <td><input type="checkbox" name="time[]"  value="8pm" class="PM">&nbsp;8pm</td>
                                  <td><input type="checkbox" name="time[]"  value="9pm" class="PM">&nbsp;9pm</td>
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
