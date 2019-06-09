<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $areas = Area::all();
        return view('area.index')->with('areas',$areas);
    }

    public function create()
    {
        return view('area.create');
    }

    public function edit($id)
    {
        $area = Area::find($id);
        return view('area.edit',compact('area'));
    }

    public function update(Request $request, $id)
    {
        $area = Area::find($id);
        $area->update($request->all());
        return redirect(url('/area'));
    }

    public function destroy($id)
    {
        $area = Area::find($id);
        $area->delete();
        return redirect(url('/area'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:areas',
            'description' => 'required|min:5',
        ]);

        $name = $request['name'];
        $description = $request['description'];

        $area = new Area();
        $area->name = $name;
        $area->description = $description;

        $area->save();

        return redirect('/area');
    }
}
