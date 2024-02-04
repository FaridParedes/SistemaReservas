<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dias;
use App\Models\Equipos;
use App\Models\Modulos;
use App\Models\Reservas;
use App\Models\DiasReserva;
use Carbon\CarbonInterface;
use App\Models\Herramientas;
use App\Models\Laboratorios;
use Illuminate\Http\Request;
use App\Models\EquipoReserva;
use App\Models\EstadoEquipos;
use App\Models\EstadoReservas;
use App\Models\MaterialReserva;
use Illuminate\Validation\Rule;
use App\Models\DuracionReservas;
use App\Models\MaterialGastable;
use App\Models\ComentarioReserva;
use App\Models\EntregaLaboratorio;
use App\Models\HerramientaReserva;
use App\Models\SistemasOperativos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReservasController extends Controller
{
    public function crear()
    {
        $modulos = Modulos::all();
        $laboratorios = Laboratorios::all();
        $dias = Dias::all();
        $equipos = Equipos::select(
            'equipos.idEquipos',
            'equipos.nombre',
            'equipos.fotografia',
            'sistemas_operativos.nombre as sistema_operativo',
            'equipos.espacio_disponible',
            'equipos.ram',
            'estado_equipos.estado',
            'equipos.idSistemasOperativos',
            'equipos.procesador',
        )->join('estado_equipos', 'estado_equipos.idEstadoEquipos', '=', 'equipos.idEstadoEquipos')
        ->join('sistemas_operativos', 'sistemas_operativos.idSistemasOperativos', "=", 'equipos.idSistemasOperativos')
        ->get();

        $materialGastable = MaterialGastable::select(
            'material_gastable.idMaterialGastable',
            'material_gastable.fotografia',
            'material_gastable.nombre',
            
            'material_gastable.stock'
        )->join('estado_materialGastable', 'estado_materialGastable.idEstadoMaterialGastable', '=', 'material_gastable.idEstadoMaterialGastable')
        ->get();

        $herramientas = Herramientas::select(
            'herramientas.idHerramientas',
            'herramientas.nombre',
            'herramientas.fotografia',
            
            'herramientas.marca',
        )->join(
            'estado_herramientas',
            'estado_herramientas.idEstadoHerramientas',
            '=',
            'herramientas.idEstadoHerramientas'
        )->get();

        $sistemasOperativos = SistemasOperativos::all();


        if($laboratorios->isEmpty()){
            $datos1 = "Vacio";
        }else{
            $datos1 = $laboratorios;
        }
        if($modulos->isEmpty()){
            $datos2 = "Vacio";
        }else{
            $datos2 = $modulos;
        }
        return view('/Reservas/Crear')->with(['laboratorios'=>$datos1, 'modulos' => $datos2, 'id' => 0, 'dias'=>$dias,
            'equipos' => $equipos, 'herramientas' => $herramientas , 'materialGastable' => $materialGastable,
            'oS' => $sistemasOperativos
        ]);
    }
    public function crearPorLab(int $id)
    {
        $modulos = Modulos::all();
        $laboratorios = Laboratorios::all();
        $dias = Dias::all();
        $equipos = Equipos::select(
            'equipos.idEquipos',
            'equipos.nombre',
            'equipos.fotografia',
            'sistemas_operativos.nombre as sistema_operativo',
            'equipos.espacio_disponible',
            'equipos.ram',
            'estado_equipos.estado',
            'equipos.idSistemasOperativos',
            'equipos.procesador',
        )->join('estado_equipos', 'estado_equipos.idEstadoEquipos', '=', 'equipos.idEstadoEquipos')
        ->join('sistemas_operativos', 'sistemas_operativos.idSistemasOperativos', "=", 'equipos.idSistemasOperativos')
        ->get();

        $materialGastable = MaterialGastable::select(
            'material_gastable.idMaterialGastable',
            'material_gastable.fotografia',
            'material_gastable.nombre',
            
            'material_gastable.stock'
        )->join('estado_materialGastable', 'estado_materialGastable.idEstadoMaterialGastable', '=', 'material_gastable.idEstadoMaterialGastable')
        ->get();

        $herramientas = Herramientas::select(
            'herramientas.idHerramientas',
            'herramientas.nombre',
            'herramientas.fotografia',
            
            'herramientas.marca',
        )->join(
            'estado_herramientas',
            'estado_herramientas.idEstadoHerramientas',
            '=',
            'herramientas.idEstadoHerramientas'
        )->get();
        
        $sistemasOperativos = SistemasOperativos::all();

        if($laboratorios->isEmpty()){
            $datos1 = "Vacio";
        }else{
            $datos1 = $laboratorios;
        }
        if($modulos->isEmpty()){
            $datos2 = "Vacio";
        }else{
            $datos2 = $modulos;
        }
        
        return view('/Reservas/Crear')->with(['laboratorios'=>$datos1, 'modulos' => $datos2, 'id' => $id, 'dias'=>$dias,
            'equipos' => $equipos, 'herramientas' => $herramientas , 'materialGastable' => $materialGastable,
            'oS' => $sistemasOperativos
        ]);
    }
    public function crearPorDia(){
        $modulos = Modulos::all();
        $laboratorios = Laboratorios::all();
        $equipos = Equipos::select(
            'equipos.idEquipos',
            'equipos.nombre',
            'equipos.fotografia',
            'sistemas_operativos.nombre as sistema_operativo',
            'equipos.espacio_disponible',
            'equipos.ram',
            'estado_equipos.estado',
            'equipos.idSistemasOperativos',
            'equipos.procesador',
        )->join('estado_equipos', 'estado_equipos.idEstadoEquipos', '=', 'equipos.idEstadoEquipos')
        ->join('sistemas_operativos', 'sistemas_operativos.idSistemasOperativos', "=", 'equipos.idSistemasOperativos')
        ->get();

        $materialGastable = MaterialGastable::select(
            'material_gastable.idMaterialGastable',
            'material_gastable.fotografia',
            'material_gastable.nombre',
            
            'material_gastable.stock'
        )->join('estado_materialGastable', 'estado_materialGastable.idEstadoMaterialGastable', '=', 'material_gastable.idEstadoMaterialGastable')
        ->get();

        $herramientas = Herramientas::select(
            'herramientas.idHerramientas',
            'herramientas.nombre',
            'herramientas.fotografia',
            
            'herramientas.marca',
        )->join(
            'estado_herramientas',
            'estado_herramientas.idEstadoHerramientas',
            '=',
            'herramientas.idEstadoHerramientas'
        )->get();

        $sistemasOperativos = SistemasOperativos::all();

        if($laboratorios->isEmpty()){
            $datos1 = "Vacio";
        }else{
            $datos1 = $laboratorios;
        }
        if($modulos->isEmpty()){
            $datos2 = "Vacio";
        }else{
            $datos2 = $modulos;
        }

        return view('/Reservas/CrearPorDia')->with(['laboratorios'=>$datos1, 'modulos' => $datos2, 'id' => 0,
            'equipos' => $equipos, 'herramientas' => $herramientas , 'materialGastable' => $materialGastable,
            'oS' => $sistemasOperativos
        ]);
    }
    public function crearPorDiaPorLab(string $id){
        $modulos = Modulos::all();
        $laboratorios = Laboratorios::all();
        $equipos = Equipos::select(
            'equipos.idEquipos',
            'equipos.nombre',
            'equipos.fotografia',
            'sistemas_operativos.nombre as sistema_operativo',
            'equipos.espacio_disponible',
            'equipos.ram',
            'estado_equipos.estado',
            'equipos.idSistemasOperativos',
            'equipos.procesador',
        )->join('estado_equipos', 'estado_equipos.idEstadoEquipos', '=', 'equipos.idEstadoEquipos')
        ->join('sistemas_operativos', 'sistemas_operativos.idSistemasOperativos', "=", 'equipos.idSistemasOperativos')
        ->get();

        $materialGastable = MaterialGastable::select(
            'material_gastable.idMaterialGastable',
            'material_gastable.fotografia',
            'material_gastable.nombre',
            
            'material_gastable.stock'
        )->join('estado_materialGastable', 'estado_materialGastable.idEstadoMaterialGastable', '=', 'material_gastable.idEstadoMaterialGastable')
        ->get();

        $herramientas = Herramientas::select(
            'herramientas.idHerramientas',
            'herramientas.nombre',
            'herramientas.fotografia',
            
            'herramientas.marca',
        )->join(
            'estado_herramientas',
            'estado_herramientas.idEstadoHerramientas',
            '=',
            'herramientas.idEstadoHerramientas'
        )->get();

        $sistemasOperativos = SistemasOperativos::all();

        if($laboratorios->isEmpty()){
            $datos1 = "Vacio";
        }else{
            $datos1 = $laboratorios;
        }
        if($modulos->isEmpty()){
            $datos2 = "Vacio";
        }else{
            $datos2 = $modulos;
        }
        return view('/Reservas/CrearPorDia')->with(['laboratorios'=>$datos1, 'modulos' => $datos2, 'id' => $id,
            'equipos' => $equipos, 'herramientas' => $herramientas , 'materialGastable' => $materialGastable,
            'oS' => $sistemasOperativos
        ]);
    }

    public function misReservas(){
        $usuario = Auth::user();
        $alertSuccess = Session::get('alertSuccess', 0);
        $alertError = Session::get('alertError', 0);
        $mensaje = Session::get('mensaje', '');

        $misReservas = Reservas::select(
            'idReservas',
            'fechaInicio',
            'fechaFinal',
            'horaInicio',
            'horaFinal',
            'laboratorios.nombreLaboratorio as laboratorio',
            'modulos.nombreModulo as modulo',
            'estado_reservas.estado as estado'
        )->join("laboratorios", "laboratorios.idLaboratorios", "=", "reservas.idLaboratorios")
        ->join("modulos", "modulos.idModulos", "=", "reservas.idModulos")
        ->join("estado_reservas", "estado_reservas.idEstadoReserva", "=", "reservas.idEstadoReserva")
        ->where("id", $usuario->id)->get();
        if($misReservas->isEmpty()){
            $datos = "Vacio";
        }else{
            foreach ($misReservas as $miReserva) {
                $dias = DiasReserva::select("dias.dia as dia")
                ->join("dias", "dias.idDias", "=", "diasreserva.idDia")
                ->where("diasreserva.idReserva", "=",$miReserva["idReservas"])
                ->pluck("dia")->toArray();

                $miReserva->dias = implode(", ", $dias);
            }

            $datos = $misReservas;   
        }
        return view('/Reservas/Show', compact('alertSuccess', 'alertError', 'mensaje'))->with(['Reservas' => $datos]);
    }

    public function store(Request $request)
    {   
        $data =  request()->validate([
            'modulo' => ['required', Rule::notIn(['Elige uno...', 'Aún no hay módulos']),], //idModulo
            'laboratorio' => ['required', Rule::notIn(['Elige uno...', 'Aún no hay laboratorios']),], //idLaboratorio
            'fechaInicio' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::now()->toDateString(),
            ],
            'fechaFinal' => 'required|date|after:fechaInicio',
            'horaInicio' => 'required',
            'horaFinal' => 'required|after:horaInicio',
            'dia' => [ 
                'required',
            ]
        ],[
            'modulo.required' => "Seleccione un módulo válido",
            'laboratorio.required' => "Seleccione un laboratorio válido",
        ]);

        $idMateriales = $request->input('idMaterialGastable');
        $cantidadMateriales = $request->input('cantidadMateriales');
        $materiales = [];

        if ($idMateriales !== null) {
            foreach ($idMateriales as $index => $idMaterial) {
                $cantidad = $cantidadMateriales[$index];
                $materiales[] = (object)['id' => $idMaterial, 'cantidad' => $cantidad];
            }
        }

        $idHerramientas = $request->input('idHerramientas');
        $cantidadHerramientas = $request->input('cantidadHerramientas');
        $herramientas = [];
        if ($idHerramientas !== null) {
            foreach ($idHerramientas as $index => $idHerramienta) {
                $cantidad = $cantidadHerramientas[$index];
                $herramientas[] = (object)['id' => $idHerramienta, 'cantidad' => $cantidad];
            }
        }

        $idEquipos = $request->input('idEquipos');
        $cantidadEquipos = $request->input('cantidadEquipos');
        $idSistemasEquipos = $request->input('sistemaEquipo');
        $equipos = [];
        if ($idEquipos !== null) {
            foreach ($idEquipos as $index => $idEquipo) {
                $cantidad = $cantidadEquipos[$index];
                $sistema = $idSistemasEquipos[$index];
                $equipos[] = (object)['id' => $idEquipo, 'cantidad' => $cantidad, 'idSistemaOperativo' => $sistema];
            }
        }

        
        function getFechasPorDias($dias, $fechaInicio, $fechaFin){
            $fechas = [];
            $diasSinFechas=$dias;
            $diasSinFechasNombres = [];
            $nombreDias = [];
            $fechaActual = Carbon::parse($fechaInicio);
            $diasMapa = [
                1 => 'lunes',
                2 => 'martes',
                3 => 'miércoles',
                4 => 'jueves',
                5 => 'viernes',
                6 => 'sábado',
                7 => 'domingo',
            ];
            
            while ($fechaActual->lessThanOrEqualTo($fechaFin)) {
                $numeroDia = $fechaActual->isoWeekday();

                if (in_array($numeroDia, $dias)) {
                    $fechas[] = $fechaActual->toDateString();  
                    $diasSinFechas = array_diff($diasSinFechas, [$numeroDia]);
                    $nombreDias[] = $fechaActual->isoFormat('dddd');
                }
                $fechaActual->addDay();
            }
            
            foreach ($diasSinFechas as $dia) {
                $diasSinFechasNombres[] = $diasMapa[$dia];
            }
                $nombreDias = array_unique($nombreDias);
            return [
                'fechas' => count($fechas) > 0 ? $fechas : null,
                'diasSinFechas' => count($diasSinFechas) > 0 ? array_values($diasSinFechas) : null,
                'nombreDias' => count($nombreDias)>0 ? array_values($nombreDias):null,
                'diasSinFechasNombres' => count($diasSinFechasNombres)>0 ? array_values($diasSinFechasNombres):null,
            ];
        }

        $fechaInicio = $data['fechaInicio'];
        $fechaFin = $data['fechaFinal'];
        $dias = $data['dia'];

        $resultado = getFechasPorDias($dias, $fechaInicio, $fechaFin);
        
        if($resultado['diasSinFechas'] !== null){
            session()->flash('mensajeError', "Los siguiente días seleccionados están fuera de rango: " . implode(", ",$resultado['diasSinFechasNombres']));
            return redirect('/reservas/crear')->withInput();
        }else{
            $fechasReservadas = DuracionReservas::where('idLaboratorios', $data['laboratorio'])
            ->whereIn('fecha', $resultado['fechas'])
            ->where('horaInicio', $data['horaInicio'])
            ->where('horaFinal', $data['horaFinal'])
            ->get();
            if($fechasReservadas->isEmpty()){
                //Crear reserva sin herramientas, equipos o material extra
                $estadosReservas = EstadoReservas::all();
                foreach ($estadosReservas as $estado) {
                    if($estado->estado === 'Procesando'){
                        $idEstado = $estado->idEstadoReserva;
                    }
                }
                $reserva = Reservas::create([
                    'id'=> Auth::user()->id,
                    'idModulos' => $data['modulo'],
                    'idLaboratorios' => $data['laboratorio'],
                    'idEstadoReserva'=> $idEstado,
                    'fechaInicio' => $data['fechaInicio'],
                    'fechaFinal' => $data['fechaFinal'],
                    'horaInicio' => $data['horaInicio'],
                    'horaFinal' => $data['horaFinal'],

                ]);

                foreach ($resultado['fechas'] as $fecha) {
                    DuracionReservas::create([
                        'idLaboratorios' => $data['laboratorio'],
                        'idReserva' => $reserva['idReservas'],
                        'fecha' => $fecha,
                        'horaInicio' => $data['horaInicio'],
                        'horaFinal' => $data['horaFinal'],
                    ]);
                }

                foreach ($dias as $dia) {
                    $diaReserva = new DiasReserva();
                    $diaReserva->idDia = $dia;
                    $diaReserva->idReserva = $reserva['idReservas'];
                    $diaReserva->save();
                }

                if(!empty($equipos)){
                    foreach ($equipos as $equipo) {
                        $equipoReserva = new EquipoReserva();
                        $equipoReserva->idEquipo =  $equipo->id;
                        $equipoReserva->cantidad = $equipo->cantidad;
                        $equipoReserva->idSistemaOperativo = $equipo->idSistemaOperativo;
                        $equipoReserva->idReserva =  $reserva['idReservas'];
                        $equipoReserva->save();
                    }
                }
                if(!empty($herramientas)){
                    foreach ($herramientas as $herramienta) {
                        $herramientaReserva = new HerramientaReserva();
                        $herramientaReserva->idHerramienta = $herramienta->id;
                        $herramientaReserva->cantidad = $herramienta->cantidad;
                        $herramientaReserva->idReserva =  $reserva['idReservas'];
                        $herramientaReserva->save();
                    }
                }
                if(!empty($materiales)){
                    foreach ($materiales as $material) {
                        $materialReserva = new MaterialReserva();
                        $materialReserva->idMaterial = $material->id;
                        $materialReserva->cantidad = $material->cantidad;
                        $materialReserva->idReserva =  $reserva['idReservas'];
                        $materialReserva->save(); 
                    }
                }

                return redirect('/reservas/show')->with(['alertSuccess' => true, 'alertError' => 0, 'mensaje' => '¡Reserva creada con éxito!']);

            }else{
                $mensaje = "Las siguientes fechas ya están reservadas:\n";
                foreach ($fechasReservadas as $reserva) {
                    $mensaje .= "\nFecha: {$reserva->fecha}, Hora Inicio: {$reserva->horaInicio}, Hora Final: {$reserva->horaFinal}";
                }
                session()->flash('mensajeError', $mensaje);
                return redirect('/reservas/crear')->withInput();
            }

            //return redirect('/reservas/show')->with(['alertSuccess' => true, 'alertError' => 0, 'mensaje' => '¡Todos los días estan en el rango de fechas!']);
        }
    }

    public function storePorDia(Request $request){

        $data =  request()->validate([
            'modulo' => ['required', Rule::notIn(['Elige uno...', 'Aún no hay módulos']),], //idModulo
            'laboratorio' => ['required', Rule::notIn(['Elige uno...', 'Aún no hay laboratorios']),], //idLaboratorio
            'fechaReservacion' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::now()->toDateString(),
            ],
            'horaInicio' => 'required',
            'horaFinal' => 'required|after:horaInicio',
        ]);

        $idMateriales = $request->input('idMaterialGastable');
        $cantidadMateriales = $request->input('cantidadMateriales');
        $materiales = [];

        if ($idMateriales !== null) {
            foreach ($idMateriales as $index => $idMaterial) {
                $cantidad = $cantidadMateriales[$index];
                $materiales[] = (object)['id' => $idMaterial, 'cantidad' => $cantidad];
            }
        }

        $idHerramientas = $request->input('idHerramientas');
        $cantidadHerramientas = $request->input('cantidadHerramientas');
        $herramientas = [];
        if ($idHerramientas !== null) {
            foreach ($idHerramientas as $index => $idHerramienta) {
                $cantidad = $cantidadHerramientas[$index];
                $herramientas[] = (object)['id' => $idHerramienta, 'cantidad' => $cantidad];
            }
        }

        $idEquipos = $request->input('idEquipos');
        $idSistemasEquipos = $request->input('sistemaEquipo');
        $cantidadEquipos = $request->input('cantidadEquipos');
        $equipos = [];
        if ($idEquipos !== null) {
            foreach ($idEquipos as $index => $idEquipo) {
                $cantidad = $cantidadEquipos[$index];
                $sistema = $idSistemasEquipos[$index];
                $equipos[] = (object)['id' => $idEquipo, 'cantidad' => $cantidad, 'idSistemaOperativo' => $sistema];
            }
        }

        $fechasReservadas = DuracionReservas::where('idLaboratorios', $data['laboratorio'])
        ->where('fecha', $data['fechaReservacion'])
        ->where(function ($query) use ($data) {
            $query->where('horaInicio', '<', $data['horaFinal'])
                ->where('horaFinal', '>', $data['horaInicio']);
        })
        ->get();
        if($fechasReservadas->isEmpty()){
            //Crear reserva sin herramientas, equipos o material extra
            $day = Carbon::parse($data['fechaReservacion']);
            $day = $day->isoFormat('dddd');
            $dias = Dias::all();

            foreach ($dias as $dia) {
                if($dia->dia === $day ){
                    $idDia = $dia->idDias;
                }
            }

            
            $estadosReservas = EstadoReservas::all();
            foreach ($estadosReservas as $estado) {
                if($estado->estado === 'Procesando'){
                    $idEstado = $estado->idEstadoReserva;
                }
            }
            $reserva = Reservas::create([
                'id'=> Auth::user()->id,
                'idModulos' => $data['modulo'],
                'idLaboratorios' => $data['laboratorio'],
                'idEstadoReserva'=> $idEstado,
                'fechaInicio' => $data['fechaReservacion'],
                'fechaFinal' => $data['fechaReservacion'],
                'horaInicio' => $data['horaInicio'],
                'horaFinal' => $data['horaFinal'],
            ]);

            DuracionReservas::create([
                'idLaboratorios' => $data['laboratorio'],
                'idReserva' => $reserva['idReservas'],
                'fecha' => $data['fechaReservacion'],
                'horaInicio' => $data['horaInicio'],
                'horaFinal' => $data['horaFinal'],
            ]);

            $diaReserva = new DiasReserva();
            $diaReserva->idDia = $idDia;
            $diaReserva->idReserva = $reserva['idReservas'];
            $diaReserva->save();

            if(!empty($equipos)){
                foreach ($equipos as $equipo) {
                    $equipoReserva = new EquipoReserva();
                    $equipoReserva->idEquipo =  $equipo->id;
                    $equipoReserva->cantidad = $equipo->cantidad;
                    $equipoReserva->idSistemaOperativo = $equipo->idSistemaOperativo;
                    $equipoReserva->idReserva =  $reserva['idReservas'];
                    $equipoReserva->save();
                }
            }
            if(!empty($herramientas)){
                foreach ($herramientas as $herramienta) {
                    $herramientaReserva = new HerramientaReserva();
                    $herramientaReserva->idHerramienta = $herramienta->id;
                    $herramientaReserva->cantidad = $herramienta->cantidad;
                    $herramientaReserva->idReserva =  $reserva['idReservas'];
                    $herramientaReserva->save();
                }
            }
            if(!empty($materiales)){
                foreach ($materiales as $material) {
                    $materialReserva = new MaterialReserva();
                    $materialReserva->idMaterial = $material->id;
                    $materialReserva->cantidad = $material->cantidad;
                    $materialReserva->idReserva =  $reserva['idReservas'];
                    $materialReserva->save(); 
                }
            }

            return redirect('/reservas/show')->with(['alertSuccess' => true, 'alertError' => 0, 'mensaje' => '¡Reserva creada con éxito!']);

        }else{
            $mensaje = "Las siguientes fechas ya están reservadas:\n";
            foreach ($fechasReservadas as $reserva) {
                $mensaje .= "\nFecha: {$reserva->fecha}, Hora Inicio: {$reserva->horaInicio}, Hora Final: {$reserva->horaFinal}";
            }
            session()->flash('mensajeError', $mensaje );
            return redirect('/reservas/crear/dia')->withInput();
        }
    }

    public function detalles(string $id){
        $reserva = Reservas::select(
            'idReservas',
            'id',
            'fechaInicio',
            'fechaFinal',
            'horaInicio',
            'horaFinal',
            'laboratorios.nombreLaboratorio as laboratorio',
            'modulos.nombreModulo as modulo',
            'estado_reservas.estado as estado'
        )->join("laboratorios", "laboratorios.idLaboratorios", "=", "reservas.idLaboratorios")
        ->join("modulos", "modulos.idModulos", "=", "reservas.idModulos")
        ->join("estado_reservas", "estado_reservas.idEstadoReserva", "=", "reservas.idEstadoReserva")
        ->where("idReservas", $id)->first();
        
        if(!$reserva){
            return redirect('/reservas/show');
        }else{
            if(Auth::user()->id !== $reserva['id']){
                return redirect('/reservas/show');
            }

            $dias = DiasReserva::select("dias.dia as dia")
            ->join("dias", "dias.idDias", "=", "diasreserva.idDia")
            ->where("diasreserva.idReserva", "=",$reserva["idReservas"])
            ->pluck("dia")->toArray();

            $reserva->dias = implode(", ", $dias);
            
            $materiales = MaterialReserva::select(
                'material_gastable.idMaterialGastable as id',
                'material_gastable.fotografia as imagen',
                'material_gastable.nombre as nombre',
                'cantidad'
            )->join("material_gastable", "material_gastable.idMaterialGastable","=","materialreserva.idMaterial")
            ->where("materialreserva.idReserva", "=",$reserva["idReservas"])
            ->get();
            
            if(!$materiales->isEmpty()){
                $reserva->materiales = $materiales;
            }else{
                $reserva->materiales = "Vacio";
            }

            $herramientas = HerramientaReserva::select(
                'herramientas.idHerramientas as id',
                'herramientas.fotografia as imagen',
                'herramientas.nombre as nombre',
                'cantidad'
            )->join("herramientas", "herramientas.idHerramientas","=","herramientareserva.idHerramienta")
            ->where("herramientareserva.idReserva", "=",$reserva["idReservas"])
            ->get();
            
            if(!$herramientas->isEmpty()){
                $reserva->herramientas = $herramientas;
            }else{
                $reserva->herramientas = "Vacio";
            }

            $equipos = EquipoReserva::select(
                'equipos.idEquipos as id',
                'equipos.fotografia as imagen',
                'equipos.nombre as nombre',
                'sistemas_operativos.nombre as sisOperativo',
                'cantidad'
            )->join("equipos", "equipos.idEquipos","=","equiporeserva.idEquipo")
            ->join('sistemas_operativos', 'sistemas_operativos.idSistemasOperativos', "=", 'equiporeserva.idSistemaOperativo')
            ->where("equiporeserva.idReserva", "=",$reserva["idReservas"])
            ->get();
            
            if(!$equipos->isEmpty()){
                $reserva->equipos = $equipos;
            }else{
                $reserva->equipos = "Vacio";
            }
            

            
            return view('Reservas/Detalles')->with(['reserva'=>$reserva]);
        }
        
    }

    public function gestionar(){
        $alertSuccess = Session::get('alertSuccess', 0);
        $alertError = Session::get('alertError', 0);
        $mensaje = Session::get('mensaje', '');

        $Reservas = Reservas::select(
            'idReservas',
            'fechaInicio',
            'fechaFinal',
            'horaInicio',
            'horaFinal',
            'laboratorios.nombreLaboratorio as laboratorio',
            'modulos.nombreModulo as modulo',
            'estado_reservas.estado as estado',
            'users.name as docente'
        )->join("laboratorios", "laboratorios.idLaboratorios", "=", "reservas.idLaboratorios")
        ->join("modulos", "modulos.idModulos", "=", "reservas.idModulos")
        ->join("users", "users.id","=","reservas.id")
        ->join("estado_reservas", "estado_reservas.idEstadoReserva", "=", "reservas.idEstadoReserva")
        ->get();
        if($Reservas->isEmpty()){
            $datos = "Vacio";
        }else{
            foreach ($Reservas as $reserva) {
                $dias = DiasReserva::select("dias.dia as dia")
                ->join("dias", "dias.idDias", "=", "diasreserva.idDia")
                ->where("diasreserva.idReserva", "=",$reserva["idReservas"])
                ->pluck("dia")->toArray();

                $reserva->dias = implode(", ", $dias);

                $materiales = MaterialReserva::select(
                    'material_gastable.idMaterialGastable as id',
                    'material_gastable.fotografia as imagen',
                    'material_gastable.nombre as nombre',
                    'cantidad'
                )->join("material_gastable", "material_gastable.idMaterialGastable","=","materialreserva.idMaterial")
                ->where("materialreserva.idReserva", "=",$reserva["idReservas"])
                ->get();
                
                if(!$materiales->isEmpty()){
                    $reserva->materiales = $materiales;
                }
    
                $herramientas = HerramientaReserva::select(
                    'herramientas.idHerramientas as id',
                    'herramientas.fotografia as imagen',
                    'herramientas.nombre as nombre',
                    'cantidad'
                )->join("herramientas", "herramientas.idHerramientas","=","herramientareserva.idHerramienta")
                ->where("herramientareserva.idReserva", "=",$reserva["idReservas"])
                ->get();
                
                if(!$herramientas->isEmpty()){
                    $reserva->herramientas = $herramientas;
                }
    
                $equipos = EquipoReserva::select(
                    'equipos.idEquipos as id',
                    'equipos.fotografia as imagen',
                    'equipos.nombre as nombre',
                    'equipos.idSistemasOperativos',
                    'sistemas_operativos.nombre as sistema_operativo',
                    'cantidad'
                )->join("equipos", "equipos.idEquipos","=","equiporeserva.idEquipo")
                ->join('sistemas_operativos', 'sistemas_operativos.idSistemasOperativos', "=", 'equipos.idSistemasOperativos')
                ->where("equiporeserva.idReserva", "=",$reserva["idReservas"])
                ->get();
                
                if(!$equipos->isEmpty()){
                    $reserva->equipos = $equipos;
                }
            }

            $datos = $Reservas;   
        }
        return view('/Reservas/Gestionar', compact('alertSuccess', 'alertError', 'mensaje'))->with(['Reservas' => $datos]);
    }

    public function gestionReserva(string $id){
        $reserva = Reservas::select(
            'idReservas',
            'fechaInicio',
            'fechaFinal',
            'horaInicio',
            'horaFinal',
            'laboratorios.nombreLaboratorio as laboratorio',
            'modulos.nombreModulo as modulo',
            'estado_reservas.estado as estado',
            'users.name as docente'
        )->join("laboratorios", "laboratorios.idLaboratorios", "=", "reservas.idLaboratorios")
        ->join("modulos", "modulos.idModulos", "=", "reservas.idModulos")
        ->join("estado_reservas", "estado_reservas.idEstadoReserva", "=", "reservas.idEstadoReserva")
        ->join("users", "users.id","=","reservas.id")
        ->where("idReservas", $id)->first();
        
        if(!$reserva){
            return redirect('/reservas/gestionar');
        }else{

            $dias = DiasReserva::select("dias.dia as dia")
            ->join("dias", "dias.idDias", "=", "diasreserva.idDia")
            ->where("diasreserva.idReserva", "=",$reserva["idReservas"])
            ->pluck("dia")->toArray();

            $reserva->dias = implode(", ", $dias);
            
            $materiales = MaterialReserva::select(
                'material_gastable.idMaterialGastable as id',
                'material_gastable.fotografia as imagen',
                'material_gastable.nombre as nombre',
                'cantidad'
            )->join("material_gastable", "material_gastable.idMaterialGastable","=","materialreserva.idMaterial")
            ->where("materialreserva.idReserva", "=",$reserva["idReservas"])
            ->get();
            
            if(!$materiales->isEmpty()){
                $reserva->materiales = $materiales;
            }else{
                $reserva->materiales = "Vacio";
            }

            $herramientas = HerramientaReserva::select(
                'herramientas.idHerramientas as id',
                'herramientas.fotografia as imagen',
                'herramientas.nombre as nombre',
                'cantidad'
            )->join("herramientas", "herramientas.idHerramientas","=","herramientareserva.idHerramienta")
            ->where("herramientareserva.idReserva", "=",$reserva["idReservas"])
            ->get();
            
            if(!$herramientas->isEmpty()){
                $reserva->herramientas = $herramientas;
            }else{
                $reserva->herramientas = "Vacio";
            }

            $equipos = EquipoReserva::select(
                'equipos.idEquipos as id',
                'equipos.fotografia as imagen',
                'equipos.nombre as nombre',
                'equipos.idSistemasOperativos',
                'sistemas_operativos.nombre as sisOperativo',
                'cantidad'
            )->join("equipos", "equipos.idEquipos","=","equiporeserva.idEquipo")
            ->join('sistemas_operativos', 'sistemas_operativos.idSistemasOperativos', "=", 'equipos.idSistemasOperativos')
            ->where("equiporeserva.idReserva", "=",$reserva["idReservas"])
            ->get();
            
            if(!$equipos->isEmpty()){
                $reserva->equipos = $equipos;
            }else{
                $reserva->equipos = "Vacio";
            }
            $comentario = ComentarioReserva::select(
                'comentario'
            )->where("idReserva", $reserva['idReservas'])
            ->first();
            if(!$comentario){
                $reserva->comentario = "Vacio";
            }else{
                $reserva->comentario = $comentario["comentario"];
            }
            $comentarioEntregado = EntregaLaboratorio::select(
                'comentario'
            )->where("idReserva", $reserva['idReservas'])
            ->first();
            if(!$comentarioEntregado){
                $reserva->comentarioEntregado = "Vacio";
            }else{
                $reserva->comentarioEntregado = $comentarioEntregado["comentario"];
            }
            
            return view('Reservas/GestionReserva')->with(['reserva'=>$reserva]);
        }
        return view('/Reservas/GestionReserva');
    }

    public function aprobarReserva(request $request){

        if($request->materialReservaId !== null){
            $idMateriales = $request->materialReservaId;
            $cantidadMateriales = $request->materialCantidad;
            $materiales = [];
            foreach ($idMateriales as $index => $idMaterial) {
                $cantidad = $cantidadMateriales[$index];
                $materiales[] = (object)['id' => $idMaterial, 'cantidad' => $cantidad];
            }
            $materialesReserva = MaterialReserva::select(
                'id',
                'idMaterial',
                'idReserva',
                'cantidad'
            )->where('idReserva',$request->idReserva)->get();
            
            foreach ($materialesReserva as $material) {
                foreach ($materiales as $materialNew) {
                    if($material->idMaterial == $materialNew->id){
                        $material->cantidad = $materialNew->cantidad;
                        //$material->stock -= $material->cantidad; 
                        $material->save();
                    }
                }
            }
            $materialesAll = MaterialGastable::All();

            foreach ($materialesAll as $material) {
                foreach ($materiales as $materialNew) {
                    if($material->idMaterialGastable == $materialNew->id){                        
                        $material->stock -= $materialNew->cantidad;
                        $material->save();
                    }
                }
            }
        }
        if($request->herramientaReservaId !== null){
            $idHerramientas = $request->herramientaReservaId;
            $cantidadHerramientas = $request->herramientaCantidad;
            $herramientas = [];
            foreach ($idHerramientas as $index => $idHerramienta) {
                $cantidad = $cantidadHerramientas[$index];
                $herramientas[] = (object)['id' => $idHerramienta, 'cantidad' => $cantidad];
            }
            $HerramientasReserva = HerramientaReserva::select(
                'id',
                'idHerramienta',
                'idReserva',
                'cantidad'
            )->where('idReserva',$request->idReserva)->get();
            
            foreach ($HerramientasReserva as $herramienta) {
                foreach ($herramientas as $herramientaNew) {
                    if($herramienta->idHerramienta == $herramientaNew->id){
                        $herramienta->cantidad = $herramientaNew->cantidad;
                        $herramienta->save();
                    }
                }
            }

            $herramientasAll = Herramientas::All();
            foreach ($herramientasAll as $herramienta) {
                foreach ($herramientas as $herramientaNew) {
                    if($herramienta->idHerramientas == $herramientaNew->id){
                        $herramienta->stock -= $herramientaNew->cantidad; 
                        $herramienta->save();
                    }
                }
            }
        }

        if($request->equipoReservaId !== null){
            $idEquipos = $request->equipoReservaId;
            $cantidadEquipos = $request->equipoCantidad;
            $equipos = [];
            foreach ($idEquipos as $index => $idEquipo) {
                $cantidad = $cantidadEquipos[$index];
                $equipos[] = (object)['id' => $idEquipo, 'cantidad' => $cantidad];
            }
            $equiposReserva = EquipoReserva::where('idReserva',$request->idReserva)->get();

            foreach ($equiposReserva as $equipo) {
                foreach ($equipos as $equipoNew) {
                    if($equipo->idEquipo == $equipoNew->id){
                        $equipo->cantidad = $equipoNew->cantidad;
                        $equipo->save();
                    }
                }
            }
        }
        if($request->comentario !== null){
            $comentario = $request->comentario;
            $comentario = ComentarioReserva::create([
                'comentario' => $comentario,
                'idReserva' => $request->idReserva,
            ]);
        }

        $estados = EstadoReservas::all();
        foreach ($estados as $item) {
            if($item->estado === "Aprobado" || $item->estado === "aprobado" ){
                $idEstado = $item->idEstadoReserva;
            }
        }
        $id = $request->idReserva;
        $reserva = Reservas::find($id); 
        $reserva->idEstadoReserva = $idEstado;
        $reserva->save();
        return redirect('/reservas/gestionar/'.$id);
    }

    public function rechazarReserva(request $request){

        $comentario = $request->comentario;
        $id = $request->idReserva;
        //return response()->json(array('res' => true));

        $reserva = Reservas::find($id); 
        $estados = EstadoReservas::all();
        foreach ($estados as $item) {
            if($item->estado === "Rechazado" || $item->estado === "rechazado" ){
                $idEstado = $item->idEstadoReserva;
            }
        }
        $reserva->idEstadoReserva = $idEstado;
        $reserva->save();

        DuracionReservas::where('idReserva',$reserva->idReservas)->delete();

        if ($comentario !== null && $comentario !== "") {
            $existirComentario = ComentarioReserva::select(
                'id',
                'idReserva',
                'comentario'
            )->where("idReserva", $id)
            ->get();
            
            if($existirComentario->isEmpty()){
                $comentario = ComentarioReserva::create([
                    'comentario' => $comentario,
                    'idReserva' => $id,
                ]);
            }
        }

        return response()->json([
            'code'=>200, 
        ], 200);
    }

    public function cancelarReserva(request $request){
        $comentario = $request->comentario;
        $id = $request->idReserva;

        $reserva = Reservas::find($id);
        $estados = EstadoReservas::all();
        foreach ($estados as $item) {
            if($item->estado === "Cancelado" || $item->estado === "cancelado" ){
                $idEstado = $item->idEstadoReserva;
            }
        }
        $reserva->idEstadoReserva = $idEstado;
        $reserva->save();

        DuracionReservas::where('idReserva',$reserva->idReservas)->delete();
        
        if ($comentario !== null && $comentario !== "") {
            $existirComentario = ComentarioReserva::select(
                'id',
                'idReserva',
                'comentario'
            )->where("idReserva", $id)
            ->get();
            
            if($existirComentario->isEmpty()){
                $comentario = ComentarioReserva::create([
                    'comentario' => $comentario,
                    'idReserva' => $id,
                ]);
            }
        }



        return response()->json([
            'code'=>200, 
        ], 200);
    }

    public function entregarReserva(string $id){
        $reserva = Reservas::select(
            'idReservas',
            'fechaInicio',
            'fechaFinal',
            'horaInicio',
            'horaFinal',
            'laboratorios.nombreLaboratorio as laboratorio',
            'modulos.nombreModulo as modulo',
            'estado_reservas.estado as estado',
            'users.name as docente'
        )->join("laboratorios", "laboratorios.idLaboratorios", "=", "reservas.idLaboratorios")
        ->join("modulos", "modulos.idModulos", "=", "reservas.idModulos")
        ->join("estado_reservas", "estado_reservas.idEstadoReserva", "=", "reservas.idEstadoReserva")
        ->join("users", "users.id","=","reservas.id")
        ->where("idReservas", $id)->first();
        
        if(!$reserva){
            return redirect('/reservas/gestionar');
        }else{
            if($reserva->estado !== "Aprobado"){
                return redirect('/reservas/gestionar');
            }

            $dias = DiasReserva::select("dias.dia as dia")
            ->join("dias", "dias.idDias", "=", "diasreserva.idDia")
            ->where("diasreserva.idReserva", "=",$reserva["idReservas"])
            ->pluck("dia")->toArray();

            $reserva->dias = implode(", ", $dias);
            
            $materiales = MaterialReserva::select(
                'material_gastable.idMaterialGastable as id',
                'material_gastable.fotografia as imagen',
                'material_gastable.nombre as nombre',
                'cantidad'
            )->join("material_gastable", "material_gastable.idMaterialGastable","=","materialreserva.idMaterial")
            ->where("materialreserva.idReserva", "=",$reserva["idReservas"])
            ->get();
            
            if(!$materiales->isEmpty()){
                $reserva->materiales = $materiales;
            }else{
                $reserva->materiales = "Vacio";
            }

            $herramientas = HerramientaReserva::select(
                'herramientas.idHerramientas as id',
                'herramientas.fotografia as imagen',
                'herramientas.nombre as nombre',
                'cantidad'
            )->join("herramientas", "herramientas.idHerramientas","=","herramientareserva.idHerramienta")
            ->where("herramientareserva.idReserva", "=",$reserva["idReservas"])
            ->get();
            
            if(!$herramientas->isEmpty()){
                $reserva->herramientas = $herramientas;
            }else{
                $reserva->herramientas = "Vacio";
            }

            $equipos = EquipoReserva::select(
                'equipos.idEquipos as id',
                'equipos.fotografia as imagen',
                'equipos.nombre as nombre',
                'equipos.idSistemasOperativos',
                'sistemas_operativos.nombre as sisOperativo',
                'cantidad'
            )->join("equipos", "equipos.idEquipos","=","equiporeserva.idEquipo")
            ->join('sistemas_operativos', 'sistemas_operativos.idSistemasOperativos', "=", 'equipos.idSistemasOperativos')
            ->where("equiporeserva.idReserva", "=",$reserva["idReservas"])
            ->get();
            
            if(!$equipos->isEmpty()){
                $reserva->equipos = $equipos;
            }else{
                $reserva->equipos = "Vacio";
            }
            $comentario = ComentarioReserva::select(
                'comentario'
            )->where("idReserva", $reserva['idReservas'])
            ->first();
            if(!$comentario){
                $reserva->comentario = "Vacio";
            }else{
                $reserva->comentario = $comentario["comentario"];
            }
            
            return view('Reservas/EntregarLab')->with(['reserva'=>$reserva]);
        }
        return view('Reservas/EntregarLab');
    }

    public function aprobarEntrega(request $request){
        $comentario = $request->comentario;
        $id = $request->idReserva;
        $reserva = Reservas::find($id);
        $estadoReserva = EstadoReservas::all();
        foreach ($estadoReserva as $estado) {
            if($estado->estado === "Entregado"){
                $estadoReId = $estado->idEstadoReserva;   
            }
        }
        if($reserva->idEstadoReserva === $estadoReId){
            return redirect('/reservas/gestionar/'.$id);
        }

        if($request->herramientaEntregadaId !== null){
            $idHerramientas = $request->herramientaEntregadaId;
            $cantidadHerramientas = $request->herramientaEntregadaCantidad;
            $herramientas = [];
            foreach ($idHerramientas as $index => $idHerramienta) {
                $cantidad = $cantidadHerramientas[$index];
                $herramientas[] = (object)['id' => $idHerramienta, 'cantidad' => $cantidad];
            }
            $HerramientasReserva = HerramientaReserva::select(
                'id',
                'idHerramienta',
                'idReserva',
                'cantidad'
            )->where('idReserva',$request->idReserva)->get();
            
            $parametro = 0;
            foreach ($HerramientasReserva as $herramienta) {
                foreach ($herramientas as $herramientaNew) {
                    if($herramienta->idHerramienta == $herramientaNew->id){
                        if( 0 <= $herramientaNew->cantidad && $herramientaNew->cantidad <= $herramienta->cantidad){
                            $herramientaStock = Herramientas::find($herramientaNew->id);
                            $herramientaStock->stock += $herramientaNew->cantidad; 
                            $herramientaStock->save();
                        }else{
                           $parametro += 1;
                        }
                    }
                }
            }
            if($parametro>0){
                session()->flash('mensajeError', "La cantidad de herramientas entregadas no debe ser mayor que la solicitada al reservar o menor que cero.");
                return redirect('reservas/entregar/'.$request->idReserva);
            }
        }
        if($request->equipoEntregadoId !== null){
            $idEquipos = $request->equipoEntregadoId;
            $cantidadEquipos = $request->equipoEntregadoCantidad;
            $equipos = [];
            foreach ($idEquipos as $index => $idEquipo) {
                $cantidad = $cantidadEquipos[$index];
                $equipos[] = (object)['id' => $idEquipo, 'cantidad' => $cantidad];
            }
            $equiposReserva = EquipoReserva::where('idReserva',$request->idReserva)->get();
            $parametro2 = 0;
            foreach ($equiposReserva as $equipo) {
                foreach ($equipos as $equipoNew) {
                    if($equipo->idEquipo == $equipoNew->id){
                        if( 0 <= $equipoNew->cantidad && $equipoNew->cantidad <= $equipo->cantidad){
                            $equipoEntregado = Equipos::find($equipoNew->id);
                            if($equipoNew->cantidad == 0){
                                $estados = EstadoEquipos::all();
                                foreach ($estados as $estado) {
                                    if($estado->estado === "No disponible"){
                                        $idEstado = $estado->idEstadoEquipos;
                                    }
                                }
                                $equipoEntregado->idEstadoEquipos = $idEstado;
                                $equipoEntregado->save();
                            }
                        }else{
                           $parametro2+=1;
                        }
                    }
                }
            }
            if($parametro2>0){
                session()->flash('mensajeError', "La cantidad de equipos entregados no debe ser mayor que la solicitada al reservar o menor que cero.");
                return redirect('reservas/entregar/'.$request->idReserva);
            }
        }
        if ($comentario !== null && $comentario !== "") {
            $existirComentario = EntregaLaboratorio::select(
                'id',
                'idReserva',
                'comentario'
            )->where("idReserva", $id)
            ->get();
            
            if($existirComentario->isEmpty()){
                $comentario = EntregaLaboratorio::create([
                    'comentario' => $comentario,
                    'idReserva' => $id,
                ]);
            }
        }

        $reserva->idEstadoReserva = $estadoReId;
        $reserva->save();
        
        session()->flash('mensajeSuccess', "El cambio se realizó correctamente.");
        return redirect('/reservas/gestionar/'.$id);
    }

    public function edit(Reservas $reservas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservas $reservas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservas $reservas)
    {
        //
    }
}
