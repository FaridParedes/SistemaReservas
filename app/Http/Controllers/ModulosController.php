<?php

namespace App\Http\Controllers;

use App\Models\Modulos;
use App\Models\Reservas;
use App\Models\DiasReserva;
use Illuminate\Http\Request;
use App\Models\EquipoReserva;
use App\Models\MaterialReserva;
use App\Models\DuracionReservas;
use App\Models\ComentarioReserva;
use App\Models\EntregaLaboratorio;
use App\Models\HerramientaReserva;
use Illuminate\Support\Facades\Session;

class ModulosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modulos = Modulos::all();
        $alertSuccess = Session::get('alertSuccess', 0);
        $alertError = Session::get('alertError', 0);
        $mensaje = Session::get('mensaje', '');

        if($modulos->isEmpty()){
            $datos = "Vacio";
        }else{
            $datos = $modulos;
        }
        return view('Modulos/Show', compact('alertSuccess', 'alertError', 'mensaje'))->with(['modulos' => $datos]);
    }

    public function crear(){
        return view('/Modulos/Crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'titulo_del_modulo' => 'required|max:100'
        ]);

        Modulos::create([
            'nombreModulo' => $validacion['titulo_del_modulo']
        ]);

        return redirect('/modulos/show')->with(['alertSuccess' => true, 'alertError' => 0, 'mensaje' => '¡Módulo creado con éxito!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Modulos $modulos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modulos $modulo)
    {
        return view('Modulos/Update')->with(['modulo'=>$modulo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modulos $modulo)
    {
        $validacion = $request->validate([
            'titulo_del_modulo' => 'required|max:100'
        ]);

        if($validacion['titulo_del_modulo'] === $modulo['nombreModulo'])
        {
            return redirect('/modulos/show')->with(['alertSuccess' => 0, 'alertError' => true, 'mensaje' => 'El título es el mismo.']);
        } else{
            $modulo['nombreModulo'] = $validacion['titulo_del_modulo'];
            $modulo->save();
            return redirect('/modulos/show')->with(['alertSuccess' => true, 'alertError' => 0, 'mensaje' => '¡Módulo modificado con éxito!']);
 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $reservas = Reservas::where('idModulos', $id)->get();
            if(!$reservas->isEmpty()){
                foreach ($reservas as $reserva) {
                    ComentarioReserva::where('idReserva', $reserva->idReservas)->delete();
                    DiasReserva::where('idReserva', $reserva->idReservas)->delete();
                    DuracionReservas::where('idReserva', $reserva->idReservas)->delete();
                    EquipoReserva::where('idReserva', $reserva->idReservas)->delete();
                    HerramientaReserva::where('idReserva', $reserva->idReservas)->delete();
                    MaterialReserva::where('idReserva', $reserva->idReservas)->delete();
                    EntregaLaboratorio::where('idReserva', $reserva->idReservas)->delete();
                }
                Reservas::where('idModulos', $id)->delete();
            }
            Modulos::destroy($id);
    
            return response()->json(array('response' => true));
        } catch (\Throwable $th) {
            $errorMessage = 'Error al eliminar el usuario: ' . $th->getMessage();
            return response()->json(array('error' => $errorMessage));
        }
    }
}
