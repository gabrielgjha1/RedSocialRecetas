<div class="col-md-4 mt-4">
    <div class="card shadow-dreamy">
        <img src="/storage/{{$receta->imagen}}" class="card-img-top" alt="" srcset="">
        <div class="card-body">
            <h3 class="card-title text-center">{{$receta->titulo}}</h3>
            <div class="meta-receta d-flex justify-content-between ">
                <p> a {{ count($receta->likes)}} personas le gusto esto</p>
            </div>
            <p class="card-text" >{{Str::words(strip_tags($receta->preparacion), 20) }}</p>
            <a class="btn btn-primary d-block bg-primary" href="{{route('receta.show',['receta'=>$receta->id])}}">Ver receta</a>
        </div>
    </div>
</div>
