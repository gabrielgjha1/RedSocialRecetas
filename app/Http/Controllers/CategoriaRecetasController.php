<?php

namespace App\Http\Controllers;

use App\CategoriaRecetas;
use App\Receta;
use Illuminate\Http\Request;

class CategoriaRecetasController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoriaRecetas  $categoriaRecetas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $receta = CategoriaRecetas::find($id);
        $recetas = Receta::where('categoria_id',$receta->id)->paginate(6);
        return view('categorias.show',compact('recetas'));
    }

}
