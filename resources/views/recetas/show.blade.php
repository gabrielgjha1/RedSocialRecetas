
@extends('layouts.app')

@section('content')

    <div class="shadow-dreamy p-3">
        <h1 class="text-center">Recetas <span>{{$recetas->titulo}}</span></h1>
        <hr>



        <img class="img-fluid w-100 text-center" src="{{$recetas->imagen}}" alt="">
        <section class="infos">

            <p> Escrito en: <span>  {{$recetas->titulo}}  </span> </p>
            <p> Autor: <span> {{$recetas->usuario->name}}    </span> </p>
            <p> Fecha: <span> {{ $recetas->created_at}}    </span> </p>

        </section>

        <section class="ingredientes" >
            <h4>Ingredientes</h4>
            <p>{!! $recetas->ingredientes !!}</p>

            <h4>Preparación</h4>
            <p>{!! $recetas->preparacion !!}</p>


        </section>

        <like-button class=" d-block text-center"
        receta-id="{{$recetas->id}}"
        like="{{$like}}"
        likes={{$likes}}
                ></like-button>
                {{-- {{$recetas->usuario->id}} --}}
                <a class="btn btn-primary bg-primary btn-block" href="{{route('perfiles.show',['perfil'=>$recetas->usuario->id])}}">Ver perfil del usuario</a>
    </div>




@endsection
