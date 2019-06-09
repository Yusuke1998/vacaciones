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
            'observations' => 'required',
            'date_init' => 'required',
            'worker_id' => 'required',
        ]);

        // Aqui calculo la fecha de finalizacion de las vacaciones tomando en cuenta:
        // El numero de dias tope.
        // Fines de semana y feriados. 
        $fecha_inicio = $request['date_init'];
        $numero_dias = $request['days_taken'];
        $fecha_final = MyHelper::getFechaFinal($fecha_inicio,$numero_dias);

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

        $vacacion = Vacation::find($id);
        $pdf = PDF::loadView('pdf.vacacion', compact('vacacion'));
        return $pdf->stream('vacacion.pdf');
    }
}