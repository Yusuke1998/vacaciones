@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Todas las vacaciones de {{$worker->name}}</div>
                <div class="panel-body">
                    Hola Mundo
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