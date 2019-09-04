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