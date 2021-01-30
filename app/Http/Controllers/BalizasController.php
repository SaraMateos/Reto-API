<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baliza;

class BalizasController extends Controller {

    //Coge las balizas y las guarda en l abase de datos
    public function balizas() {

        $url = 'https://euskalmet.beta.euskadi.eus/vamet/stations/stationList/stationList.json';
        $data = utf8_encode(file_get_contents($url)); 
        $balizas = json_decode($data, true, 512, JSON_INVALID_UTF8_IGNORE);

        foreach($balizas as $baliza) {

            if ($baliza["stationType"]=="METEOROLOGICAL") {
                
                $datBaliza = new Baliza();
                $datBaliza->id = $baliza["id"];
                $datBaliza->nombre = $baliza["name"];
                $datBaliza->latitud = $baliza["y"];
                $datBaliza->longitud = $baliza["x"];
                $datBaliza->altitud = $baliza["altitude"];
                
                $datBaliza->save();   

                $id=$baliza["id"];             
                $this->datos($id);

            }

        }
    }

    //Coge los datos meteorologicos de las balizas y las guarda
    public function datos($idBaliza) {

        $aino = date("Y");
        $mes = date("m");
        $dia = date("d");

        $url = 'https://euskalmet.beta.euskadi.eus/vamet/stations/readings/'.$idBaliza.'/'.$aino.'/'.$mes.'/'.$dia.'/readingsData.json';
        $data = utf8_encode(file_get_contents($url)); 
        $balizas = json_decode($data, true, 512, JSON_INVALID_UTF8_IGNORE);

        try {

            //Declarar variable donde se van a guardar los datos
            $datosBaliza=Baliza::where('id', $idBaliza); 

            foreach($data as $dato) {
                foreach($dato as $dato2 ) {

                }
            }
            
            $datoBaliza->update();

        } catch (\ErrorException $e) {
            error_log("Error. Pasa al siguiente.");
        }
    }
    
}