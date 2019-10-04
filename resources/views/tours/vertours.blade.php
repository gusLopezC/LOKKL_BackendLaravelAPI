@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Peticiones de tours</div>

                <div class="card-body">
                    <table id="myTable" class="table">
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
                            <td>
                            <a href="{{route('detallestours',$tour->id)}}">{{$tour->name}}
                            </a>
                            </td>
                            <td>{{$tour->cuidad}}</td>
                            <td>{{$tour->pais}}</td>
                            <td>{{$tour->price}}</td>
                            <td>{{$tour->created_at}}</td>

                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tours Aceptados</div>

                <div class="card-body">
                    <table id="myTable" class="table">
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
                            <td>
                            <a href="{{route('detallestours',$tour->id)}}">{{$tour->name}}
                            </a>
                            </td>
                            <td>{{$tour->cuidad}}</td>
                            <td>{{$tour->pais}}</td>
                            <td>{{$tour->price}}</td>
                            <td>{{$tour->created_at}}</td>

                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br><br>
</div>
@endsection
@push('scripts')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#myTable').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>
@endpush