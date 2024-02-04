<?php

namespace App\Http\Controllers;

use session;
use App\Models\Herramientas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HerramientasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $consulta_herramientas = Herramientas::select(
            'herramientas.idHerramientas',
            'herramientas.nombre',
            'herramientas.fotografia',
            'herramientas.descripcion',
            'herramientas.marca',
            'herramientas.stock',
            'herramientas.created_at',
            'estado_herramientas.estado'
        )
            ->join(
                'estado_herramientas',
                'estado_herramientas.idEstadoHerramientas',
                '=',
                'herramientas.idEstadoHerramientas'
            )->get();

        return view('/Herramientas/show', compact('consulta_herramientas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/Herramientas/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos = $request->validate([
            'nombre' => 'required',
            'imgHerramienta' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descripcion' => 'required',
            'marca' => 'required',
            'stock' => 'required'
        ], [
            'nombre.required' => "Se require ingresar el nombre de la herramienta",
            'imgHerramienta.required' => "Se require seleccionar una imagen",
            'descripcion.required' => "Se require ingresar una descripcion",
            'marca.required' => "Se require ingresar el nombre de la marca",
            'stock.required' => "Se require ingresar un stock para la herramienta"
        ]);

        $imagen = $request->file('imgHerramienta');

        $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

        // Guardar la imagen en el almacenamiento de Laravel (en la carpeta 'public/images')
        $imagen->storeAs('herramientas', $nombreImagen, 'public');

        $datos_herramienta = [
            'nombre' => $campos['nombre'],
            'fotografia' => $nombreImagen,
            'descripcion' => $campos['descripcion'],
            'marca' => $campos['marca'],
            'idEstadoHerramientas' => 1,
            'stock' => $campos['stock']
        ];

        Herramientas::create($datos_herramienta);

        session()->flash('mensaje', "Se ha guardado la herramienta con exito");

        return redirect('/herramientas/ingreso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Herramientas $herramientas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Herramientas $herramientas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idHerramientas)
    {
        $herramienta = Herramientas::find($idHerramientas);

        $imagen = $request->file('imgHerramienta');

        if ($imagen == false) {

            $datos_herramientas = [
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'marca' => $request->input('marca')
            ];

            $herramienta->update($datos_herramientas);

            session()->flash('mensaje', "Se ha modificado la herramienta con exito");

            return redirect('/herramientas/show');

        } else {

            $nombreArchivo = $request->input('fotoHerramienta');

            // Comprobar si el archivo existe antes de intentar eliminarlo
            $rutaArchivo = 'herramientas/' . $nombreArchivo;

            // Eliminara el archivo especificando en que carpeta esta usando disk('public')
            Storage::disk('public')->delete($rutaArchivo);


            $imagen = $request->file('imgHerramienta');

            // Generar un nombre único para la imagen
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

            // Guardar la imagen en el almacenamiento de Laravel (en la carpeta 'public/images')
            $imagen->storeAs('herramientas', $nombreImagen, 'public');

            $datos_herramientas = [
                'nombre' => $request->input('nombre'),
                'fotografia' => $nombreImagen,
                'descripcion' => $request->input('descripcion'),
                'marca' => $request->input('marca')
            ];

            $herramienta->update($datos_herramientas);

            session()->flash('mensaje', "Se ha modificado la herramienta con exito");

            return redirect('/herramientas/show');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Herramientas $herramientas)
    {
        //
    }
}
