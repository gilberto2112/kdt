<?php

namespace Tests\Unit;

use App\Institucion;
use App\InstitucionUsuario;
use App\Usuario;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InstitucionesTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $usuario = factory(Usuario::class)->create(['role'=>'alumno']);

        $institucion = new Institucion();
        $institucion->nombre = 'FACPYA';
        $institucion->logo = "asdasdad.jpg";
        $institucion->save();

        $institucionUsuario = new InstitucionUsuario();
        $institucionUsuario->institucion_id = $institucion->id;
        $institucionUsuario->usuario_id = $usuario->id;
        $institucionUsuario->save();

        $this->assertEquals($institucion->usuarios->first()->id,$usuario->id);
    }
}
