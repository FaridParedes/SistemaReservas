<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Models\Reservas;
use App\Models\DiasReserva;
use Illuminate\Http\Request;
use App\Models\EquipoReserva;
use App\Models\MaterialReserva;
use App\Models\DuracionReservas;
use App\Models\ComentarioReserva;
use App\Models\EntregaLaboratorio;
use App\Models\HerramientaReserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Usuarios = User::select(
            "users.id",
            "users.name",
            "users.email",
            "roles.estado as rol",
            "users.created_at as registro"
        )->join("roles", "roles.idRoles", "=","users.idRoles")
        ->get();
        $alertSuccess = Session::get('alertSuccess', 0);
        $alertError = Session::get('alertError', 0);
        $mensaje = Session::get('mensaje', '');

        if($Usuarios->isEmpty()){
            $datos = "Vacio";
        }else{
            $datos = $Usuarios;
        }
        return view('Usuarios/Show', compact('alertSuccess', 'alertError', 'mensaje'))->with(['usuarios' => $datos]);
    }

    public function crear(){
        $roles = Roles::all();
        return view('Usuarios/Crear')->with(['roles'=>$roles]);
    }

    public function cambiarRol(User $user){
        $roles = Roles::all();
        return view('Usuarios/CambiarRol')->with(['usuario' => $user, 'roles' => $roles]);
    }

    public function updateRol(Request $request, User $user){
        $data = $request->validate([
            'idRoles' => 'required'
        ]);
        $user->idRoles = $data['idRoles'];
        $user->save();

        return redirect('/usuarios/show')->with(['alertSuccess' => true, 'alertError' => 0, 'mensaje' => '¡Se cambió el rol exitosamente!']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validacion = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'idRoles' => 'required'
            ]);
    
            User::create([
                'name' => $validacion['name'],
                'email' => $validacion['email'],
                'password' => Hash::make($validacion['password']),
                'idRoles' => $validacion['idRoles']
            ]);

            return redirect('/usuarios/show')->with(['alertSuccess' => true, 'alertError' => 0, 'mensaje' => '¡Usuario creado con éxito!']);
        } catch (\Throwable $th) {
            return redirect('/usuarios/show')->with(['alertSuccess' => 0, 'alertError' => true, 'mensaje' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function miCuenta(){
        $usuario = Auth::user();
        return view('Usuarios/MiCuenta')->with(['usuario' => $usuario, 'modCorrecta'=> 0, 'modError' => 0, 'mensaje' => '']);
    }

    public function update(Request $request, User $user)
    {
        $validacion = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);


        if($validacion['email'] === $user->email){

            if($validacion['name'] === $user->name){
                return view('/Usuarios/MiCuenta')->with([
                    'usuario' => $user, 
                    'modCorrecta'=> 0, 
                    'modError' => true,
                    'mensaje' => 'El nombre y correo son el mismo.'
                ]);
            }else{
                $user->name = $validacion['name'];
                $user->save();
                return view('/Usuarios/MiCuenta')->with([
                    'usuario' => $user, 
                    'modCorrecta'=> true, 
                    'modError' => 0,
                    'mensaje' => 'El nombre se modificó correctamente.'
                ]);
            }
        } else {
            $parametro = User::where('email', $validacion['email'])->first();
            if(!$parametro){
                if($validacion['name'] === $user->name){
                    $user->email = $validacion['email'];
                    $user->save();
                    return view('/Usuarios/MiCuenta')->with([
                        'usuario' => $user, 
                        'modCorrecta'=> true, 
                        'modError' => 0,
                        'mensaje' => 'El correo se modificó correctamente.'
                    ]);
                }else{
                    $user->name = $validacion['name'];
                    $user->email = $validacion['email'];
                    $user->save();
                    return view('/Usuarios/MiCuenta')->with([
                        'usuario' => $user, 
                        'modCorrecta' => true, 
                        'modError' => 0,
                        'mensaje' => 'El nombre y correo se modificaron correctamente.'
                    ]);
                }

            } else {
                if($validacion['name'] === $user->name){
                    return view('/Usuarios/MiCuenta')->with([
                        'usuario' => $user, 
                        'modCorrecta'=> 0, 
                        'modError' => true,
                        'mensaje' => 'El correo deseado ya se encuentra en uso.'
                    ]);
                } else {
                    $user->name = $validacion['name'];
                    $user->save();
                    return view('/Usuarios/MiCuenta')->with([
                        'usuario' => $user, 
                        'modCorrecta'=> true, 
                        'modError' => 0,
                        'mensaje' => 'El nombre se modificó correctamente, sin embargo, el correo deseado ya se encuentra en uso.'
                    ]);
                }
            }
        }
    }
    public function updatePasswordView(){
        $alertSuccess = Session::get('alertSuccess', 0);
        $alertError = Session::get('alertError', 0);
        $mensaje = Session::get('mensaje', '');

        return view('/Usuarios/UpdatePassword', compact('alertSuccess', 'alertError', 'mensaje'));
    }

    public function updatePassword(Request $request){
        $validacion = $request->validate([
            'contraseña_actual' => 'required',
            'contraseña_nueva' => 'required|min:8',
            'Repite_la_contraseña_nueva' => 'required',
        ]);


        $user = Auth::user();

        if(Hash::check($validacion['contraseña_actual'], $user['password'])){
            if($validacion['contraseña_nueva'] === $validacion['Repite_la_contraseña_nueva']){
                $user['password'] = Hash::make($validacion['contraseña_nueva'] );
                $user->save();
                return redirect('/cuenta/update/password')->with(['alertSuccess' => true, 'alertError' => false, 'mensaje' => 'Contraseña cambiada exitosamente.']);
            }else{
                return redirect('/cuenta/update/password')->with(['alertSuccess' => false, 'alertError' => true, 'mensaje' => 'La Contraseña  nueva no coinciden.']);
            }
        } else{
            return redirect('/cuenta/update/password')->with(['alertSuccess' => false, 'alertError' => true, 'mensaje' => 'La Contraseña actual ingresada es incorrecta.']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // $reserva = Reservas::where('id', $id)->get();
            // ComentarioReserva::where('idReserva', $reserva->idReservas);
            // DiasReservas::where('idReserva',$reserva->idReservas);
            // DuracionReservas::where('idReserva',$reserva->idReservas);
            // EquipoReserva::where('idReserva',$reserva->idReservas);
            // HerramientaReserva::where('idReserva',$reserva->idReservas);
            // MaterialReserva::where('idReserva',$reserva->idReservas);
            // Reservas::where('id', $id)->delete();
            // User::destroy($id);
            $reservas = Reservas::where('id', $id)->get();

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
                Reservas::where('id', $id)->delete();
            }
            User::destroy($id);

            return response()->json(array('res' => true));

        } catch (\Throwable $th) {
            $errorMessage = 'Error al eliminar el usuario: ' . $th->getMessage();
            return response()->json(array('error' => $errorMessage));
        }

    }
}
