<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Problema;
use App\UsuarioProblema;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CcppEvaluator extends Controller
{

    public $problema;
    public $codigo;

    public function index($problemaId)
    {
        $this->problema = Problema::find($problemaId);
        $usuarioProblema = UsuarioProblema::where("problema_id", $problemaId)->where("usuario_id", auth()->user()->id);
        $ultimoCodigo = $this->problema->solucion_inicial;
        if ($usuarioProblema->count() > 0) {
            $ultimoCodigo = $usuarioProblema->first()->ultimo_codigo;
        }


        return view('livewire.ccpp-evaluator', ['problema' => $this->problema,'ultimoCodigo'=>$ultimoCodigo])->layout('livewirelayout1');
    }

    public function evaluar(Request $r)
    {

        $solucion = $r->get('solucion');
        $problemaId = $r->get('problema_id');

        $problema = Problema::find($problemaId);

        $totalCasosResueltos = 0;

        foreach ($problema->problemaCCppCasos as $key => $caso) {

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "http://127.0.0.1:2358/submissions?base64_encoded=true&wait=true&fields=*",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"language_id\": 52,
                \"source_code\": \"".base64_encode($solucion)."\",
                \"stdin\": \"".base64_encode($caso->input)."\",
                \"cpu_time_limit\": 2,
                \"expected_output\": \"".base64_encode($caso->output)."\"
            }",
                CURLOPT_HTTPHEADER => [
                    "content-type: application/json",
                    "x-rapidapi-host: judge0-ce.p.rapidapi.com",
                    "x-rapidapi-key: 5083789a91msh1984262139eda14p1ac728jsnac85c30c3b10"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if (json_decode($response)->status->id===3) {
                $totalCasosResueltos++;
            };
        }


        $problemaUsuario = UsuarioProblema::where('usuario_id',auth()->user()->id)->where('problema_id',$problema->id);

        if($problemaUsuario->count()>0){
            $problemaUsuario = $problemaUsuario->first();
        }else {
            $problemaUsuario = new UsuarioProblema();
        }

        $problemaUsuario->usuario_id = auth()->user()->id;
        $problemaUsuario->problema_id = $problema->id;
        $problemaUsuario->puntos = (int)($problema->puntos * ($totalCasosResueltos/$problema->problemaCCppCasos->count()));
        $problemaUsuario->ultimo_codigo = $solucion;
        $problemaUsuario->save();

        return [
            'total-casos-resueltos' => $totalCasosResueltos,
            'total-casos' => $problema->problemaCCppCasos->count(),
            'puntos_obtenidos'=>$problemaUsuario->puntos,
            'puntos_problema'=>$problema->puntos
        ];


    }


    public function ejecutar(Request $r)
    {

        $solucion = $r->get('solucion');
        $problemaId = $r->get('problema_id');
        $input = $r->get('input');

        $problema = Problema::find($problemaId);


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "http://127.0.0.1:2358/submissions?base64_encoded=true&wait=true&fields=*",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{
            \"language_id\": 52,
            \"source_code\": \"".base64_encode($solucion)."\",
            \"stdin\": \"".base64_encode($input)."\",
            \"cpu_time_limit\": 2
        }",
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "x-rapidapi-host: judge0-ce.p.rapidapi.com",
                "x-rapidapi-key: 5083789a91msh1984262139eda14p1ac728jsnac85c30c3b10"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return ['output' => ($err)];
        }



        $responseDecoded = json_decode($response);


        return ['output' => base64_decode($responseDecoded->stdout),'compile_output'=>$responseDecoded->compile_output];

    }


}
