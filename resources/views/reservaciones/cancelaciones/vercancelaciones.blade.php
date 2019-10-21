@extends('adminlte::page')

@section('title', 'Ver reservaciones')

@section('content_header')
<h1>Ver reservaciones</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Prospectos Nuevos</div>

                <div class="card-body">
                    <table id="myTable" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <td>Numero de Pedido</td>
                                <td>Modo de pago</td>
                                <td>Monto</td>
                                <td>Fecha del tour</td>
                                <td>Fecha cancelacion</td>
                                <td>Cancela</td>
                                <td>Status</td>

                                <td>Opciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cancelaciones as $cancelacion)
                            <tr>
                                <td>
                                    <a href="{{route('cancelaciones.detallescanelacion',$cancelacion->id)}}">
                                        {{$cancelacion->order_nr}}</a></td>
                                <td>{{$cancelacion->ModoPago}}</td>
                                <td>{{$cancelacion->Monto}}</td>
                                <td>{{$cancelacion->Fechareserva}}</td>
                                <td>{{$cancelacion->FechaCancelacion}}</td>
                                <td>{{$cancelacion->Cancela}}</td>
                                <td>{{$cancelacion->Estado}}</td>

                                <td>Eliminar</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br><br>


</div>
@stop
@push('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
    $(function() {
        $('#myTable').DataTable({
            "pageLength": 50,
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>
@endpush