@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection
@section('botones')

    <a href="{{ route('receta.index')}}" class="btn btn-primary bg-primary mb-5" >  Ver Recetas </a>
@endsection
@section('content')

    <div class="p-2 shadow-dreamy">

        <h1 class="text-center" >Editar nuestro perfil</h1>
        <div class="row justify-content-center mt-5" >
            <div  class="col-md-10 bg-withe p-3" >

                <form action="{{route('perfiles.update',['perfil'=>$perfil->id])}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                    <label for="name">Email address</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{$perfil->usuario->name}}" placeholder="Enter email">
                    @error('name')

                      <span  class="invalid-feedback d-block " role="alert" >

                        <strong>{{$message}}</strong>

                         </span>
                          @enderror
                    </div>

                    <div class="form-group">
                        <label for="url">Email address</label>
                        <input type="text" class="form-control" id="url" name="url" value="{{$perfil->usuario->email}}"  aria-describedby="emailHelp" placeholder="Enter email">
                        @error('url')

                          <span  class="invalid-feedback d-block " role="alert" >

                            <strong>{{$message}}</strong>

                             </span>
                              @enderror
                    </div>
                    <div class="form-group" >

                        <label for="bibliografia">bibliografia</label>
                        <input type="hidden"  value="{{$perfil->usuario->perfil->bibliografia}}"  name="bibliografia" id="bibliografia" >
                        <trix-editor input="bibliografia"></trix-editor>
                        @error('bibliografia')

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

                          @if ($perfil->imagen)


                            <div class="mt-4" >

                                <p>Imagen actual:</p>
                                <img src="/storage/{{$perfil->imagen}}" alt="">
                            </div>


                          @endif

                      </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" defer integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>@endsection
