@extends('pdf.template')
@section('title')
	{{ $trabajador->type }}
@endsection
@section('styles')
	<style>
		img {
			float: right;
		}

		#data {
			text-transform: uppercase;
		}
	</style>
@endsection
@section('content')
<div>
	<img src="{{ public_path($trabajador->photo) }}" width="200" height="200" alt="foto del trabajador">
</div>
<div id="data">
	<p>Trabajador: {{ $trabajador->name }}</p>
	<p>Cedula: {{ $trabajador->ci }}</p>
	<p>Fecha de ingreso: {{ date("d-m-Y", strtotime($trabajador->date_in)) }}</p>
	<p>Area de trabajo: {{ $trabajador->area->name }}</p>
	<p>Cargo: {{ $trabajador->position }}</p>
	<p>Correo electronico: {{ $trabajador->email }}</p>
</div>
@endsection