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
                    <div-col-sm-4> <button type="submit" class="btn btn-success">Validar prospecto</button>
                    </div-col-sm-4>
                    <div-col-sm-4> <button type="submit" class="btn btn-warning">Solicitar documentos</button>
                    </div-col-sm-4>
                    <div-col-sm-4> <button type="submit" class="btn btn-danger">Negar solicitud</button></div-col-sm-4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush