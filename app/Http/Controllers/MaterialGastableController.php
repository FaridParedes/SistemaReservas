<?php

namespace App\Http\Controllers;

use App\Models\MaterialGastable;
use App\Models\TiposCantidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialGastableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consulta_materialGastable = MaterialGastable::select(
            'material_gastable.idMaterialGastable',
            'material_gastable.fotografia',
            'material_gastable.nombre',
            'material_gastable.descripcion',
            'tipos_cantidades.idTipos_cantidades',
            'tipos_cantidades.tipo',
            'material_gastable.stock',
            'estado_materialGastable.estado',
            'material_gastable.created_at'
        )
        ->join('estado_materialGastable', 'estado_materialGastable.idEstadoMaterialGastable', '=', 'material_gastable.idEstadoMaterialGastable')
        ->join('tipos_cantidades', 'tipos_cantidades.idTipos_cantidades', '=', 'material_gastable.idTipos_cantidades')
        ->get();

        $tiposCantidades = TiposCantidades::select('idTipos_cantidades','tipo')->get();

        return view('/MaterialGastable/show', compact('consulta_materialGastable', 'tiposCantidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $tiposCantidades = TiposCantidades::select('idTipos_cantidades','tipo')->get();

        return view('/MaterialGastable/create', compact('tiposCantidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $campos = $request->validate([
            'nombre' => 'required',
            'fotografia' => 'required|image|mimes:jpeg,png,jpg,gif',
            'descripcion' => "required",
            'idTipos_cantidades' => "required",
            'stock' => 'required'
        ], [
            'nombre.required' => "Se require ingresar un nombre al material",
            'fotografia.required' => "Se require seleccionar una imagen al material",
            'descripcion.required' => "Se require ingresar la descripcion del material",
            'stock.required' => "Se require ingresar un stock para el material",
            'idTipos_cantidades.required' => "Se requiere elegir el tipo de cantidad del material"
        ]);


        $imagen = $request->file('fotografia');

        $nombreImagen = time() . "_" . $imagen->getClientOriginalName();

        $imagen->storeAs('materialesGastables', $nombreImagen, 'public');

        $campos['fotografia'] = $nombreImagen;
        $campos['idEstadoMaterialGastable'] = 1;

        MaterialGastable::create($campos);

        session()->flash('mensajeMaterial', "Se ha ingresado con exito");

        return redirect('/materialGastable/ingreso');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaterialGastable $materialGastable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaterialGastable $materialGastable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idMaterialGastable)
    {
        $material_gastable = MaterialGastable::find($idMaterialGastable);

        $imagen = $request->file('fotografiaUpdate');

        $datos_materialGastable = [
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'idTipos_cantidades' => $request->input('idTipos_cantidades'),
            'stock' => $request->input('stock')
        ];

        if ($imagen == false) {

            $material_gastable->update($datos_materialGastable);

            session()->flash('mensajeMaterialGastable1', "Se ha modificado con exito");

            return redirect('/materialGastable/show');

        } else {

            $imagenUpdate = $request->input('fotografia');

            if ($imagenUpdate == true) {

                $rutaImagen = 'materialesGastables/' . $imagenUpdate;

                Storage::disk('public')->delete($rutaImagen);
            }

            $nombreImagen = time()."_". $imagen->getClientOriginalName();

            $imagen->storeAs('materialesGastables', $nombreImagen, 'public');

            $datos_materialGastable['fotografia'] = $nombreImagen;

            session()->flash('mensajeMaterialGastable2', "Se ha modificado con exito");

            $material_gastable->update($datos_materialGastable);

            return redirect('/materialGastable/show');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaterialGastable $materialGastable)
    {
        //
    }
}
