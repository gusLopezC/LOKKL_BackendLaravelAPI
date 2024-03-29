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
                <div class="card-header">Administracion de usuarios</div>

                <div class="card-body">
                    <table id="myTable" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Email</td>
                                <td>Telefomo</td>
                                <td>Role</td>
                                <td>Opciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>{{$usuario->telefono}}</td>
                                <td>{{$usuario->role}}</td>

                                <td><a href="{{route('eliminarusuario',$usuario->id)}}" class="button is-danger" onclick="return confirm('Esta seguro que desea eliminar este registro');">Eliminar</a></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    < script src = "https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" >
</script>
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
            'autoWidth': false,

        })
        
    })
</script>
</script>
@stop