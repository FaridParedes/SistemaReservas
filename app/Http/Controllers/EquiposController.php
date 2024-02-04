<?php

namespace App\Http\Controllers;

use session;
use App\Models\Equipos;
use App\Models\ProgramasEquipoModel;
use App\Models\SistemasOperativos;
use Database\Seeders\SistemasOperativosSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consulta_equipos = Equipos::select(
            'equipos.idEquipos',
            'equipos.nombre',
            'equipos.fotografia',
            'sistemas_operativos.nombre as sistema_operativo',
            'sistemas_operativos.idSistemasOperativos',
            'equipos.espacio_disponible',
            'equipos.ram',
            'equipos.procesador',
            'estado_equipos.estado',
            'equipos.created_at'
        )->join(
            'estado_equipos',
            'estado_equipos.idEstadoEquipos',
            '=',
            'equipos.idEstadoEquipos'
        )->join(
            'sistemas_operativos',
            'sistemas_operativos.idSistemasOperativos',
            '=',
            'equipos.idSistemasOperativos'
        )->get();

        $sistemasOperativos_list = SistemasOperativos::select('idSistemasOperativos','nombre')->get();

        return view('/Equipos/show', compact('consulta_equipos', 'sistemasOperativos_list'));
    }

    public function programas_get($idEquipos) {
        
        $programas_get = ProgramasEquipoModel::select(
            'idProgramas_equipos',
            'nombre_programa'
        )->where('idEquipos', $idEquipos)->get();

        echo json_encode($programas_get);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $sistemasOperativos_list = SistemasOperativos::select('idSistemasOperativos','nombre')->get();
    
        return view('/Equipos/create')->with(['sistemas_operativos' => $sistemasOperativos_list]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $campos = request()->validate([
            'nombreEquipo' => 'required',
            'imgEquipo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sistemaOperativo' => 'required',
            'espacioDisponible' => 'required',
            'ram' => 'required',
            'procesador' => 'required'
        ], [
            'nombreEquipo.required' => "Se require el nombre del equipo",
            'imgEquipo.required' => "Se requiere seleccionar una imagen",
            'sistemaOperativo.required' => "Se requiere seleccionar el sistema operativo",
            'esapcioDisponible.required' => "Se requiere ingresar el espacio disponible",
            'ram.required' => "Se requiere ingresar la ram",
            'procesador.required' => "Se require ingresar el procesador"
        ]);

        if ($campos['sistemaOperativo'] == "nuevo") {
            
            $campos2 = request()->validate([
                'nuevoSistema' => 'required'
            ], [
                'nuevoSistema.required' => "Se require ingresar el nombre del nuevo sistema operativo"
            ]);
            
        }

        $imagen = $request->file('imgEquipo');

        // Generar un nombre único para la imagen
        $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

        // Guardar la imagen en el almacenamiento de Laravel (en la carpeta 'public/images')
        $imagen->storeAs('equipos', $nombreImagen, 'public');

        if ($campos['sistemaOperativo'] != "nuevo") {
            
            $datos_equipos = [
                'nombre' => $campos['nombreEquipo'],
                'fotografia' => $nombreImagen,
                'idSistemasOperativos' => $campos['sistemaOperativo'],
                'espacio_disponible' => $campos['espacioDisponible'],
                'ram' => $campos['ram'],
                'procesador' => $campos['procesador'],
                'idEstadoEquipos' => 1
            ];
    
            $equipo_creado = Equipos::create($datos_equipos);
            
        } else {

            $nuevo_sistemaOperativo = [
                'nombre' => $campos2['nuevoSistema']
            ];

            $sistema_operativoNuevo = SistemasOperativos::create($nuevo_sistemaOperativo);

            $datos_equipos = [
                'nombre' => $campos['nombreEquipo'],
                'fotografia' => $nombreImagen,
                'idSistemasOperativos' => $sistema_operativoNuevo['idSistemasOperativos'],
                'espacio_disponible' => $campos['espacioDisponible'],
                'ram' => $campos['ram'],
                'procesador' => $campos['procesador'],
                'idEstadoEquipos' => 1
            ];
    
            $equipo_creado = Equipos::create($datos_equipos);

        }


        $programas = $request->input('programas');

        if (!empty($programas)) {
            
            if (count($programas) > 0) {
                
                foreach ($programas as $valor) {
            
                    $datos_programas = [
                        'nombre_programa' => $valor,
                        'idEquipos' => $equipo_creado['idEquipos']
                    ];

                    ProgramasEquipoModel::create($datos_programas);
            
                }
                
            }

        }

        session()->flash('mensaje', "Se ha ingresado el equipo con exito");

        return redirect()->route('ingresarEquipos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipos $equipos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipos $equipos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idEquipos)
    {

        $equipo = Equipos::find($idEquipos);

        $imagen = $request->file('imgEquipo');

        if ($imagen == false) {

            $campos = request()->validate([
                'nombreEquipo' => 'required',
                'sistemaOperativo' => 'required',
                'espacioDisponible' => 'required',
                'ram' => 'required',
                'procesador' => 'required'
            ]);

            $datos_equipos = [
                'nombre' => $campos['nombreEquipo'],
                'idSistemasOperativos' => $campos['sistemaOperativo'],
                'espacio_disponible' => $campos['espacioDisponible'],
                'ram' => $campos['ram'],
                'procesador' => $campos['procesador']
            ];

            $equipo->nombre = $datos_equipos['nombre'];
            $equipo->idSistemasOperativos = $datos_equipos['idSistemasOperativos'];
            $equipo->espacio_disponible = $datos_equipos['espacio_disponible'];
            $equipo->ram = $datos_equipos['ram'];
            $equipo->procesador = $datos_equipos['procesador'];
            $equipo->save();

            $programas_nuevos = $request->input('nuevosProgramas');

            if (!empty($programas_nuevos)) {
               
                if (count($programas_nuevos) > 0) {
                    
                    foreach($programas_nuevos as $valor) {

                        $datos_programas = [
                            "nombre_programa" => $valor,
                            "idEquipos" => $idEquipos
                        ];

                        ProgramasEquipoModel::create($datos_programas);

                    }
                    
                }
                
            }

            $programas_eliminar = $request->input('programasEliminar');


            if (!empty($programas_eliminar)) {
                
                if (count($programas_eliminar) > 0) {
                    
                    foreach($programas_eliminar as $valor) {

                        ProgramasEquipoModel::where('idProgramas_equipos', $valor)->delete();

                    }
                    
                }
                
            }

            session()->flash('mensaje', "Se ha modificado el equipo con exito");

            return redirect('/equipos/show');
        } else {

            $campos = request()->validate([
                'nombreEquipo' => 'required',
                'imgEquipo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'sistemaOperativo' => 'required',
                'espacioDisponible' => 'required',
                'ram' => 'required',
                'procesador' => 'required'
            ]);

            $nombreArchivo = $request->input('fotografia');

            // Comprobar si el archivo existe antes de intentar eliminarlo
            $rutaArchivo = 'equipos/' . $nombreArchivo;

            // Eliminara el archivo especificando en que carpeta esta usando disk('public')
            Storage::disk('public')->delete($rutaArchivo);


            $imagen = $request->file('imgEquipo');

            // Generar un nombre único para la imagen
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

            // Guardar la imagen en el almacenamiento de Laravel (en la carpeta 'public/images')
            $imagen->storeAs('equipos', $nombreImagen, 'public');




            $datos_equipos = [
                'nombre' => $campos['nombreEquipo'],
                'idSistemasOperativos' => $campos['sistemaOperativo'],
                'espacio_disponible' => $campos['espacioDisponible'],
                'ram' => $campos['ram'],
                'procesador' => $campos['procesador']
            ];

            $equipo->nombre = $datos_equipos['nombre'];
            $equipo->fotografia = $nombreImagen;
            $equipo->idSistemasOperativos = $datos_equipos['idSistemasOperativos'];
            $equipo->espacio_disponible = $datos_equipos['espacio_disponible'];
            $equipo->ram = $datos_equipos['ram'];
            $equipo->procesador = $datos_equipos['procesador'];
            $equipo->save();

            $programas_nuevos = $request->input('nuevosProgramas');

            if (!empty($programas_nuevos)) {
               
                if (count($programas_nuevos) > 0) {
                    
                    foreach($programas_nuevos as $valor) {

                        $datos_programas = [
                            "nombre_programa" => $valor,
                            "idEquipos" => $idEquipos
                        ];

                        ProgramasEquipoModel::create($datos_programas);

                    }
                    
                }
                
            }

            $programas_eliminar = $request->input('programasEliminar');


            if (!empty($programas_eliminar)) {
                
                if (count($programas_eliminar) > 0) {
                    
                    foreach($programas_eliminar as $valor) {

                        ProgramasEquipoModel::where('idProgramas_equipos', $valor)->delete();

                    }
                    
                }
                
            }

            session()->flash('mensaje', "Se ha modificado el equipo con exito");

            return redirect('/equipos/show');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipos $equipos)
    {
        //
    }
}
