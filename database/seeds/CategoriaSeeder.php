<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_recetas')->insert([

            'nombre'=>'Comidas Panameña',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),

        ]);

        DB::table('categoria_recetas')->insert([

            'nombre'=>'Comidas Mexicana',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),

        ]);

        DB::table('categoria_recetas')->insert([

            'nombre'=>'Comidas Italiana',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),

        ]);


        DB::table('categoria_recetas')->insert([

            'nombre'=>'Comidas Argentina',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),

        ]);

        DB::table('categoria_recetas')->insert([

            'nombre'=>'Postres',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),

        ]);

        DB::table('categoria_recetas')->insert([

            'nombre'=>'Bebidas',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),

        ]);


    }
}
