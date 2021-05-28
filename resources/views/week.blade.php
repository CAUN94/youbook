@extends('admin.layouts.master')

@section('content')
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        	<div id="app">
            <v-app>
            	<week>
            	</week>
            </v-app>
        	</div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }} "defer></script>
@endsection
