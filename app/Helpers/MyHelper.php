<?php

/**
 * Desarrollado por Jhonny Pérez, con ayuda de google claro :v
 * 08-06-19
 * 09-06-19
**/

namespace App\Helpers;
use App\Vacation;

class MyHelper{

    public static function vacationDays($date){
        // Fecha actual
        $date_current = new \DateTime();
        // Fecha de ingreso del trabajador
        $date_init =  new \DateTime($date);
        // Diferencia entre la fecha actual y la fecha de ingreso del trabajador
        $difference = $date_current->diff($date_init);
        // Años de diferencia
        $year_difference = $difference->format('%y');
        // Dias de vacaciones, inicializado en 0
        $vacation_days = 0;
        // Si los años de diferencia son mayor a uno
        if($year_difference >= 1 && $year_difference <= 16){ 
        #Si la diferencia es mayor a un año, a esa diferencia se le suman los 15 dias establecidos por la ley venezolana
            $vacation_days = 15+$year_difference;
        }elseif($year_difference >= 16) {
            $vacation_days = 30;
        }

        return $vacation_days;
    }

    public static function vacationTaken($id){
        $days_taken = Vacation::where('worker_id',$id)->sum('days_taken');
        return $days_taken;
    }

    public static function stateWorker($state){
        return ($state == 1)? 'ACTIVO' : 'RETIRADO';
    }

    public static function formatearFecha($fecha) {
        if (strpos($fecha,'/') ) {
            $fechaArray = explode('/', $fecha);
            $dia  = $fechaArray[0];
            $mes  = $fechaArray[1];
            $year = $fechaArray[2];
            $fecha = $year . '-' . $mes . '-' . $dia;
        }
        return $fecha;
    }

    public static function getDiasHabiles($fechainicio, $fechafin, $diasferiados = array()) {
        // Convirtiendo en timestamp las fechas
        $fechainicio = strtotime($fechainicio);
        $fechafin = strtotime($fechafin);
        // Incremento en 1 dia
        $diainc = 24*60*60;
        // Arreglo de dias habiles, inicianlizacion
        $diashabiles = array();
        // Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
        for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
            // Si el dia indicado, no es sabado o domingo es habil
            if (!in_array(date('N', $midia), array(6,7))) { // DOC: http://www.php.net/manual/es/function.date.php
                // Si no es un dia feriado entonces es habil
                if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
                        array_push($diashabiles, date('Y-m-d', $midia));
                }
            }
        }
        return $diashabiles;
    }

    //Esta pequeña funcion me crea una fecha final sin sabados, domingos o feriados  
    public static function getFechaFinal($fechaInicial,$dias,$feriados = array()){
        //Timestamp De Fecha De Comienzo
        $comienzo = strtotime($fechaInicial);
        //Inicializo la Fecha Final
        $final = $comienzo;
        // Inicializo el contador
        $i = 0;

        while($i < $dias)
        {  
            //Le sumo un dia a la fecha final (86400 Segundos) 
            $final += 86400; 
            //Inicializo a FALSE la variable para saber si es feriado 
            $es_feriado = FALSE; 
            //Recorro todos los feriados 
            foreach ($feriados as $key => $feriado)
            { 
            //Verifico si la fecha Final actual es feriado o no 
                if (date("Y-m-d", $final) === date("Y-m-d", strtotime($feriado))) 
                { 
                //En caso de ser feriado cambio mi variable a TRUE 
                    $es_feriado = TRUE;
                } 
            }
            //Verifico que no sea un sabado, domingo o feriado 
            if (!(date("w", $final) == 6 || date("w", $final) == 0 || $es_feriado))
            { 
            //En caso de no ser sabado, domingo o feriado aumentamos nuestro contador 
                $i++; 
            }
        }   
        return date('Y-m-d', $final);  
    }
} 