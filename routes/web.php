<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Exports\Top100Export;
use App\Grupo;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\ExamenesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistroAlumnosController;
use App\Http\Controllers\RegistroMaestrosController;
use App\Http\Controllers\ResolvedorController;
use App\Http\Livewire\CcppEvaluator;
use App\Imports\AlumnosManualImport;
use App\Leccion;
use App\UsuarioProblema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return redirect("/nova");
});

Route::get('/file-manager', function () {
    return view("filemanager.demo");
});
Route::get('/registro-alumno', function () {
    return view('auth.registroAlumno');
});

Route::get('/registro-maestro', function () {
    return view('auth.registroMaestro');
});

Route::get('/login', function () {
    return view('auth.login');
})->name("login");

Route::get("/logout", function () {
    auth()->logout();
    return redirect("/login");
})->name("logout");

Route::post("/logout", function () {
    auth()->logout();
    return redirect("/login");
})->name("logout");

Route::post('/registro-alumno', [RegistroAlumnosController::class,'registrar']);
Route::post('/registro-maestro', [RegistroMaestrosController::class, 'registrar']);
Route::post('/login', [CustomLoginController::class, 'login'])->name("login");

Route::get("/sc/{userId}/{problemId}/{score}", function ($userId, $problemId, $score) {
    $usuarioProblema = UsuarioProblema::where("usuario_id", $userId)
        ->where("problema_id", $problemId);

    if ($usuarioProblema->count() > 0) {
        $usuarioProblema = $usuarioProblema->first();
    } else {
        $usuarioProblema = new \App\UsuarioProblema();
    }
    $usuarioProblema->usuario_id = $userId;
    $usuarioProblema->problema_id = $problemId;
    $usuarioProblema->puntos = $score;
    $usuarioProblema->save();
});



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/problemanclab', function () {
    return view("problemanclab");
});

Route::get("/descargar/{uniqid}", function ($uniqid) {
    return response()->download(storage_path("app/{$uniqid}.xlsx"));
});

Route::get("/playground", function () {

    $lecciones = Leccion::all();


    foreach ($lecciones as $leccion) {
        $posicion = 1;
        foreach ($leccion->leccionProblemas as $leccionProblema) {
            $leccionProblema->posicion = $posicion++;
            $leccionProblema->save();
        }
    }
});

Route::get("/resolver/{problemaId}", [ResolvedorController::class, 'index']);
Route::post("/resolver/evaluar", [ResolvedorController::class, 'evaluar']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/examenes/iniciar-examen/{problemaId}', [ExamenesController::class, 'iniciarExamen']);
Route::get('/examenes/iniciar-examen/{problemaId}/confirmar', [ExamenesController::class, 'iniciarExamenConfirmacion']);

Route::get('/examenes/tiempo-restante/problema/{problemaId}', [ExamenesController::class, 'tiempoRestanteProblema']);

Route::get('/resolver-ccpp/{problemaId}', [CcppEvaluator::class,'index']);
Route::post('/evaluar-ccpp', [CcppEvaluator::class,'evaluar']);
Route::post('/ejecutar-ccpp', [CcppEvaluator::class,'ejecutar']);


Route::get('/reportes/progreso-grupo-profesor/{grupoId}',function($grupoId){

    $grupos = [
        Grupo::find($grupoId)
    ];

//    dd(
//        $grupos[0]->progresoSemanualGrupoAlumno->groupBy('alumno_id')->values()->first()->groupBy('fecha')->values()->sortBy('fecha')
//    );

    return view('emails.reporte_semanal_progreso_grupos_profesor',['grupos'=>$grupos]);
});
