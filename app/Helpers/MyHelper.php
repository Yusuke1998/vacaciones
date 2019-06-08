<?php
/**
 * Created by PhpStorm.
 * User: marcelo
 * Date: 25-03-16
 * Time: 07:42 PM
 */
/**
 * Editado por Jhonny Pérez
 * 08-06-19
**/

namespace App\Helpers;
use App\Vacation;

class MyHelper {


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

        // if($year_difference <= 5){
        //     $vacation_days = $year_difference*15;
        // }elseif($year_difference > 5 && $year_difference <= 10){
        //     $vacation_days = 75+($year_difference-5)*20;
        // }elseif($year_difference > 10){
        //     $vacation_days = 75+100+($year_difference-10)*30;
        // }

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
} 