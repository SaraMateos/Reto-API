<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class datosBalizas extends Controller {
    
    public function cogerDatos() {

        $aino = date("Y");
        $mes = date("m");
        $dia = date("d");

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://euskalmet.beta.euskadi.eus/vamet/stations/stationList/stationList.json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = utf8_encode(curl_exec($curl));
        if (curl_errno($curl)) { 
            print curl_error($curl); 
        } 
        curl_close($curl);

        $balizas = json_decode($response, true);

        foreach($balizas as $baliza) {

            if ($baliza["stationType"]=="METEOROLOGICAL") {
                
                $nomBaliza = $baliza["id"];

                $curl2 = curl_init();

                curl_setopt($curl2, CURLOPT_URL, "https://euskalmet.beta.euskadi.eus/vamet/stations/readings/" . $nomBaliza . "/" . $aino . "/" . $mes . "/" . $dia . "/readingsData.json");
                curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);

                $response = utf8_encode(curl_exec($curl2));

                if (curl_errno($curl2)) { 
                    print curl_error($curl2); 
                } 

                curl_close($curl2);

                $datosBalizas = json_decode($response, true);
                var_dump($datosBalizas);
            }
        }
    }
}