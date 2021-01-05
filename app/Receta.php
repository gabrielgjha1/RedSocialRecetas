<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{

    protected $fillable = [
        'titulo', 'categoria_id', 'preparacion','ingredientes','imagen'
    ];
   public function categoria(){

    return $this->belongsTo(CategoriaRecetas::class);

   }

   public function usuario(){

    return $this->belongsTo(User::class,'user_id');

   }

   //like que ha recibido una receta
   public function likes(){


        return $this->belongsToMany(User::class,'like_recetas','recetas_id','user_id');


   }

}
