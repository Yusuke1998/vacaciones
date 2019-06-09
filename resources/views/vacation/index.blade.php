@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Todas las vacaciones de {{$trabajador->name}}</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Motivo</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Archivo</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($trabajador->vacations as $vacacion)
                            <tr>
                                <td>{{ $vacacion->type }}</td>
                                <td>{{ $vacacion->reason }}</td>
                                <td>{{ date("d-m-Y", strtotime($vacacion->date_init))}}</td>
                                <td>{{ date("d-m-Y", strtotime($vacacion->date_end))}}</td>
                                <td><a href="{{ route('vacacion.pdf',Crypt::encrypt($vacacion->id)) }}" title="descargar archivo pdf">PDF</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('style')
{!! Html::style('css/bootstrap-datetimepicker.min.css') !!}
@endsection
@section('javascript')
{!! Html::script('js/moment.min.js') !!}
{!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
<script>
    $('#date-init').datetimepicker({
        format: 'DD-MM-YYYY'
    });
</script>
@endsection