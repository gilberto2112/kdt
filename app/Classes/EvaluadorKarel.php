<?php

namespace App\Classes;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class EvaluadorKarel
{

    // Normalize line endings.
    private function normalize($s)
    {
        // Convert all line-endings to UNIX format.
        $s = str_replace(array("\r\n", "\r", "\n"), "\n", $s);

        // Don't allow out-of-control blank lines.
        $s = preg_replace("/\n{3,}/", "\n\n", $s);
        return $s;
    }

    public function evaluar(string $code,  string $initialWorld, string $finalWorld): bool
    {


        $finalWorld = $this->normalize($finalWorld);

        $url = "http://localhost:3000";

        // dd($code,$initialWorld,$finalWorld);

        $base64Code = base64_encode($code);
        $base64InitialWorld =  base64_encode($initialWorld);
        $base64FinalWorld =  base64_encode($finalWorld);


        $requestData = [
            "codigo" => $base64Code,
            "mundoInicial" => $base64InitialWorld,
            "mundoFinal" => $base64FinalWorld
        ];


        // dd($requestData);

        $client = new Client(['headers' => ['Content-Type' => 'application/json']]);
        $response = null;

        try {
            $response = $client->request("POST", $url, ['body' => json_encode($requestData)]);
        } catch (ClientException $e) {
            throw new \Exception($e->getResponse()->getBody()->getContents());
        }

        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 201) {
            $content = $response->getBody()->getContents();
            return $content == $finalWorld;
        } else {
            throw new \Exception("Hubo un error con el evaluador de kareljs");
        }


        return false;
    }
}
