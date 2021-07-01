@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Registro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('training-register-user') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="plan" class="col-md-4 col-form-label text-md-right">{{ __('Plan de Entrenamiento') }}</label>

                            <div class="col-md-6">
                                <select id="plan" name="plan" class="form-control @error('plan') is-invalid @enderror">
                                    <option value="">Seleccionar Plan</option>
                                    @foreach($trainings as $training)
                                        <option value="{{$training->id}}">{{$training->name}} {{$training->format}}</option>
                                    @endforeach
                                </select>

                                @error('plan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registarme en Plan') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Tipos de Planes') }}</div>
                <div class="card-body">
                    <table class="table table-striped">
                      @foreach ($trainings as $training)
                          <tr>
                              <td>{{$training->name}}</td>
                              <td>{{$training->time_in_minutes}} min</td>
                              <td>{{$training->format}}</td>
                              <td>{{$training->price}}</td>
                          </tr>
                      @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
