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
                <div class="card-header">Prospectos Nuevos</div>

                <div class="card-body">
                    <table id="myTable" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Email</td>
                                <td>Edad</td>
                                <td>Ciudad Tour</td>
                                <td>Fecha registro</td>
                                <td>Opciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prospectos as $prospecto)
                            @if($prospecto->estado == 'Nuevo')
                            <tr>
                                <td><a href="{{route('detallesprospecto',$prospecto->id)}}">{{$prospecto->nameContacto}}</a></td>
                                <td>{{$prospecto->emailContacto}}</td>
                                <td>{{$prospecto->edad}}</td>
                                <td>{{$prospecto->ciudad}}</td>
                                <td>{{$prospecto->created_at}}</td>
                                <td><a href="{{route('eliminarprospecto',$prospecto->id)}}" class="button is-danger" onclick="return confirm('Esta seguro que desea eliminar este registro');">Eliminar</a></td>

                            </tr>

                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Prospectos Pendientes</div>

                <div class="card-body">
                    <table id="myTable" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Email</td>
                                <td>Edad</td>
                                <td>Ciudad Tour</td>
                                <td>Fecha registro</td>
                                <td>Opciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prospectos as $prospecto)
                            @if($prospecto->estado == 'Pendiente')
                            <tr>
                                <td><a href="{{route('detallesprospecto',$prospecto->id)}}">{{$prospecto->nameContacto}}</a></td>
                                <td>{{$prospecto->emailContacto}}</td>
                                <td>{{$prospecto->edad}}</td>
                                <td>{{$prospecto->ciudad}}</td>
                                <td>{{$prospecto->created_at}}</td>
                                <td><a href="{{route('eliminarprospecto',$prospecto->id)}}" class="button is-danger" onclick="return confirm('Esta seguro que desea eliminar este registro');">Eliminar</a></td>

                            </tr>

                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Prospectos Rechazados</div>

                <div class="card-body">
                    <table id="myTable" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Email</td>
                                <td>Edad</td>
                                <td>Ciudad Tour</td>
                                <td>Archivos de verificación</td>
                                <td>Fecha registro</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prospectos as $prospecto)
                            @if($prospecto->estado == 'Rechazados')
                            <tr>
                                <td><a href="{{route('detallesprospecto',$prospecto->id)}}">{{$prospecto->name}}</a></td>
                                <td>{{$prospecto->email}}</td>
                                <td>{{$prospecto->edad}}</td>
                                <td>{{$prospecto->cuidad_origin}}</td>
                                <td>{{$prospecto->created_at}}</td>
                                <td><a href="{{route('eliminarprospecto',$prospecto->id)}}" class="button is-danger" onclick="return confirm('Esta seguro que desea eliminar este registro');">Eliminar</a></td>

                            </tr>

                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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