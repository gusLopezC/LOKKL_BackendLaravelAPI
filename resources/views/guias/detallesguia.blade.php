@extends('layouts.app')
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
                            
                        </tr>

                    </table>
                    <div class="col-12">
                        <h2>Datos bancarios:</h2>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <h5>Tipo moneda:</h5>
                                <strong>{{$guias->tipomoneda}}</strong>
                            </td>
                            <td>
                                <h5>clabe Interbancaria:</h5>
                                <strong>{{$guias->clabeInterbancaria}}</strong>
                            </td>
                            <td>
                                <h5>Numero cuenta Paypal:</h4>
                                    <strong>{{$guias->numeroCuenta}}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>RFC:</h5>
                                <strong>{{$guias->RFC}}</strong>
                            </td>
                            <td>
                                <h5>CURP:</h5>
                                <strong>{{$guias->CURP}}</strong>
                            </td>
                        </tr>

                    </table>
                    
                    <div class="col-12">
                        <h2>Documentación:</h2>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <h4>Indentificacion oficial</h4>
                            </td>
                            <td><a class="test-popup-link"
                                    href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_identificacion}}">
                                    <img class="img-responsive"
                                        src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_identificacion}}"
                                        alt="" width="300px">
                                </a></td>
                        </tr>
                        <tr>
                            <td><h4>Comprobante de domicilio</h4></td>
                            <td>
                                <a class="test-popup-link"
                                href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_comprobantedomicilio}}">

                                <img class="img-responsive"
                                    src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_comprobantedomicilio}}"
                                    alt="" width="300px">
                            </a>
                        </td>
                        </tr>
                        <tr>
                            <td><h4>Cedula fiscal</h4></td>
                            <td>
                                    @if (pathinfo($guias->document_cedulafiscal, PATHINFO_EXTENSION) == 'pdf')
                                    <a href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_cedulafiscal}}">
                                        <button class="btn btn-primary btn-block">Descargar</button></a>
                                    @endif
                                    <a class="test-popup-link"
                                        href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_cedulafiscal}}">
                                        <img class="img-responsive"
                                            src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_cedulafiscal}}" alt="" width="3  300px">
                                    </a>
                            </td>
                        </tr>
                        <tr>
                            <td><h4>Certificacion</h4></td>
                            <td>
                                    <a class="test-popup-link"
                                    href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_certificacion}}">
                                    <img class="img-responsive"
                                        src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$guias->document_certificacion}}"
                                        alt="" width="300px">
                                </a>
                            </td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

@endpush