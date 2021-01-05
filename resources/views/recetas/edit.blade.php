@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')

    <a href="{{ route('receta.index')}}" class="btn btn-primary bg-primary mb-5" >  Ver Recetas </a>
@endsection

@section('content')

    <form method="POST" class="shadow-dreamy p-3" enctype="multipart/form-data" action="{{route('receta.show',['receta'=>$recetas->id])}}" novalidate >

        @csrf
        @method('PUT')

        <h1 class="text-center  mb-2" >Crear recetas</h1>
        <hr class="">
        <div class="form-group">
        <label for="titulo">Titulo de la receta</label>
        <input type="text"  value="{{$recetas->titulo}}"  class="form-control" id="titulo" name="titulo" placeholder="Ingrese titulo de la receta">

        @error('titulo')

            <span  class="invalid-feedback d-block " role="alert" >

                <strong>{{$message}}</strong>

            </span>

        @enderror

    </div>

    <div class="form-group">
        <label for="categoria">Example select</label>
        <select class="form-control" name="categoria" id="categoria">
        @foreach ($categorias as $item )
        <option value="{{$item->id}}" >{{$item->nombre}}</option>

        @endforeach

        @error('categoria')

            <span  class="invalid-feedback d-block " role="alert" >

                <strong>{{$message}}</strong>

            </span>
        @enderror

        </select>
      </div>

      <div class="form-group" >

        <label for="preparacion">Preparacion</label>
        <input value="{{$recetas->preparacion}}" type="hidden"  name="preparacion" id="preparacion" >
        <trix-editor input="preparacion"></trix-editor>
        @error('preparacion')

            <span  class="invalid-feedback d-block " role="alert" >

                <strong>{{$message}}</strong>

            </span>
        @enderror

      </div>

      <div class="form-group" >

        <label for="ingredientes">Ingredientes</label>
        <input value="{{$recetas->ingredientes}}" type="hidden" name="ingredientes" id="ingredientes" >
        <trix-editor input="ingredientes"></trix-editor>
        @error('ingredientes')

        <span  class="invalid-feedback d-block " role="alert" >

            <strong>{{$message}}</strong>

        </span>
    @enderror
      </div>

      <div class="form-group">
        <label for="imagen">Ingrese una imagen</label>
        <input type="file" class="form-control-file" name="imagen" id="imagen">

            @error('imagen')

            <span  class="invalid-feedback d-block " role="alert" >

                <strong>{{$message}}</strong>

            </span>
          @enderror

      </div>

      <div class="row">


        <div class="col-6">
            <p>Imagen anterior:</p>
            <img class="img-fluid" src="{{$recetas->imagen}}" alt="" srcset="">

        </div>

      </div>


    <input type="submit" class="btn btn-primary bg-primary mt-3 btn-block" value="Agregar Receta"  >
    </form>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" defer integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>@endsection
