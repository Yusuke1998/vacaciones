@extends('pdf.template')
@section('title')
	<p>República Bolivariana de Venezuela.</p>
	<p>Gobierno Bolivariano de Aragua.</p>
	<p>Corporación de salud del estado Aragua.</p>
	<p>Dirección de Recursos Humanos.</p>
@endsection
@section('styles')
	<style>
		.mayus {
			text-transform: uppercase;
		}

		.col {
			display: inline-block;
			text-align: center;
			background: lightgray;
			width: 24%;
			height: 180px;
		}

		.container {
			display: block;
			width: 100%;
			margin: auto;
		}
	</style>
@endsection
@section('content')
<div align="center">
	<span>DATOS PERSONALES</span>
</div>
<div class="mayus">
	<p>NOMBRE(s) y APELLIDO(s): {{ $vacacion->worker->name }}.</p>
	<p>CEDULA DE IDENTIDAD N°: {{ $vacacion->worker->ci }}.</p>
	<P>DENOMINACIÓN DEL CARGO: {{ $vacacion->worker->position }}.</P>
	<P>CODIGO DEL CARGO: {{ $vacacion->worker->position_code }}.</P>
	<P>NÚMERO TELEFÓNICO: {{ $vacacion->worker->cellphone }}.</P>
</div>
<div align="center">
	<span>INFORMACION GENERAL</span>
</div>
<div class="mayus">
	<p>ESTATUS DEL TRABAJADOR: {{ $vacacion->worker->status_worker }}.</p>
	<P>FECHA DE INGRESO DEL TRABAJADOR: {{ date("d-m-Y", strtotime($vacacion->worker->date_in)) }}.</P>
	<P>AÑOS DE SERVICIO: {{ $año_trabajo }}.</P>
	<p>TIPO DE VACACIONES: {{ $vacacion->type }}.</p>
	<P>FECHA DE INICIO DE VACACION:  {{ date("d-m-Y", strtotime($vacacion->date_init)) }}.</P>
	<P>FECHA DE FINALIZACION DE VACACION:  {{ date("d-m-Y", strtotime($vacacion->date_end)) }}.</P>
	<P>DIAS DE VACACION:  {{ $vacacion->days_taken }}.</P>
	<p>RAZON: {{ $vacacion->reason }}.</p>
	<p>OBSERVACIÓN: {{ $vacacion->observations }}.</p>
</div>
<div align="center">
	<p>CONFORMACIÓN</p>
</div>
<br>
<div class="container">
	<div class="col">
		<b>Firma del solicitante</b>
	</div>
	<div class="col">
		<b>Supervisor inmediato</b><br>
		<small>sello de la unidad</small>
	</div>
	<div class="col">
		<b>Director municipal</b><br>
		<small>sello de la unidad</small>
	</div>
	<div class="col">
		<b>Coord. de recursos humanos</b><br>
		<small>sello de la unidad</small>
	</div>
</div>
@endsection