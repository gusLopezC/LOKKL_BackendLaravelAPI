@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body row">
                    <div class="col-12">
                        <h2>Datos:</h2>
                        <div class="alert alert-info" role="alert">
                            @foreach ($tours->getUser as $usuario)
                            Tour creado por : {{$usuario->name}}
                            <br>
                            @if($usuario->role == 'GUIDE_VERIFIQUED')
                            <strong> Este usuario es verificado como guia</strong>
                            @endif
                            @if($usuario->role == 'USER_ROLE' || $usuario->role == 'ADMIN_ROLE' )
                            <a href="/prospectos"><strong> Este usuario aun no es verificado revisa si ya lleno su ficha de registro</strong></a>
                            @endif
                            @endforeach
                            <br>
                            <br>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td colspan="4">
                                        <h5>Nombre:</h5>
                                        <strong>{{$tours->name}}</strong>
                                    </td>
                                    <td colspan="2">
                                        <h5>Ciudad del tour:</h5>
                                        <strong>{{$tours->cuidad}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Ofrecido en :</h4>
                                            <strong>{{$tours->lenguajes}}</strong>
                                    </td>
                                    <td>
                                        <h5>Pais:</h4>
                                            <strong>{{$tours->pais}}</strong>
                                    </td>
                                    <td>
                                        <h5>Categoria:</h4>
                                            <strong>{{$tours->categories}}</strong>
                                    </td>
                                    <td>
                                        <h5>Precio normal</h5>
                                        <h6><strong>{{$tours->price}} {{$tours->moneda}}</strong></h6>
                                    </td>
                                    <td>
                                        <h5>Precio a publico</h5>
                                        <h6><strong>{{$tours->priceFinal}} {{$tours->moneda}}</strong></h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <h5>Descripción</h5>
                                        <strong>{{$tours->schedulle}}</strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="col-sm-6">
                        <iframe style="height: 400px" src="https://maps.google.com/?ll={{$tours->mapaGoogle[0]}},{{$tours->mapaGoogle[1]}}&z=16 &t=m&output=embed" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    <div class="col-sm-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>
                                        <h5>Punto de inicio:</h5>
                                        <strong>{{$tours->puntoInicio}}</strong>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5>Descripción</h5>
                                        <strong>{{$tours->schedulle}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Duracion:</h5>
                                        <strong>{{$tours->duration}} h</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Pais:</h5>
                                        <strong>{{$tours->pais}}</strong>
                                    </td>
                                </tr>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Administrar media</h2>
                            <div class="row no-gutters">
                                @foreach ($tours->getPhotos as $imagen)
                                <div class="col-sm-4">
                                    <form method="POST" action="{{ route('admin.photos.destroy',$imagen->photo)}}">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button class="btn btn-danger btn-xs" style="position:absolute"><i class="fas fa-times"></i></button>
                                        <a class="test-popup-link" href="https://lokkl.s3.us-east-2.amazonaws.com/images/tours/{{$imagen->photo}}">
                                            <img src="https://lokkl.s3.us-east-2.amazonaws.com/images/tours/{{$imagen->photo}}" class="img-responsive" alt="" width="150px" height="150px"></a>

                                    </form>
                                </div>
                                @endforeach
                            </div>



                        </div>
                        <div class="col-sm-6">
                            <h4>Administrar itinierario</h4>
                            {{$tours->whatsIncluded}}

                            <h4>Administrar que incluye</h4>
                            {{$tours->itinerary}}
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>

                </div>
            </div>

            <div class="card">
                <div class="row botonesprospectos">

                    <div class="col-sm-6">
                        <a href="{{route('AceptarTour',$tours)}}">
                            <button type="submit" class="btn btn-success" style="width: 90%;">Aceptar
                                tour</button></a>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{route('NegarTour',$tours)}}">
                            <button type="submit" class="btn btn-danger" style="width: 90%;">Negar tour</button></a>
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