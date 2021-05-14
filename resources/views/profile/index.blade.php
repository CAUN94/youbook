@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
    <div class="row ">

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Mi Perfil</div>

                <div class="card-body">
                    <p>Nombre: {{auth()->user()->name}}</p>
                    <p>Mail: {{auth()->user()->email}}</p>
                    <p>Dirección: {{auth()->user()->address}}</p>
                    <p>Celular: {{auth()->user()->phone}}</p>
                    <p>Genero: {{ucfirst(auth()->user()->gender)}}</p>
                    <p>Biografia: {{auth()->user()->description}}</p>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Actualizar Perfil</div>

                <div class="card-body">
                    <form action="{{route('profile.store')}}" method="post">@csrf
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{auth()->user()->name}}">
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" name="address" class="form-control" value="{{auth()->user()->address}}">

                        </div>
                        <div class="form-group">
                            <label>Celular</label>
                            <input type="text" name="phone" class="form-control" value="{{auth()->user()->phone}}">

                        </div>
                        <div class="form-group">
                            <label>Genero</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                <option value="">Seleccionar</option>
                                <option value="masculino" @if(auth()->user()->gender=='masculino')selected @endif >Masculino</option>
                                <option value="femenino" @if(auth()->user()->gender=='femenino')selected @endif>Femenino</option>
                            </select>
                            @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            <div class="form-group">
                            <label>Biografia</label>
                            <textarea name="description" class="form-control">{{auth()->user()->description}}</textarea>

                        </div>
                        <div class="form-group">

                            <button class="btn btn-primary" type="submit">Actualizar</button>

                        </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Actualizar Foto</div>
                <form action="{{route('profile.pic')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="card-body">
                    @if(!auth()->user()->image)
                    <img src="/img/logo-basic-naranjo.png" width="120">
                    @else
                     <img src="/img/professionals/{{auth()->user()->image}}" width="100%" style="margin: 0 auto">
                    @endif
                    <br>
                    <input type="file" name="file" class="form-control" required="">
                    <br>
                     @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <button type="submit" class="btn btn-primary">Actualizar</button>

                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection
