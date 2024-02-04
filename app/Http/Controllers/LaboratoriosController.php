<?php

namespace App\Http\Controllers;

use App\Models\Equipos;
use App\Models\Gabinetes;
use App\Models\Herramientas;
use App\Models\Laboratorios;
use App\Models\LaboratoriosEquipos;
use App\Models\LaboratoriosHerramientas;
use Illuminate\Http\Request;
use App\Models\MaterialGastable;
use Illuminate\Support\Facades\Storage;

class LaboratoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consulta_laboratorios = Laboratorios::select(
            'laboratorios.idLaboratorios',
            'laboratorios.fotografia',
            'laboratorios.nombreLaboratorio',
            'laboratorios.descripcion',
            'estado_laboratorios.estado',
            'laboratorios.created_at'
        )->join(
            'estado_laboratorios',
            'estado_laboratorios.idEstadoLaboratorios',
            '=',
            'laboratorios.idEstadoLaboratorios'
        )->get();

        $equipos = LaboratoriosEquipos::select(
            'equipos.idEquipos',
            'equipos.fotografia',
            'equipos.nombre',
            'equipos.espacio_disponible',
            'sistemas_operativos.nombre as sistema_operativo'
        )->rightjoin(
            'equipos',
            'equipos.idEquipos', '=',
            'laboratorios_equipos.idEquipos'
        )->join(
            'sistemas_operativos',
            'sistemas_operativos.idSistemasOperativos', '=',
            'equipos.idSistemasOperativos'
        )->whereNull('laboratorios_equipos.idEquipos')->get();

        $materialGastable = Gabinetes::select(
            'material_gastable.idMaterialGastable',
            'material_gastable.fotografia',
            'material_gastable.nombre',
            'material_gastable.descripcion',
            'material_gastable.stock'
        )->rightjoin(
            'material_gastable',
            'material_gastable.idMaterialGastable',
            '=', 'gabinetes.idMaterialGastable'
        )->join(
            'estado_materialGastable',
            'estado_materialGastable.idEstadoMaterialGastable',
            'material_gastable.idEstadoMaterialGastable'
        )->whereNull('gabinetes.idMaterialGastable')->get();

        $herramientas = LaboratoriosHerramientas::select(
            'herramientas.idHerramientas',
            'herramientas.nombre',
            'herramientas.fotografia',
            'herramientas.descripcion',
            'herramientas.marca',
        )->rightjoin(
            'herramientas',
            'laboratorios_herramientas.idHerramientas', '=',
            'herramientas.idHerramientas'
        )->join(
            'estado_herramientas',
            'estado_herramientas.idEstadoHerramientas',
            '=',
            'herramientas.idEstadoHerramientas'
        )->where('laboratorios_herramientas.idHerramientas')->get();



        return view('/Laboratorios/show', compact('consulta_laboratorios', 'equipos', 'herramientas', 'materialGastable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $equipos = Equipos::select(
            'equipos.idEquipos',
            'equipos.nombre',
            'equipos.fotografia',
            'sistemas_operativos.nombre as sistema_operativo',
            'equipos.espacio_disponible',
            'equipos.ram',
            'equipos.procesador',
        )->join('estado_equipos', 'estado_equipos.idEstadoEquipos', '=', 'equipos.idEstadoEquipos')
        ->join('sistemas_operativos', 'sistemas_operativos.idSistemasOperativos', '=', 'equipos.idSistemasOperativos')->get();

        $materialGastable = MaterialGastable::select(
            'material_gastable.idMaterialGastable',
            'material_gastable.fotografia',
            'material_gastable.nombre',
            'material_gastable.descripcion',
            'material_gastable.stock'
        )->join('estado_materialGastable', 'estado_materialGastable.idEstadoMaterialGastable', '=', 'material_gastable.idEstadoMaterialGastable')
            ->get();

        $herramientas = Herramientas::select(
            'herramientas.idHerramientas',
            'herramientas.nombre',
            'herramientas.fotografia',
            'herramientas.descripcion',
            'herramientas.marca',
        )->join(
            'estado_herramientas',
            'estado_herramientas.idEstadoHerramientas',
            '=',
            'herramientas.idEstadoHerramientas'
        )->get();

        return view('/Laboratorios/create', compact('equipos', 'herramientas', 'materialGastable'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $campos = $request->validate([
            'nombreLaboratorio' => 'required',
            'descripcion' => 'required',
            'fotografia' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nombreLaboratorio.required' => "Se require ingresar el nombre del laboratorio",
            'descripcion.required' => "Se require ingresar una descripcion",
            'fotogragia.required' => "Se require seleccionar una imagen"
        ]);

        $imagen = $request->file('fotografia');

        $nombreImagen = time() . "_" . $imagen->getClientOriginalName();

        $imagen->storeAs('laboratorios', $nombreImagen, 'public');


        $campos['fotografia'] = $nombreImagen;

        $campos['idEstadoLaboratorios'] = 1;


        $laboratorio = Laboratorios::create($campos);

        $materiales = $request->input('idMaterialGastable');

        if (!empty($materiales)) {

            if (count($materiales) > 0) {

                foreach ($materiales as $valor) {

                    $datos_gabinete = [
                        'idLaboratorios' => $laboratorio['idLaboratorios'],
                        'idMaterialGastable' => $valor
                    ];

                    Gabinetes::create($datos_gabinete);
                }
            }
        }

        $equipos = $request->input('idEquipos');

        if (!empty($equipos)) {

            if (count($equipos) > 0) {

                foreach ($equipos as $valor) {

                    $datos_equipos = [
                        'idLaboratorios' => $laboratorio['idLaboratorios'],
                        'idEquipos' => $valor
                    ];

                    LaboratoriosEquipos::create($datos_equipos);
                }
            }
        }

        $herramientas = $request->input('idHerramientas');

        if (!empty($herramientas)) {

            if (count($herramientas) > 0) {

                foreach ($herramientas as $valor) {

                    $datos_herramientas = [
                        'idLaboratorios' => $laboratorio['idLaboratorios'],
                        'idHerramientas' => $valor
                    ];

                    LaboratoriosHerramientas::create($datos_herramientas);
                }
            }
        }


        session()->flash('mensajeLaboratorio', "Se ha ingresado el laboratorio con exito");

        return redirect('/laboratorios/ingreso');
    }

    public function recursosLab($idLaboratorios)
    {

        try {
            $gabinete = Gabinetes::select(
                'gabinetes.idMaterialGastable',
                'material_gastable.fotografia',
                'material_gastable.nombre',
                'material_gastable.descripcion',
                'material_gastable.stock'
            )->join('material_gastable', 'material_gastable.idMaterialGastable', '=', 'gabinetes.idMaterialGastable')
                ->where('gabinetes.idLaboratorios', $idLaboratorios)->get();

            $labHerramientas = LaboratoriosHerramientas::select(
                'herramientas.idHerramientas',
                'herramientas.nombre',
                'herramientas.fotografia',
                'herramientas.descripcion'
            )->join('herramientas', 'herramientas.idHerramientas', '=', 'laboratorios_herramientas.idHerramientas')
                ->where('laboratorios_herramientas.idLaboratorios', $idLaboratorios)->get();

            $labEquipos = LaboratoriosEquipos::select(
                'equipos.idEquipos',
                'equipos.fotografia',
                'equipos.nombre',
                'sistemas_operativos.nombre as sistema_operativo',
                'equipos.espacio_disponible'
            )->join('equipos', 'equipos.idEquipos', '=', 'laboratorios_equipos.idEquipos')
            ->join('sistemas_operativos', 'sistemas_operativos.idSistemasOperativos', '=', 'equipos.idSistemasOperativos')
            ->where('laboratorios_equipos.idLaboratorios', $idLaboratorios)->get();

            $recursos = [
                'materiales_gastables' => $gabinete,
                'herramientas' => $labHerramientas,
                'equipos' => $labEquipos
            ];

            echo json_encode($recursos);
        } catch (\Throwable $th) {
            
            echo json_encode($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Laboratorios $laboratorios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laboratorios $laboratorios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idLaboratorios)
    {
        
        $laboratoriosGet = Laboratorios::find($idLaboratorios);

        $imagenNueva = $request->file('fotografiaUpdate');

        
        
        $eliminarMateriales = $request->input('eliminarMateriales');

        $eliminarHerramientas = $request->input('eliminarHerramientas');

        $eliminarEquipos = $request->input('eliminarEquipos');

        
        
        $materialesNuevo = $request->input('nuevoMateriales');

        $herramientasNuevo = $request->input('nuevoHerramientas');

        $equiposNuevo = $request->input('nuevoEquipos');

        if ($imagenNueva == false) {
            
            $laboratoriosGet->nombreLaboratorio = $request->input('nombreLaboratorio');
            $laboratoriosGet->descripcion = $request->input('descripcion');
            $laboratoriosGet->save();
            
        } else {

            $laboratoriosGet->nombreLaboratorio = $request->input('nombreLaboratorio');
            $laboratoriosGet->descripcion = $request->input('descripcion');
            $laboratoriosGet->save();

            $imagenEliminar = $request->input('fotografia');

            $rutaImagen = 'laboratorios/'. $imagenEliminar;

            Storage::disk('public')->delete($rutaImagen);

            $nombreImagen = time() . "_" . $imagenNueva->getClientOriginalName();

            $imagenNueva->storeAs('laboratorios', $nombreImagen, 'public');

        }

        
        if (!empty($materialesNuevo)) {
            
            if (count($materialesNuevo) > 0) {
                
                foreach($materialesNuevo as $valor) {

                    $datos = [
                        'idMaterialGastable' => $valor,
                        'idLaboratorios' => $idLaboratorios
                    ];

                    Gabinetes::create($datos);

                }
                
            }
            
        }

        if (!empty($herramientasNuevo)) {
            
            if (count($herramientasNuevo) > 0) {
                
                foreach($herramientasNuevo as $valor) {

                    $datos = [
                        'idHerramientas' => $valor,
                        'idLaboratorios' => $idLaboratorios
                    ];


                    LaboratoriosHerramientas::create($datos);

                }
                
            }
            
        }

        if (!empty($equiposNuevo)) {
            
            if (count($equiposNuevo) > 0) {
                
                foreach($equiposNuevo as $valor) {

                    $datos = [
                        'idEquipos' => $valor,
                        'idLaboratorios' => $idLaboratorios
                    ];

                    LaboratoriosEquipos::create($datos);

                }
                
            }

        }

        if (!empty($eliminarMateriales)) {
            
            if(count($eliminarMateriales) > 0) {

                foreach($eliminarMateriales as $valor) {

                    Gabinetes::where('idMaterialGastable', $valor)->delete();
                }

            }

        }


        if(!empty($eliminarHerramientas)) {

            if(count($eliminarHerramientas) > 0) {

                foreach($eliminarHerramientas  as $valor) {

                    LaboratoriosHerramientas::where('idHerramienta', $valor)->delete();

                }

            }

        }

        if(!empty($eliminarEquipos)) {

            if(count($eliminarEquipos) > 0) {

                foreach($eliminarEquipos as $valor) {

                    LaboratoriosEquipos::where('idEquipos', $valor)->delete();

                }
                
            }

        }

        
        session()->flash('mensajeModificarLab', "Se ha modificado el laboratorio con exito");

        return redirect('/laboratorios');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laboratorios $laboratorios)
    {
        //
    }
}
