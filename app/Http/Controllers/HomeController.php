<?php

namespace App\Http\Controllers;

use App\Models\Laboratorios;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $laboratorios = Laboratorios::all();
        if($laboratorios->isEmpty()){
            $datos = "Vacio";
        }else{
            $datos = $laboratorios;
        }
        return view('home')->with(['laboratorios' => $datos]);
    }
}
