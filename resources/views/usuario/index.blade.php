@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Usuarios</div>
                <div class="panel-body">
                    <table class="table table-hover" id="tb">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre de usuario</th>
                            <th>Rol</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <th scope="row">{{$usuario->id}}</th>
                            <td>{{$usuario->username}}</td>
                            <td>{{$usuario->rol}}</td>
                            <td>
                                <!-- Single button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('usuario.editar',$usuario->id) }}">Editar usuario {{$usuario->username}}</a>
                                        </li>
                                        <li>
                                            <a href="{{ $usuario->id==1?'':route('usuario.eliminar',$usuario->id) }}">Eliminar usuario {{$usuario->username}}</a>
                                        </li>
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