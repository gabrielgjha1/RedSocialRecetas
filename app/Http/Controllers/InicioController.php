<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaRecetas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){


        // $nuevas = Receta::orderBy('created_at','ASC')->get();

        //igual que la instruccion anterior te trae los mas nuevos
        $nuevas = Receta::latest()->take(5)->get();

        //te trae los mas viejos
        // $nuevas = Receta::oldest()->get();

        //hacer para cada categoria y pasarla al modelo
        //$mexicana = Receta::where('categoria_id',2)->get();

        //obtener todas las categorias
        $categorias = CategoriaRecetas::all();
        $recetas = [];

        foreach($categorias as $categoria){

            $recetas[ Str::slug($categoria->nombre)  ][] = Receta::where('categoria_id',$categoria->id)->take(3)->get();

        }


        // $votadas = Receta::has('likes','>','0')->get();
        //obtener las recetas mas votadas
        $votadas = Receta::withCount('likes')->orderBy('likes_count','desc')->get();


        return view('inicio.index',compact('nuevas','recetas','votadas'));

    }
}
