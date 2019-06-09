<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $usuarios = User::all();
        return view('usuario.index',compact('usuarios'));
    }

    public function create()
    {
        return view('usuario.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'username'  => 'required|unique:users',
            'rol'       => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required'
        ]);

        $usuario = new User();
        $usuario->name      = $request['name'];
        $usuario->username  = $request['username'];
        $usuario->rol       = $request['rol'];
        $usuario->email     = $request['email'];
        $usuario->password  = bcrypt($request['password']);
        $usuario->save();

        if (isset($usuario)&&!is_null($usuario)) {
            return redirect(route('usuario.listar'));
        }else{
            return back();
        }

    }

    public function edit($id)
    {
        $usuario = User::where('id','=',$id)->first();
        return view('usuario.edit',compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'username'  => 'required|unique:users',
            'rol'       => 'required',
            'email'     => 'required|unique:users',
        ]);

        $usuario = User::find($id);
        $usuario->name      = $request['name'];
        $usuario->username  = $request['username'];
        $usuario->rol       = $request['rol'];
        $usuario->email     = $request['email'];
        if (!empty($request->password)) {
            $usuario->password  = bcrypt($request->password);
        }
        $usuario->save();

        return redirect(route('usuario.listar'));
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        return redirect(route('usuario.listar'));
    }
}
