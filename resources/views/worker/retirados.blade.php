@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Trabajadores Retirados</div>
                @if($workers->isEmpty())
                @else
                <div class="panel-title">
                    <form class="form-inline active-cyan-4" id="form-search" method="post" action="{{ route('index.retirados') }}">
                    {{ csrf_field() }}
                      <input name="search" id="search" class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Buscar Empleado(s)" aria-label="Search">
                      <i class="fa fa-search" id="icon-search" aria-hidden="true"></i>
                      <small><span id="text"></span></small>
                    </form>
                </div>  
                @endif
                <div class="panel-body">
                    @if($workers->isEmpty())
                        <h1 class="text-center">No existen Trabajadores Retirados</h1>
                    @else
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Puesto</th>
                                <th>Fecha Entrada</th>
                                <th>Fecha Retiro</th>
                                <th>Motivo de Retiro</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($workers as $worker)
                            <tr>
                                <td scope="row">{{$worker->ci}}</td>
                                <td>{{$worker->name}}</td>
                                <td>{{$worker->cellphone}}</td>
                                <td>{{$worker->position}}</td>
                                <td>{{$worker->date_in}}</td>
                                <td>{{$worker->date_out}}</td>
                                <td>{{$worker->reason_retirement}}</td>
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
