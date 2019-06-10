<?php

namespace App\Http\Controllers;

use App\Worker;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $workers = Worker::search($request->search)->where('state',1)->paginate(4);
        return view('home')->with('workers',$workers);
    }

    public function welcome(){
        if (\Auth::check()) {
            return redirect('/home');
        }
        return redirect('/');
    }
}
