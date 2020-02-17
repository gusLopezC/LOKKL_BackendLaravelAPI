@component('mail::message')

<style>
    .email-row {
    }
    .email-col-2 {
        width: 49%;
        display: inline-block;
        padding-right: 15px;
    }
    .email-col-12 {
        width: 99%;
        display: inline-block;
        padding-right: 15px;
    }
    .fototour{
        max-width: 100%;
        height: 300px;
        width: 100%;
        max-height: 100%;
    }
</style>

#{{$user->name}}
<div>
    <h3>¿Has encontrado algo que te guste?</h3>
    <p>Resérvalo sabiendo que tu seguridad es lo mas importante ya que cuentas con asistencia 24 horas, 7 días a la semana.</p>
</div>

<div class="container">
    <div class="email-row">
@foreach ($tours as $tour)
    <div class="email-col-2">
        
            <img src="https://lokkl.s3.us-east-2.amazonaws.com/images/tours/{{$tour->photo}}" alt="" class="fototour">
            <h4 style="text-transform: uppercase;">{{$tour->categories}}</h4>
            <a href="https://lokkl.com/tour/{{$tour->slug}}"> 
                <h1>{{$tour->name}}</h1> 
            </a>
            <span><b> $ {{$tour->price}} {{$tour->moneda}}</b> por persona </span>
            <span style="float: right; margin-right: 20px;">{{$tour->cuidad}},{{$tour->pais}}</span>
            <br><br><br>
       
    </div>
@endforeach

@if ($otrosTours)
@foreach ($otrosTours as $tour)
<div class="email-col-2">
    <div class="card">
       
        <img src="https://lokkl.s3.us-east-2.amazonaws.com/images/tours/{{$tour->photo}}" alt="" class="fototour">
        <h4 style="text-transform: uppercase;">{{$tour->categories}}</h4>
        <a href="https://lokkl.com/tour/{{$tour->slug}}">
             <h1>{{$tour->name}}</h1>
         </a>
        <span><b> $ {{$tour->price}} {{$tour->moneda}}</b> por persona </span>
        <span style="float: right; margin-right: 20px;">{{$tour->cuidad}},{{$tour->pais}}</span>
        <br><br><br>
    </a>
</div>
</div>
@endforeach
@endif
<div class="email-col-12">
    <img src="https://lokkl.com/assets/img/aboutus/Friends_aboutus.jpg" alt="" class="fototour" style="height: 400px;">
    <h1 style="text-align: center !important;">Revisa nuestros ultimos tours</h1>
</div>
<br><br>
@foreach ($ultimosTours as $ultimostour)
    <div class="email-col-2">
        
            <img src="https://lokkl.s3.us-east-2.amazonaws.com/images/tours/{{$ultimostour->photo}}" alt="" class="fototour">
            <h4 style="text-transform: uppercase;">{{$ultimostour->categories}}</h4>
            <a href="https://lokkl.com/tour/{{$tour->slug}}">
                 <h1>{{$ultimostour->name}}</h1>
            </a>
            <span><b> $ {{$ultimostour->price}} {{$ultimostour->moneda}}</b> por persona </span>
            <span style="float: right; margin-right: 20px;">{{$ultimostour->cuidad}},{{$ultimostour->pais}}</span>
            <br><br><br>
       
    </div>
@endforeach
</div>
</div>



<br/>
<br>
Gracias<br>
El equipo de {{config('app.name')}}
<br><br>
@endcomponent