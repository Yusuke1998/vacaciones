<?php

namespace App\Http\Controllers;
use App\Vacation;
use App\Worker;
use App\Http\Requests;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\MyHelper;

class VacationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id_worker)
    {
        try {
            $id = \Crypt::decrypt($id_worker);
        } catch (DecryptException $e) {
            return redirect('/home');
        }

        $trabajador = Worker::where('id',$id)->first();
        return view('vacation.index',compact('trabajador'));
    }

    public function show($id_worker)
    {
        try {
            $id = \Crypt::decrypt($id_worker);
        } catch (DecryptException $e) {
            return redirect('/home');
        }
        return $id;
    }

    public function create($id_worker,$name_worker)
    {
        try {
            $decrypted_id = \Crypt::decrypt($id_worker);
            $decrypted_name = \Crypt::decrypt($name_worker);
        } catch (DecryptException $e) {
            return redirect('/home');
        }
        return view('vacation.create')->with('id_worker',$decrypted_id)->with('name_worker',$decrypted_name);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'days_taken' => 'required|numeric',
            'reason' => 'required',
            'observations' => 'required|min:5',
            'date_init' => 'required',
            'worker_id' => 'required',
        ]);
        $id = $request['worker_id'];
        $worker = Worker::find($id);
        $vacationDaysOld=$worker->days_taken_rest;
        $vacationDaysNew=$request['days_taken'];

        // Validar que no se registren mas vacaciones de las permitidas
        if ($worker->days_taken_rest === null) {
            $vacationDays=MyHelper::vacationDays($worker->date_in);
            $worker->days_taken_rest = $vacationDays;
            $worker->save();
        }

        $worker = Worker::find($id);
        $vacationDaysOld=$worker->days_taken_rest;
        $vacationDaysNew=$request['days_taken'];
        $total = ($vacationDaysOld-$vacationDaysNew);

        if ($total >= 0){
            $worker->days_taken_rest = $total;
            $worker->save();
        }else{
            return back()->with('info','Error, no puedes registrar vacaciones si ya consumiste los dias ganados o si superan la cantidad que te queda!');
        }

        // Validar que no se registren mas vacaciones de las permitidas

        // Aqui calculo la fecha de finalizacion de las vacaciones tomando en cuenta:
        // El numero de dias tope.
        // Fines de semana y feriados. 
        $fecha_inicio = $request['date_init'];
        $numero_dias = $request['days_taken'];

        if ($worker->saturday == '1') {
            $fecha_final = MyHelper::getSabadosFechaFinal($fecha_inicio,$numero_dias);
        }else{
            $fecha_final = MyHelper::getFechaFinal($fecha_inicio,$numero_dias);
        }


        $vacation = new Vacation();
        $vacation->type = $request['type'];
        $vacation->days_taken = $request['days_taken'];
        $vacation->reason = $request['reason'];
        $vacation->observations = $request['observations'];
        $vacation->date_init = date("Y-m-d", strtotime($request['date_init']));
        $vacation->date_end = $fecha_final;
        $vacation->worker_id = $request['worker_id'];
        $vacation->save();
        return redirect('/home');
    }

    public function pdf($id)
    {
        try {
            $id = \Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect('/home');
        }
        // Buscar vacacion por id
        $vacacion = Vacation::find($id);
        // Fecha actual
        $date_current = new \DateTime();
        // Fecha de ingreso del trabajador
        $date_init =  new \DateTime($vacacion->worker->date_in);
        // Diferencia entre la fecha actual y la fecha de ingreso del trabajador
        $difference = $date_current->diff($date_init);
        // Años de diferencia
        $año_trabajo = $difference->format('%y');

        $pdf = PDF::loadView('pdf.vacacion', compact('vacacion','año_trabajo'));
        return $pdf->stream('vacacion-'.time().'.pdf');
    }
}