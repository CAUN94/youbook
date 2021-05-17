@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        	<div id="app">
        		<calendar><calendar />
        	</div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"defer></script>


@endsection
