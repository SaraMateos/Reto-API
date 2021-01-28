<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baliza;

class datosBalizas extends Controller {
    
    public function cogerBalizas() {

        $aino = date("Y");
        $mes = date("m");
        $dia = date("d");

        $url = 'https://euskalmet.beta.euskadi.eus/vamet/stations/stationList/stationList.json';
        $data = file_get_contents($url); 
        $balizas = json_decode($data, true, 512, JSON_INVALID_UTF8_IGNORE);

        foreach($balizas as $baliza) {

            if ($baliza["stationType"]=="METEOROLOGICAL") {
                
                $datBalizas = [
                    'id' => $baliza["id"],
                    'nombre' => $baliza["name"],
                    'municipio' => $baliza["municipality"],
                    'provincia' => $baliza["province"],
                    'altitud' => $baliza["altitude"],
                    'longitud' => $baliza["x"],
                    'latitud' => $baliza["y"],
                    'tipo' => $baliza["stationType"]
                ];

                Baliza::create($datBalizas);

                // $datBalizas = json_decode($baliza, true);
                // var_dump($datBalizas);

            }

        }
    }

    public function cogerDatos() {

        $aino = date("Y");
        $mes = date("m");
        $dia = date("d");

        $url = 'https://euskalmet.beta.euskadi.eus/vamet/stations/stationList/stationList.json';
        $data = file_get_contents($url); 
        $balizas = json_decode($data, true, 512, JSON_INVALID_UTF8_IGNORE);

        foreach($balizas as $baliza) {

            if ($baliza["stationType"]=="METEOROLOGICAL") {
                
                $datBalizas = [
                    'id' => $baliza["id"],
                    'nombre' => $baliza["name"],
                    'municipio' => $baliza["municipality"],
                    'provincia' => $baliza["province"],
                    'altitud' => $baliza["altitude"],
                    'longitud' => $baliza["x"],
                    'latitud' => $baliza["y"],
                    'tipo' => $baliza["stationType"]
                ];

                Baliza::create($datBalizas);

                // $datBalizas = json_decode($baliza, true);
                // var_dump($datBalizas);

            }

        }
    }
    
}