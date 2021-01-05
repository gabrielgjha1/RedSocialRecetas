<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $user = User::create([

        //     'name'=>'gabriel',
        //     'email'=>'gabrielgjha1@gmail.com',
        //     'password'=>Hash::make('gabriel123'),
        //     'paginaweb'=>'gabriel.com',

        // ]);

        // $user->perfil()->create();

        // DB::table('users')->insert([


        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s'),

        // ]);

    }
}
