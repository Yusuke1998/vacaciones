@extends('pdf.template')
@section('title')
	{{ $vacacion->type }}
@endsection
@section('styles')
	<style>
		
	</style>
@endsection
@section('content')
<div>
	<p>Trabajador: {{ $vacacion->worker->name }} / Ci: {{ $vacacion->worker->ci }}</p>
	<p>Desde: {{ date("d-m-Y", strtotime($worker->date_init)) }}</p>
	<p>Hasta: {{ $vacacion->date_end }}</p>
	<p>Motivo: {{ $vacacion->reason }}</p>
	<p>Tipo: {{ $vacacion->type }}</p>
	<p>Observacion: {{ $vacacion->observations }}</p>
</div>
@endsection