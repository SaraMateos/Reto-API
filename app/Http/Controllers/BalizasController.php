<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baliza;
use App\Models\Dato;

class BalizasController extends Controller {

    //Coge las balizas y las guarda en l abase de datos
    public function balizas() {

        Baliza::truncate();
        $url = 'https://euskalmet.beta.euskadi.eus/vamet/stations/stationList/stationList.json';
        $data = utf8_encode(file_get_contents($url)); 
        $balizas = json_decode($data, true, 512, JSON_INVALID_UTF8_IGNORE);

        foreach($balizas as $baliza) {

            if ($baliza["stationType"]=="METEOROLOGICAL") {
                
                $desBaliza = new Baliza();
                $desBaliza->id = $baliza["id"];
                $desBaliza->nombre = $baliza["name"];
                $desBaliza->latitud = $baliza["y"];
                $desBaliza->longitud = $baliza["x"];
                $desBaliza->altitud = $baliza["altitude"];
                $desBaliza->temperatura = rand(-5, 25);
                $desBaliza->humedad = rand(0, 100);
                $desBaliza->viento = rand(0, 100);
                $desBaliza->vientoMax = rand(0, 100);
                $desBaliza->vientoDir = rand(0, 360);
                $desBaliza->precipitacion = rand(0, 100);
                
                $desBaliza->save();

                // $idBaliza=$baliza["id"];             
                // $this->datos($idBaliza); 

            }

        }
    }

    //Coge los datos meteorologicos de las balizas y las guarda
    public function datos($idBaliza) {
    
        try {

            $aino = date("Y");
            $mes = date("m");
            $dia = date("d");

            $url = 'https://euskalmet.beta.euskadi.eus/vamet/stations/readings/'.$idBaliza.'/'.$aino.'/'.$mes.'/'.$dia.'/readingsData.json';
            $data = utf8_encode(file_get_contents($url)); 
            $balizas = json_decode($data, true, 512, JSON_INVALID_UTF8_IGNORE);

            //Declarar variable donde se van a guardar los datos
            $datBaliza=Baliza::where('id', $idBaliza); 

            foreach($balizas as $dato) {

                // $datBaliza->id = $dato["station"];
                // $datBaliza->temperatura = rand(-3, 25);
                // $datBaliza->humedad = rand(0, 100);
                // $datBaliza->viento = rand(0, 100);
                // $datBaliza->vientoMax = rand(0, 360);
                // $datBaliza->vientoDir = rand(0, 360);
                // $datBaliza->precipitacion = rand(0, 100);
                
                // $datBaliza->id = $dato["station"];
                // $datBaliza->temperatura = $dato["temperature"];
                // $datBaliza->humedad = $dato["humidity"];
                // $datBaliza->viento = $dato["mean_speed"];
                // $datBaliza->vientoMax = $dato["max_speed"];
                // $datBaliza->vientoDir = $dato["mean_direction"];
                // $datBaliza->precipitacion = $dato["precipitation"];
                
                // Baliza::create();
                //$datBaliza->update();

            }
            
        } catch (\ErrorException $e) {
            error_log("Error. Pasa al siguiente.");
        }
    }
    
}