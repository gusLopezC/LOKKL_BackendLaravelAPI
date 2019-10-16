@extends('adminlte::page')

@section('title', 'Admin Tours')

@section('content_header')
<h1>Administrar Tours</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Peticiones de tours</div>

                <div class="card-body">
                    <table id="myTable" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Ciudad</td>
                                <td>Pais</td>
                                <td>Precio Base</td>
                                <td>Fecha creación</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tours as $tour)
                            @if($tour->verificado == 'No')

                            <tr>
                                <td>
                                    <a href="{{route('detallestours',$tour->id)}}">{{$tour->name}}
                                    </a>
                                </td>
                                <td>{{$tour->cuidad}}</td>
                                <td>{{$tour->pais}}</td>
                                <td>{{$tour->price}}</td>
                                <td>{{$tour->created_at}}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tours Aceptados</div>

                <div class="card-body">
                    <table id="myTable2" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Ciudad</td>
                                <td>Pais</td>
                                <td>Precio Base</td>
                                <td>Fecha creación</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tours as $tour)
                            @if($tour->verificado == 'Si')

                            <tr>
                                <td>
                                    <a href="{{route('detallestours',$tour->id)}}">{{$tour->name}}
                                    </a>
                                </td>
                                <td>{{$tour->cuidad}}</td>
                                <td>{{$tour->pais}}</td>
                                <td>{{$tour->price}}</td>
                                <td>{{$tour->created_at}}</td>
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
            "pageLength": 30,
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,

        })
        $('#myTable2').DataTable({
            "pageLength": 30,
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