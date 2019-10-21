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
                <div class="card-header">Reservaciones</div>

                <div class="card-body">
                    <table id="myTable" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <td>Pedido</td>
                                <td>Metodo de pago</td>
                                <td>Datos comprador</td>
                                <td>Nombre tour</td>
                                <td>Monto</td>
                                <td>Fecha reserva</td>
                                <td>Status</td>

                                <td>Opciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservaciones as $reservacion)
                            <tr>
                                <td>
                                    <a  href="{{route('reservacion.detallesreservacion',$reservacion->id)}}">
                                        {{$reservacion->order_nr}}
                                    </a></td>
                                <td>{{$reservacion->ModoPago}}</td>
                                <td>
                                    <?php
                                    echo substr($reservacion->DatosComprador, 0, 35) . '...';
                                    ?>
                                </td>
                                <td>{{$reservacion->NameTour}}</td>
                                <td>{{$reservacion->Monto}} {{$reservacion->Moneda}}</td>
                                <td>{{$reservacion->Fechareserva}}</td>
                                <td>{{$reservacion->status}}</td>
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