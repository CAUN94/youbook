@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-edit bg-blue"></i>
                    <div class="d-inline">
                        <h5>Profesionales</h5>
                        <span>Nuevo Profesional You Just Better</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Profesional</a></li>
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
            <div class="card">
                <div class="card-header"><h3>Nuevo Profesional</h3></div>
                <div class="card-body">
                    <form action="{{route('professionals.update',[$professional->id])}}" method="POST" class="forms-sample" enctype="multipart/form-data">
                    	@csrf
                        @method('PUT')
                        <div class="row mb-1">
                        	<div class="col-md-6">
                        		<label for="name">{{ __('Nombre') }}</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $professional->name }}" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                             	<label for="lastnames">{{ __('Apellidos') }}</label>


                                <input id="lastnames" type="text" class="form-control @error('lastnames') is-invalid @enderror" name="lastnames" value="{{ $professional->lastnames }}"  autofocus>

                                @error('lastnames')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-1">
                        	<div class="col-6">
                        		<label for="rut">{{ __('Rut (sin puntos y con guión)') }}</label>
                                <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" value="{{ $professional->rut }}"  placeholder="11111111-1" autofocus>

                                @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        	</div>
                        	<div class="col-6">
                        		<label for="email">{{ __('Mail') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $professional->email }}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        	</div>
                        </div>

                        <div class="row mb-1">
                        	<div class="col-md-6">
                        		<label for="gender">{{ __('Genero') }}</label>


                                <select id="gender" name="gender" class="form-control @error('email') is-invalid @enderror" >
                                    <option value="masculino @if($professional->gender=='masculino')selected @endif">Masculino</option>
                                    <option value="femenino @if($professional->gender=='femenino')selected @endif">Femenino</option>
                                    <option value="no @if($professional->gender=='no')selected @endif">No Especifica</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                        		<label for="role_id">{{ __('Rol') }}</label>


                                <select id="role_id" name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                    @foreach(App\Models\Role::where('name','!=','paciente')->get() as $role)
                                    <option value="{{$role->id}}" @if($professional->role_id==$role->id)selected @endif>{{ucfirst($role->name)}}</option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-1">
                        	<div class="col-md-6">
                        		<label for="password">{{ __('Clave') }}</label>


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        	</div>
                        	<div class="col-md-6">
                        		<label for="password-confirm">{{ __('Confirmar Clave') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="row mb-1">
                        	<div class="col-md-6">
                        		<label for="address">{{ __('Dirección') }}</label>

                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $professional->address}}"  autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                             	<label for="phone">{{ __('Celular') }}</label>


                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $professional->phone }}"  autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-1">
                        	<div class="col-md-6">
                        		<label for="department">{{ __('Área') }}</label>

                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ $professional->department }}" autocomplete="department" autofocus>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                             	<label for="education">{{ __('Titulo') }}</label>
                                <input id="education" type="text" class="form-control @error('education') is-invalid @enderror" name="education" value="{{ $professional->education }}"  autocomplete="education" autofocus>

                                @error('education')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-1">
                        	<div class="col">
							  <label for="image" class="form-label">Foto Profesional</label>
							  <input class="form-control l @error('image') is-invalid @enderror" name="image"  type="file" id="image">
								@error('image')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
	                        </div>
						</div>
                        <div class="row mb-1">
                        	<div class="col-md-12">
                        		<label for="description" class="form-label">Example textarea</label>
  								<textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ $professional->description }}</textarea>
  								@error('description')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
  							</div>

                        </div>

                        <div class="row mt-2">
                        	<div class="col-12">
                        		<button type="submit" class="btn btn-primary mr-2">Submit</button>
                        	</div>

                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
