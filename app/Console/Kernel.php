<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {

        $schedule->call(function() {

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

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
