<?php

namespace App\Http\Controllers;


use App\Receta;
use App\CategoriaRecetas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {

        $this->middleware('auth',['except'=>['show','search']]);

     }
    public function index()
    {


        // Auth::user()->recetas->dd();

        //obtener un usuario
        //$usuario = auth()->user();

        // Receta::all()->dd();

        //recetas sin ganinacion
        //$recetas = Auth::user()->recetas;

        //recetas con paginacion

        $usuario = auth()->user();
        $recetas= Receta::where('user_id',$usuario->id)->paginate(3);

        return view('recetas.index')->with('recetas',$recetas)
        ->with('usuario',$usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {




        //Sin modelo listar los datos
        // DB::table('categoria_recetas')->get()->pluck('nombre','id')->dd();
        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');

        // con modelo listar los datos
        $categorias= CategoriaRecetas::all(['id','nombre']);

        return view('recetas.create')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd( $request->all() );
        // dd( $request['imagen']->store('uploads-recetas','public')  );



        //guardar datos sin modelo
        // DB::table('recetas')->insert([
        //     'titulo'=> $data['titulo'],
        //     'categoria_id'=>$data['categoria'],
        //     'preparacion'=>$data['preparacion'],
        //     'ingredientes'=>$data['ingredientes'],
        //     'imagen'=>$imagen ,
        //     'user_id'=>Auth::user()->id
        // ]);

        // guardar datos con modelo



        // Receta::create([

        //     'titulo'=> $data['titulo'],
        //     'categoria_id'=>$data['categoria'],
        //     'preparacion'=>$data['preparacion'],
        //     'ingredientes'=>$data['ingredientes'],
        //     'imagen'=>$imagen,
        //     'user_id'=>Auth::user()->id

        // ]);

        //guardar directamente


        //validar los datos
        $data = request()->validate([

        'titulo'=> 'required|min:3',
        'categoria'=>'required',
        'preparacion'=>'required',
        'ingredientes'=>'required',
        'imagen'=>'required'
          ]);


        //guardar la imagen local
        // $imagen = $request['imagen']->store('uploads-recetas','public');
        // $img =  Image::make(public_path("storage/{$imagen}"))->fit(1000,550);
        // dd($img);
        // $img = $uploadedFileUrl;
        // $img->save();

        //guardar imagen con cloudinary
        $uploadedFileUrl = Cloudinary::upload($request->file('imagen')->getRealPath(),[
            'folder' => 'uploads',
            'transformation' => [
                      'width' =>1000 ,
                      'height' => 550,
                      'crop' => 'limit'
             ]
            ])->getSecurePath();




        auth()->user()->recetas()->create([
            'titulo'=> $data['titulo'],
            'categoria_id'=>$data['categoria'],
            'preparacion'=>$data['preparacion'],
            'ingredientes'=>$data['ingredientes'],
            'imagen'=>$uploadedFileUrl
        ]);


        return redirect()->action('RecetaController@index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        // obtener si el usuario actual  le gusta la receta y esta autenticado
        $like = (auth()->user())  ? auth()->user()->meGusta->contains($receta) : false  ;

        //pasa la cantidad de like a la vista
        $likes = $receta->likes()->count();
        // dd($likes);
        return view('recetas.show')->with('recetas',$receta)
                                    ->with('like',$like)
                                    ->with('likes',$likes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {


        $this->authorize('view',$receta);
        $categorias= CategoriaRecetas::all(['id','nombre']);
        return view('recetas.edit')->with('categorias',$categorias)
                                   ->with('recetas',$receta);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {

        // dd( $request->all() );
        $this->authorize('update',$receta);
        $data = request()->validate([

            'titulo'=> 'required|min:3',
            'categoria'=>'required',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'imagen'=>'required'
        ]);


        // $receta->titulo=$data['titulo'];

        $receta->titulo= $data['titulo'];
        $receta->categoria_id= $data['categoria'];
        $receta->preparacion= $data['preparacion'];
        $receta->ingredientes= $data['ingredientes'];
        $receta->save();

        return $receta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {


        $this->authorize('delete',$receta);
        $receta->delete();
        return redirect()->action('RecetaController@index');
    }


    public function search(Request $request){

        $busqueda = $request['buscar'];
        // $busqueda = $request->get('buscar');

        $recetas = Receta::where('titulo','like','%'.$busqueda.'%')->paginate(5) ;
        $recetas->appends(['buscar'=>$busqueda]);
        return view('busqueda.show',compact('recetas','busqueda'));

    }

}
