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
                    <table class="table">
                        <tr>
                            <td>
                                <h5>Nombre:</h5>
                                <strong>{{$prospecto->nameContacto}}</strong>
                            </td>
                            <td>
                                <h5>Email:</h5>
                                <strong>{{$prospecto->emailContacto}}</strong>
                            </td>
                            
                            <td>
                                <h5>Edad:</h4>
                                    <strong>{{$prospecto->edad}}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Ciudad del tour:</h5>
                                <strong>{{$prospecto->ciudad}}</strong>
                            </td>
                            <td >
                                <h5>Telefono:</h4>
                                    <strong>{{$prospecto->telefonoContacto}}</strong>
                            </td>

                            <td >
                                <h5>Como nos conociste:</h4>
                                    <strong>{{$prospecto->comoNosConociste}}</strong>
                            </td>
                           
                        </tr>
                    </table>

                    <div class="col-12">
                        <h2>Especialidad:</h2>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                           
                            <td>
                                <h5>Eres o has trabajado como guia:<br>Trabajas como guia actualmente:<br>Cuentas con certificacion de idiomas:</h5>
                            </td>
                            <td>
                            <strong>{{$prospecto->preguntasGuia}}</strong>
                            </td>
                        </tr>
                    </table>

                    <div class="col-12">
                        <h2>Documentación:</h2>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <h1>Indentificacion oficial</h1>
                            </td>
                            <td><a class="test-popup-link"
                                    href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$prospecto->document_identificacion}}">
                                    <img class="img-responsive"
                                        src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$prospecto->document_identificacion}}"
                                        alt="" width="300px">
                                </a></td>
                        </tr>
                        <tr>
                            <td><h4>Comprobante de domicilio</h4></td>
                            <td>
                                <a class="test-popup-link"
                                href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$prospecto->document_comprobantedomicilio}}">

                                <img class="img-responsive"
                                    src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$prospecto->document_comprobantedomicilio}}"
                                    alt="" width="300px">
                            </a>
                        </td>
                        </tr>
                        <tr>
                            <td><h4>Cedula fiscal</h4></td>
                            <td>
                                    @if (pathinfo($prospecto->document_cedulafiscal, PATHINFO_EXTENSION) == 'pdf')
                                    <a href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$prospecto->document_cedulafiscal}}">
                                        <button class="btn btn-primary btn-block">Descargar</button></a>
                                    @endif
                                    <a class="test-popup-link"
                                        href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$prospecto->document_cedulafiscal}}">
                                        <img class="img-responsive"
                                            src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$prospecto->document_cedulafiscal}}" alt="" width=" 300px">
                                    </a>
                            </td>
                        </tr>
                        <tr>
                            <td><h4>Certificacion</h4></td>
                            <td>
                                    <a class="test-popup-link"
                                    href="https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$prospecto->document_certificacion}}">
                                    <img class="img-responsive"
                                        src=" https://lokkl.s3.us-east-2.amazonaws.com/images/documents/{{$prospecto->document_certificacion}}"
                                        alt="" width="300px">
                                </a>
                            </td>
                        </tr>
                    </table>
                    <div class="row botonesprospectos">
                        <div class="col-sm-4">
                            <a href="{{route('aceptarProspecto',$prospecto)}}">
                                <button type="submit" class="btn btn-success" style="width: 90%;">Validar
                                    prospecto</button></a>
                        </div>
                        <div class="col-sm-4">
                            <a href="{{route('solicitarDocumentos',$prospecto)}}">
                                <button type="submit" class="btn btn-warning" style="width: 90%;">Solicitar
                                    documentos</button>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="{{route('solicitarDocumentos',$prospecto)}}"> <button type="submit"
                                    class="btn btn-danger" style="width: 90%;">Negar
                                    solicitud</button>
                            </a>
                        </div>
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