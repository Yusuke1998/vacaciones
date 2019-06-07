<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        return "Hola Mundo!";
    }

    public function create()
    {
        return "Hola Mundo!";
    }

    public function store(Request $request)
    {
        return "Hola Mundo!";
    }
}
