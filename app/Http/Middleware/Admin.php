<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $roles = Roles::all();
        foreach ($roles as $rol) {
            if($rol->estado === 'Administrador' || $rol->estado === 'Admin' || $rol->estado === 'admin' || $rol->estado === 'administrador'){
                $idRol=$rol->idRoles;
            }
        }
        if(Auth::check() && Auth::user()->idRoles == $idRol){
            return $next($request);
        }
        
        return redirect("/");
    }
}
