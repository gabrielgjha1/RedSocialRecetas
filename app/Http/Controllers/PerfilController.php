<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth',['except'=>'show']);
     }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {

        $recetas = Receta::where('user_id',$perfil->user_id)->paginate(3);

        return view('profiles.profiles')->with('perfil',$perfil)
                                        ->with('recetas',$recetas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        // dd($perfil);

        $this->authorize('view',$perfil);
        return  view('profiles.edit',compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        // dd($request);
        //validaciones

        $this->authorize('update',$perfil);

        $data = request()->validate([
            'name'=>'required',
            'url'=>'required',
            'bibliografia'=>'required',
        ]);

        //si se subio una imagen

        if ($request['imagen']){
               //guardar la imagen
            // $imagen = $request['imagen']->store('uploads-perfiles','public');
            // $img =  Image::make(public_path("storage/{$imagen}"))->fit(600,600);
            // $img->save();

            $uploadedFileUrl = Cloudinary::upload($request->file('imagen')->getRealPath(),[
                'folder' => 'uploads',
                'transformation' => [
                          'width' =>600 ,
                          'height' => 600,
                          'crop' => 'limit'
                 ]
            ])->getSecurePath();


            $array_image = ['imagen'=>$uploadedFileUrl];
        }

        //guardar datos del usuario
        auth()->user()->paginaweb = $data['url'];
        auth()->user()->name = $data['name'];
        auth()->user()->save();

        //eliminar datos que no pertenecen al perfil
        unset($data['url']);
        unset($data['name']);

        //actualizar usuarios
        auth()->user()->perfil()->update(array_merge(
            $data,
            $array_image ?? []
        ));

        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
