<?php

use App\Usuario;
use Illuminate\Database\Seeder;

class UsuariosInicialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new Usuario();
        $user->role = "administrador";
        $user->name = "Rubén";
        $user->email = "rubennavarroc.94@gmail.com";
        $user->password = bcrypt("paralelo");
        $user->save();

    }
}
