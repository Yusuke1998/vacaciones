<?php

namespace App\Http\Controllers;

use App\Area;
use App\Worker;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

use App\Http\Requests;

class WorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function create()
    {
        $areas = Area::lists('name','id')->toArray();
        return view('worker.create')->with('areas',$areas);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'ci' => 'required|unique:workers',
            'cellphone' => 'required',
            'photo' => 'required',
            'date_in' => 'required',
            'position' => 'required',
            'email' => 'required|unique:workers',
            'area_id' => 'required',
            'position_code' =>  'required',
            'status_worker' =>  'required',
            'saturday' => 'required'
        ]);

        $worker = new Worker();
        $worker->name = $request['name'];
        $worker->ci = $request['ci'];
        $worker->saturday = $request['saturday'];
        $worker->cellphone = $request['cellphone'];
        $worker->photo = $request['photo'];
        $worker->date_in = date("Y-m-d", strtotime($request['date_in']));
        $worker->date_out = 0;
        $worker->position = $request['position'];
        $worker->position_code = $request['position_code'];
        $worker->email = $request['email'];
        $worker->status_worker = $request['status_worker'];
        $worker->state = '1';
        $worker->area_id = $request['area_id'];
        $worker->save();

        return redirect('/home');
    }

    public function upload(Request $request) {
        if($request->file('file')) {
            //upload an image to the /img/tmp directory and return the filepath.
            $file = $request->file('file');
            $tmpFilePath = '/img/tmp/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = $tmpFilePath . $tmpFileName;
            return response()->json(array('path'=> $path), 200);
        } else {
            return response()->json(false, 200);
        }
    }

    public function show($id){
        try {
            $decrypted_id = \Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect('/home');
        }
        $worker = Worker::find($decrypted_id);
        return view('worker.show')->with('worker',$worker);
    }

    public function edit($id){
        try {
            $decrypted_id = \Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect('/home');
        }
        $worker = Worker::find($decrypted_id);
        $areas = Area::lists('name','id')->toArray();
        return view('worker.edit')->with('worker',$worker)->with('areas',$areas);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'ci' => 'required',
            'cellphone' => 'required',
            'photo' => 'required',
            'date_in' => 'required',
            'position' => 'required',
            'email' => 'required',
            'area_id' => 'required',
            'saturday' => 'required'
        ]);

        $worker = Worker::find($request['id_worker']);
        $worker->name = $request['name'];
        $worker->ci = $request['ci'];
        $worker->saturday = $request['saturday'];
        $worker->cellphone = $request['cellphone'];
        $worker->photo = $request['photo'];
        $worker->date_in = date("Y-m-d", strtotime($request['date_in']));
        $worker->date_out = 0;
        $worker->position = $request['position'];
        $worker->email = $request['email'];
        $worker->area_id = $request['area_id'];
        $worker->save();

        return redirect('/home');
    }

    public function remove (Request $request){
        $this->validate($request, [
            'id_worker' => 'required',
            'fecha_retiro' => 'required',
            'motivo_retiro' => 'required|min:5',
        ]);
        $worker = Worker::find($request['id_worker']);
        $worker->state = '0';
        $worker->date_out = date("Y-m-d", strtotime($request['fecha_retiro']));
        $worker->reason_retirement = $request['motivo_retiro'];
        $worker->save();
        return redirect('/home');
    }

    public function retirados(Request $request){
        $workers = Worker::search($request->search)->where('state',0);

        return view('worker.retirados')->with('workers',$workers->get());
    }

    public function pdf($id)
    {
        try {
            $id = \Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect('/home');
        }

        $trabajador = Worker::find($id);
        $pdf = PDF::loadView('pdf.trabajador', compact('trabajador'));
        return $pdf->stream('trabajador-'.time().'.pdf');
    }

    public function state(){
        return 'hola';
    }
}
