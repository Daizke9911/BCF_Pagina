<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VistasServiciosController extends Controller
{
    public function telefonia(Request $request){
        $request->validate([
            'selector_vista' => 'required',
        ]);
        $cuentasLogin = Cuenta::where('user_id', Auth::user()->id)->get();
        return view('vistas.vistas_servicios.telefonia', compact('cuentasLogin'));

    }
    public function internet(Request $request){
        $request->validate([
            'selector_vista' => 'required',
        ]);
        $cuentasLogin = Cuenta::where('user_id', Auth::user()->id)->get();
        return view('vistas.vistas_servicios.internet', compact('cuentasLogin'));
    }

    public function servicios_public(Request $request){
        $request->validate([
            'selector_vista' => 'required',
        ]);
        $cuentasLogin = Cuenta::where('user_id', Auth::user()->id)->get();
        return view('vistas.vistas_servicios.servicios_public', compact('cuentasLogin'));

        
    }
}
