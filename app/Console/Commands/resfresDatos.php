<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\BalizasController;

class refresDatos extends Command {
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actualizaDatos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza los datos de las balizas.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $statControl = new BalizaController;
        // $statControl->balzias();
        // Baliza::truncate();
        // $url = 'https://euskalmet.beta.euskadi.eus/vamet/stations/stationList/stationList.json';
        // $data = utf8_encode(file_get_contents($url)); 
        // $balizas = json_decode($data, true, 512, JSON_INVALID_UTF8_IGNORE);

        // foreach($balizas as $baliza) {

        //     if ($baliza["stationType"]=="METEOROLOGICAL") {
                
        //         $desBaliza = new Baliza();
        //         $desBaliza->id = $baliza["id"];
        //         $desBaliza->nombre = $baliza["name"];
        //         $desBaliza->latitud = $baliza["y"];
        //         $desBaliza->longitud = $baliza["x"];
        //         $desBaliza->altitud = $baliza["altitude"];
        //         $desBaliza->temperatura = rand(-5, 25);
        //         $desBaliza->humedad = rand(0, 100);
        //         $desBaliza->viento = rand(0, 100);
        //         $desBaliza->vientoMax = rand(0, 100);
        //         $desBaliza->vientoDir = rand(0, 360);
        //         $desBaliza->precipitacion = rand(0, 100);
                
        //         $desBaliza->save();

        //         // $idBaliza=$baliza["id"];             
        //         // $this->datos($idBaliza); 

        //     }

        // }
        Log::info('Mi Comando Funciona!');
    }
}
