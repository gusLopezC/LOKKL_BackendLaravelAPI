@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Prospectos Nuevos</div>

                <div class="card-body">
                    <table id="myTable" class="table">
                            <thead>
                        <tr>
                            <td>Nombre</td>
                            <td>Email</td>
                            <td>Telefono</td>
                            <td>Cuidad Tour</td>
                            <td>Pais</td>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guias as $guia)
                          <tr>
                              <td><a href="{{route('detallesguia',$guia->id)}}">{{$guia->name}}</a></td>
                              <td>{{$guia->email}}</td>
                              <td>{{$guia->telefono}}</td>
                              <td>{{$guia->ciudad}}</td>
                              <td>{{$guia->pais}}</td>
                              <td><a href="{{route('eliminarguia',$guia->id)}}" class="button is-danger"
                                  onclick="return confirm('Esta seguro que desea eliminar este registro');">Eliminar</a></td>

                          </tr>
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