@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Usuario</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('usuario.actualizar',$usuario->id) }}">
                        {!! csrf_field() !!}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nombre y Apellido:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name')?old('name'):$usuario->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Usuario:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" value="{{ old('username')?old('username'):$usuario->username }}">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Rol:</label>

                            <div class="col-md-6">
                            	<select name="rol" class="form-control">
                            		<option disabled>Selecciona un rol</option>
                            		<option {{ $usuario->rol=='administrador'?'selected':'' }} value="administrador">Administrador</option>
                            		<option {{ $usuario->rol=='normal'?'selected':'' }} value="normal">Normal</option>
                            	</select>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Correo:</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ (old('email'))?old('email'):$usuario->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Contraseña:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="password" placeholder="Escribe una nueva si deseas cambiarla">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-block btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection