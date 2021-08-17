@extends('admin.layouts.master')

@section('content')


<div class="row justify-content-center">
    <div class="col-lg-10">
        @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('message')}}
            </div>
        @endif

    <div class="card">
    <div class="card-header"><h3>Confirmar</h3></div>
    <div class="card-body">
        <img src="{{asset('img/professionals')}}/{{$professional->image}}" width="120">
        <h2>{{$professional->name}}</h2>
        <form class="forms-sample" action="{{route('professionals.destroy',[$professional->id])}}" method="post" >@csrf
            @method('DELETE')

            <div class="card-footer">
                <button type="submit" class="btn btn-danger mr-2">Confirmar</button>
                <a href="{{route('professionals.index')}}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>



                </form>
            </div>
        </div>
    </div>
</div>
@endsection
