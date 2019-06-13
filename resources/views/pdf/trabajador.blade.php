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

		table {

			text-transform: uppercase;
			margin: auto;
			padding: auto;
			text-align: center;
			table-layout: auto;
			border: solid;
			border-spacing: 10px;
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
	<p>Codigo de Cargo: {{ $trabajador->position_code }}</p>
	<p>Correo electronico: {{ $trabajador->email }}</p>
</div>
<div align="center">
	<h4>Vacaciones registradas</h4>
</div>
<div class="table">
	<table align="center">
		<thead>
			<tr>
				<th>TIPO</th>
				<th>INICIO</th>
                <th>FIN</th>
                <th>DIAS</th>
			</tr>
		</thead>
		<tbody>
			@foreach($trabajador->vacations as $vacacion)
			<tr>
				<td>{{ $vacacion->type }}</td>
				<th>{{date("d/m/Y", strtotime($vacacion->date_init))}}</th>
                <th>{{date("d/m/Y", strtotime($vacacion->date_end))}}</th>
                <td>{{$vacacion->days_taken}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection