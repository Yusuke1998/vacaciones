@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Trabajadores Activos</div>
                @if($workers->isEmpty())
                @else
                <div class="panel-title">
                    <form class="form-inline active-cyan-4" id="form-search" method="post" action="{{ route('index') }}">
                    {{ csrf_field() }}
                      <input name="search" id="search" class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Buscar Empleado(s)" aria-label="Search">
                      <i class="fa fa-search" id="icon-search" aria-hidden="true"></i>
                      <small><span id="text"></span></small>
                    </form>
                </div>  
                @endif

                <div class="panel-body">
                    @if($workers->isEmpty())
                    <h1 class="text-center">No existen trabajadores registrados</h1>
                    @else
                        <table class="table table-hover">
                            <thead>
                            <tr >
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="success" style="text-align:center" colspan="3">Dias Vacaciones</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Fecha Entrada</th>
                                <th>Area</th>
                                <th>Puesto</th>
                                <th class="success">Ganados</th>
                                <th class="success">Tomados</th>
                                <th class="success">Restantes</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($workers as $worker)
                            <tr>
                                <td scope="row">{{$worker->ci}}</td>
                                <td>{{$worker->name}}</td>
                                <td>{{$worker->cellphone}}</td>
                                <td>{{ date("d-m-Y", strtotime($worker->date_in)) }}</td>
                                <td>{{$worker->area->name}}</td>
                                <td>{{$worker->position}}</td>
                                <td class="success">{{$vacationDays=MyHelper::vacationDays($worker->date_in)}}</td>
                                <td class="success">{{$vacationTaken=MyHelper::vacationTaken($worker->id)}}</td>
                                <td class="success">{{$vacationDays-$vacationTaken}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ url('/worker/show/'.Crypt::encrypt($worker->id)) }}">Informacion de {{$worker->name}}</a></li>
                                            <li><a href="{{ url('/vacation/create/'.Crypt::encrypt($worker->id).'/'.Crypt::encrypt($worker->name)) }}">Asignar Vacaciones</a></li>
                                            <li><a href="{{ route('pdf',Crypt::encrypt($worker->id)) }}">PDF de {{$worker->name}}</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $('document').ready(function(){
        $('#form-search').click(function(e){
            buscar();
        });
        $('#icon-search').click(function(){
            buscar();
        });

        function buscar(){
            let search = $('#search').val();
            let text = $('#text');
            if (search==''||search==null) {
                text.html('Puedes buscar por Cedula, Nombre, Apellido, Correo, Cargo o Fecha de entrada (dia-mes-año)');
            }
        }
    });
</script>
@endsection
