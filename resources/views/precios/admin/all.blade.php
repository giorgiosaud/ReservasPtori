@extends('templates.mainInterno')
@section('content')

		<div class="table-responsive">
			{!!Table::withContents($preciosTableStyle)
			->callback('Accion', function ($field, $row) {
			return Button::primary('Editar')->asLinkTo(route('precios.edit', $row['Id']))->block();
			})
			->callback('Borrar', function ($field, $row) {
			$return=Form::open(['class' => 'form-inline', 'method' => 'DELETE', 'route' => ['precios.destroy', $row['Id']]]);
			$return.=Form::Submit('Borrar ',[ 'class' => 'btn btn-danger']);
			$return.=Form::close();

			return $return;


			})
			->hover()->render()
			!!}

		</div>
		{!!Button::primary('Nuevo Precio')->asLinkTo(route('precios.create'))->block()!!}
@endsection
