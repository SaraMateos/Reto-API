<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baliza;

class BalizasController extends Controller {

    //Coge los datos de las balizas
    public function cogerBalizas() {

        $url = 'https://euskalmet.beta.euskadi.eus/vamet/stations/stationList/stationList.json';
        $data = utf8_encode(file_get_contents($url)); 
        $balizas = json_decode($data, true, 512, JSON_INVALID_UTF8_IGNORE);

        foreach($balizas as $baliza) {

            if ($baliza["stationType"]=="METEOROLOGICAL") {
                
                $datBalizas = [
                    'id' => $baliza["id"],
                    'nombre' => $baliza["name"],
                    'altitud' => $baliza["altitude"],
                    'longitud' => $baliza["x"],
                    'latitud' => $baliza["y"],
                    'temperatura' => rand(-5, 25),
                    'humedad' => rand(0, 100),
                    'viento' => rand(0, 100),
                    'viento Max' => rand(0, 100),
                    'viento Dir' => rand(0, 100),
                    'precipitacion' => rand(0, 100),
                ];

                Baliza::create($datBalizas);

                // $datBalizas = json_decode($baliza, true);
                // var_dump($datBalizas);

            }

        }
    }

    //Coge los datos meteorologicos de la baliza
    public function cogerDatos() {

        $aino = date("Y");
        $mes = date("m");
        $dia = date("d");

        $url = 'https://euskalmet.beta.euskadi.eus/vamet/stations/readings/C071/'.$Y.'/'.$m.'/'.$d.'/readingsData.json';
        $data = file_get_contents($url); 
        $balizas = json_decode($data, true, 512, JSON_INVALID_UTF8_IGNORE);

        foreach($balizas as $baliza) {

            if ($baliza["stationType"]=="METEOROLOGICAL") {
                
                $datBalizas = [
                    'nombre' => $baliza["station"],
                    'viento' => $baliza["mean_speed"],
                    'viento Dir' => $baliza["mean_direction"],
                    'viento Max' => $baliza["max_speed"],
                    'temperatura' => $baliza["temperature"],
                    'humedad' => $baliza["humidity"]
                ];

                Dato::create($datBalizas);

            }

        }
    }
    
}