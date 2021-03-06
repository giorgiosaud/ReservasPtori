@extends('templates.mainInterno')
@section('content')
	@include('templates.errors')
	<div class="container">
		<h1>Editar {!!$variable->nombre!!}</h1>
		{!!Form::horizontalModel($variable,['url'=>URL::route('variables.update',$variable->id),'role'=>'form','method'=>'PUT'])!!}
		@include('variables.admin.partials._form',['submit'=>'Modificar Variable','name'=>'disabled'])
		{!!Form::close()!!}
	</div>
@endsection
@section('footer')
@endsection
