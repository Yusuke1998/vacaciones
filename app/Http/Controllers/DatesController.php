<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Date;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class DatesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$fechas = Date::all();
    	return view('fecha.index',compact('fechas'));
    }

    public function create()
    {
        return view('fecha.create');
    }

    public function edit($id)
    {
        $fecha = Date::find($id);
        return view('fecha.edit',compact('fecha'));
    }

    public function update(Request $request, $id)
    {
        $fecha = Date::find($id);
        $fecha->update($request->all());
        return redirect(url('/fecha'));
    }

    public function destroy($id)
    {
        $fecha = Date::find($id);
        $fecha->delete();
        return redirect(url('/fecha'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'description' => 'required',
        ]);

        $date = $request['date'];
        $description = $request['description'];

        $fecha = new Date();
        $fecha->date = $date;
        $fecha->description = $description;
        $fecha->save();

        return redirect('/fecha');
    }
}
