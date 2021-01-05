@extends('layouts.app')

@section('content')
    {{-- {{$perfil->usuario->recetas}} --}}

    <div class="row">

        <div class="col-md-5 col-12">
            @if ($perfil->imagen)


                <img src="/storage/{{$perfil->imagen}}" class="w-100 rounded-circle" alt="">



          @endif
        </div>

        <div class="col-md-7 col-12 mt-4  perfil">
            <div>
                <h2 class="text-center mb-2 " >Perfil de: {{$perfil->usuario->name}}</h2>
                <h4 class="mt-5">Bibliografia</h4>
                <p  >  {!!$perfil->bibliografia!!}   </p>

            </div>
            <div>
                <a class=" btn btn-block btn-primary  bg-primary d-block text-center" href="{{$perfil->usuario->url}}">Pagina web</a>
            </div>

        </div>


    </div>

    <h2 class="text-center mt-5" > Recetas creadas por {{$perfil->usuario->name}}</h2>

    <div class="container">
        <div class="row mx-auto bg-white p-4" >
            @if (count($recetas)>0)
                @foreach ($recetas as $item)

                    <div class="col-md-4 mb-4">
                        <div class="card  shadow-dreamy">
                            <img src="/storage/{{$item->imagen}}" class="card-img-top" alt="">


                            <div class="card-body">
                                <h3 class=" text-center">{{$item->titulo}}</h3>

                                <a href="{{route('receta.show',['receta'=>$item->id])}}" class="btn btn-primary bg-primary btn-block">Ver receta</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center w-100">No hay recetas aun</p>
            @endif

        </div>
        <div>
            {{$recetas->links()}}
        </div>
    </div>



@endsection
