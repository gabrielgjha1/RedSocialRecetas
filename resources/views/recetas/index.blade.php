@extends('layouts.app')


@section('botones')

    <a href="{{ route('receta.create')}}" class="btn btn-primary bg-primary mb-5" >  Crear Receta </a>
    <a href="{{ route('perfiles.edit',['perfil'=>Auth::user()->id])}}" class="btn btn-primary bg-primary mb-5" >  Editar Perfil </a>
    @endsection

@section('content')

<div class="shadow-dreamy p-2" >

    <h1 class="text-center  mb-2" >Recetas</h1>
    <hr class="">

    <table class="table">

        <thead class="bg-primary ">
          <tr>
            <th class="text-center" scope="col">Titulo</th>
            <th class="text-center" scope="col">Categoria</th>
            <th class="text-center" scope="col">Acciones</th>

          </tr>
        </thead>
        <tbody>

            @foreach ($recetas as $item)
            <tr>

              <td class="text-center" >{{$item->titulo}}</td>
              <td class="text-center" >{{$item->categoria->nombre}}</td>
              <td class="text-center" >
              <a href="{{route('receta.show',['receta'=>$item->id])}}">  <span class="btn btn-success d-block w-100 mb-2">Ver</span> </a>

               <eliminar-receta
                    receta-id={{$item->id}}
               ></eliminar-receta>

              <input type="submit" class="btn btn-info d-block w-100" value="Actualizar " >
            </td>
            </tr>

            @endforeach
        </tbody>
      </table>
      {{$recetas->links()}}

    <div>
        <h2 class="text-center my-5" >Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3" >
            <ul class="list-group" >
                @foreach ($usuario->meGusta as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <p>{{$item->titulo}}</p>
                        <a href="{{route('receta.show',['receta'=>$item->id])}}">Ver</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>


@endsection
