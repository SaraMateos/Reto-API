<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class datosBalizas extends Controller {
    
    public function coger() {

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://euskalmet.beta.euskadi.eus/vamet/stations/stationList/stationList.json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = utf8_encode(curl_exec($curl));
        $err = curl_error($curl);
        curl_close($curl);

        $balizas = json_decode($response, true);
            foreach($balizas as $marker) {
                var_dump($marker["name"]);
            }
    }
}