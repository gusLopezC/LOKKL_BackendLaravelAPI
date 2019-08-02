@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table id="myTable" class="table">
                            <thead>
                        <tr>
                            <td>Nombre</td>
                            <td>Email</td>
                            <td>Edad</td>
                            <td>Cuidad Tour</td>
                            <td>Archivos de verificación</td>
                            <td>Fecha registro</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prospectos as $prospecto)
                        <tr>
                            <td><a href="{{route('detallesprospecto',$prospecto->id)}}">{{$prospecto->name}}</a></td>
                            <td>{{$prospecto->email}}</td>
                            <td>{{$prospecto->edad}}</td>
                            <td>{{$prospecto->cuidad_origin}}</td>
                            <td>{{$prospecto->created_at}}</td>
                            <td><a href="{{route('eliminarprospecto',$prospecto->id)}}" class="button is-danger"
                                onclick="return confirm('Esta seguro que desea eliminar este registro');">Eliminar</a></td>
                    
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
        $(function () {
            $('#myTable').DataTable({
              'paging'      : true,
              'lengthChange': false,
              'searching'   : false,
              'ordering'    : true,
              'info'        : true,
              'autoWidth'   : false
            })
          })

</script>
@endpush