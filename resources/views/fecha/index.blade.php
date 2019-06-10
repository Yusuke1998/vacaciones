@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Fechas</div>
                <div class="panel-body">
                    <table class="table table-hover" id="tb">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Descripcion</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($fechas as $fecha)
                        <tr>
                            <td>{{$fecha->id}}</td>
                            <th scope="row">{{ date("d-m-Y", strtotime($fecha->date)) }}</th>
                            <td>{{$fecha->description}}</td>
                            <td>
                                <!-- Single button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/fecha/edit',$fecha->id) }}">Editar area {{$fecha->date}}</a></li>
                                    </ul>
                                </div>
                            </td>
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
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#tb').DataTable();
    });
</script>
@endsection