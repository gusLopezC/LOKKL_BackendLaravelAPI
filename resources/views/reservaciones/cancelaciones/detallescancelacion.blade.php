@extends('adminlte::page')

@section('title', 'Admin Tours')

@section('content_header')
<h1>Administrar Usuarios</h1>
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body row">
                    <div class="col-12">
                        <h2>Datos personales:</h2>
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <td>
                                    <h5>Numero de orden:</h5>
                                    <strong>{{$cancelacion->order_nr}}</strong>
                                </td>
                                <td>
                                    <h5>Metodo de pago:</h5>
                                    <strong>{{$cancelacion->ModoPago}}</strong>
                                </td>
                                <td>
                                    <h5>Fecha reserva:</h5>
                                    <strong>{{$cancelacion->Fechareserva}}</strong>
                                </td>
                                <td>
                                    <h5>Monto cobrado:</h5>
                                    <strong>{{$cancelacion->Monto}} {{$cancelacion->Moneda}}</strong>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Estado:</h4>
                                        <strong style="color:red">{{$cancelacion->Estado}}</strong>
                                </td>
                                <td>
                                    <h5>Cancela :</h4>
                                        <strong>{{$cancelacion->Cancela}}</strong>
                                </td>
                                <td colspan="2">
                                    <h5>Motivo Cancelacion:</h4>
                                        <strong>{{$cancelacion->motivoCancelacion}}</strong>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <h5>Tarjeta con la que se pago:</h4>
                                        <strong style="color:blue">{{$cancelacion->NumTarjeta}}</strong>
                                </td>
                                
                                <td colspan="2">
                                    <h5>Estado dinero:</h4>
                                        <strong>{{$cancelacion->EstadoDinero}}</strong>
                                </td>

                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div class="col-sm-4" style="text-align:center">
                        <h4>Datos comprador</h4>
                        <br>
                        @foreach ($cancelacion->getComprador as $comprador)
                        <div>
                            <img class="img-responsive" src=" https://lokkl.s3.us-east-2.amazonaws.com/images/profile/{{$comprador->img}}" alt="" width="70px" style="margin:auto">
                            <br>
                            <strong>{{$comprador->name}}</strong><br>
                            <strong>{{$comprador->email}}</strong>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-sm-4" style="text-align:center">
                        <h4>Datos comprador</h4>
                        <br>
                        @foreach ($cancelacion->getGuia as $guia)
                        <div>
                            <img class="img-responsive" src=" https://lokkl.s3.us-east-2.amazonaws.com/images/profile/{{$guia->img}}" alt="" width="70px" style="margin:auto">
                            <br>
                            <strong>{{$guia->name}}</strong><br>
                            <strong>{{$guia->email}}</strong>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-sm-4">
                        <h4>Datos Tour</h4>
                        @foreach ($cancelacion->getTour as $tour)
                        <div>
                            <p>Nombre tour</p>
                            <strong>{{$tour->name}}</strong>
                            <p>Ubicacion tour</p>
                            <strong>{{$tour->cuidad}},{{$tour->pais}}</strong>
                            <p>Duracion tour</p>
                            <strong>{{$tour->duration}}</strong>
                            <p>Precio tour sin comision</p>
                            <strong>{{$tour->price}} {{$tour->moneda}}</strong>
                        </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

@endpush