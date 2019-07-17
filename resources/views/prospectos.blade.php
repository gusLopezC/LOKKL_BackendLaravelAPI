<table>
    <tr>
        <td>Nombre</td>
        <td>Email</td>
        <td>Edad</td>
        <td>Cuidad Tour</td>
        <td>Es guia</td>
        <td>Opciones</td>
    </tr>
    @foreach ($prospectos as $prospecto)
    <tr>
        <td>{{$prospecto->name}}</td>
        <td>{{$prospecto->email}}</td>
        <td>{{$prospecto->edad}}</td>
        <td>{{$prospecto->cuidad_origin}}</td>
        <td>{{$prospecto->eres_guia}}</td>
        <td></td>

    </tr>
    @endforeach
</table>

{{-- 
"id": 1,
    "name": "aldo",
    "email": "la2o@gmail.com",
    "edad": "12",
    "cuidad_origin": "ala",
    "eres_guia": "si",
    "trabajas_como_guia": "si",
    "certificacion_guia": "si",
    "idiomas_quemanejas": "si",
    "certificacion_idiomas": "si",
    "como_nos_conociste": "internet",
    "user_id": 1, --}}