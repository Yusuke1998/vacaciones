<?php

use Illuminate\Database\Seeder;
use App\Date;

class DateSeeder extends Seeder
{
    public function run()
    {
    	$añoActual = date('Y'); 
        $feriados = [
            [$añoActual.'-1-06','Dia de los reyes magos'],
            [$añoActual.'-01-01','Año nuevo'],
            [$añoActual.'-12-31','Fin de Año'],
            [$añoActual.'-12-25','Navidad'],
            [$añoActual.'-12-24','Víspera de Navidad'],
            [$añoActual.'-06-24','Batalla de Carabobo'],
            [$añoActual.'-04-19','Declaracion de independencia'],
            [$añoActual.'-07-05','Dia de independencia'],
            [$añoActual.'-05-01','Dia del trabajador'],
            [$añoActual.'-07-24','Natalicio de Simón Bolívar'],
            [$añoActual.'-10-12','Dia de la Resistencia Indígenaa'],
        ];

        foreach ($feriados as $value) {
        	Date::create([
        		'date'			=>	$value[0],
        		'description'	=>	$value[1],
        	]);
        }
    }
}
