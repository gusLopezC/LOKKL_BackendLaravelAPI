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
                                <strong>{{$prospecto->name}}</strong>
                            </td>
                            <td>
                                <h5>Emal:</h5>
                                <strong>{{$prospecto->email}}</strong>
                            </td>
                            <td>
                                <h5>Edad:</h4>
                                    <strong>{{$prospecto->edad}}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Cuidad del tour:</h5>
                                <strong>{{$prospecto->ciudad}}</strong>
                            </td>

                            <td colspan="2">
                                <h5>Como nos conociste:</h4>
                                    <strong>{{$prospecto->comonosconociste}}</strong>
                            </td>
                        </tr>
                    </table>

                    <div class="col-12">
                        <h2>Especialidad:</h2>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <h5>Que idiomas manejas:</h4>
                                    <strong>{{$prospecto->idiomas}}</strong>
                            </td>
                            <td>
                                <h5>Eres o has trabajado<br> como guia:</h5>
                                <strong>{{$prospecto->eres_guia}}</strong>
                            </td>
                            <td>
                                <h5>Trabajas como guia actualmente:</h4>
                                    <strong>{{$prospecto->trabajas_como_guia}}</strong>
                            </td>
                            <td>
                                <h5>Cuentas con <br>certificacion de guia:</h4>
                                    <strong>{{$prospecto->certificacion_guia}}</strong>
                            </td>
                            <td>
                                <h5>Cuentas con <br>certificacion de idiomas:</h4>
                                    <strong>{{$prospecto->certificacion_guia}}</strong>
                            </td>
                        </tr>
                    </table>

                    <div class="col-12">
                        <h2>Documentación:</h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <a class="test-popup-link"
                                href="{{asset('/images/documents/')}}/{{$prospecto->document_identificacion}}">
                                <img class="img-responsive"
                                    src=" {{asset('/images/documents/')}}/{{$prospecto->document_identificacion}}"
                                    alt="">
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="test-popup-link"
                                href="{{asset('/images/documents/')}}/{{$prospecto->document_comprobantedomicilio}}">

                                <img class="img-responsive"
                                    src=" {{asset('/images/documents/')}}/{{$prospecto->document_comprobantedomicilio}}"
                                    alt="">
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="test-popup-link"
                                href="{{asset('/images/documents/')}}/{{$prospecto->document_cedulafiscal}}">
                                <img class="img-responsive"
                                    src=" {{asset('/images/documents/')}}/{{$prospecto->document_cedulafiscal}}" alt="">
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="test-popup-link"
                                href="{{asset('/images/documents/')}}/{{$prospecto->document_certificacion}}">
                                <img class="img-responsive"
                                    src=" {{asset('/images/documents/')}}/{{$prospecto->document_certificacion}}"
                                    alt="">
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="test-popup-link"
                                href="{{asset('/images/documents/')}}/{{$prospecto->document_CV}}">
                                <img class="img-responsive"
                                    src=" {{asset('/images/documents/')}}/{{$prospecto->document_CV}}" alt="">
                            </a>
                        </div>
                    </div>

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
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

@endpush