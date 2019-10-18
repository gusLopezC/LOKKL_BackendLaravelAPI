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
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <h5>Nombre:</h5>
                                <strong>{{$guias->name}}</strong>
                            </td>
                            <td>
                                <h5>Emal:</h5>
                                <strong>{{$guias->email}}</strong>
                            </td>
                            <td>
                                <h5>Edad:</h4>
                                    <strong>{{$guias->edad}}</strong>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h5>Ciudad del tour:</h5>
                                <strong>{{$guias->ciudad}}</strong>
                            </td>
                            <td colspan="2">
                                <h5>Telefono:</h5>
                                <strong>{{$guias->telefono}}</strong>
                            </td>

                        </tr>

                    </table>
                    <div class="col-12">
                        <h2>Datos bancarios:</h2>
                    </div>
                    <div class="col-12">
                        @if (count($guias->getDatosPago) == 0 )
                        <div class="alert alert-warning" role="alert">
                            Este usaurio aun no carga sus datos bancarios
                            <br><br>
                        </div>
                        @endif
                        @foreach ($guias->getDatosPago as $pago)

                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <h5>Tipo moneda:</h5>
                                    <strong>{{$pago->tipomoneda}}</strong>
                                </td>
                                <td>
                                    <h5>clabe Interbancaria:</h5>
                                    <strong>{{$pago->clabeInterbancaria}}</strong>
                                </td>
                                <td>
                                    <h5>Numero cuenta Paypal:</h4>
                                        <strong>{{$pago->numeroCuenta}}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>RFC:</h5>
                                    <strong>{{$pago->RFC}}</strong>
                                </td>
                                <td>
                                    <h5>CURP:</h5>
                                    <strong>{{$pago->CURP}}</strong>
                                </td>
                                <td>
                                    <h5>Pais:</h5>
                                    <strong>{{$pago->pais}}</strong>
                                </td>
                            </tr>

                        </table>
                        @endforeach
                    </div>
                    <div class="col-12">
                        <h2>Sus tours:</h2>
                    </div>
                    <div class="col-12">
                    @if (count($guias->getTours) == 0 )
                        <div class="alert alert-warning" role="alert">
                            Este usaurio aun no carga su tours
                            <br><br>
                        </div>
                        @endif
                        <table class="table table-bordered">
                            @foreach ($guias->getTours as $tour)
                            <tr>
                                <td>
                                    <h5>Nombre tour:</h5>
                                    <a href="{{route('detallestours',$tour->id)}}"><strong>{{$tour->name}}</strong>
                                    </a>

                                </td>
                                <td>
                                    <h5>Nombre tour:</h5>
                                    <strong>{{$tour->cuidad}}</strong>
                                </td>
                                <td>
                                    <h5>Precio base:</h5>
                                    <strong>{{$tour->price}}</strong>
                                </td>
                            </tr>
                            @endforeach

                        </table>

                    </div>

                    <div class="col-12">
                        <h2>Documentación:</h2>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <h4>Indentificacion oficial</h4>
                            </td>
                            <td><a class="test-popup-link" href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_identificacion}}">
                                    <img class="img-responsive" src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_identificacion}}" alt="" width="300px">
                                </a></td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Comprobante de domicilio</h4>
                            </td>
                            <td>
                                <a class="test-popup-link" href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_comprobantedomicilio}}">

                                    <img class="img-responsive" src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_comprobantedomicilio}}" alt="" width="300px">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Cedula fiscal</h4>
                            </td>
                            <td>
                                @if (pathinfo($guias->document_cedulafiscal, PATHINFO_EXTENSION) == 'pdf')
                                <a href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_cedulafiscal}}">
                                    <button class="btn btn-primary btn-block">Descargar</button></a>
                                @endif
                                <a class="test-popup-link" href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_cedulafiscal}}">
                                    <img class="img-responsive" src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_cedulafiscal}}" alt="" width="300px">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Certificacion</h4>
                            </td>
                            <td>
                                <a class="test-popup-link" href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_certificacion}}">
                                    <img class="img-responsive" src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_certificacion}}" alt="" width="300px">
                                </a>
                            </td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

@endpush