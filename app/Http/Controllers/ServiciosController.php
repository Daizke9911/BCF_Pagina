<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Movimientos;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ServiciosController extends Controller
{
    public function create(){
        $id=Auth::user()->id;
        $cuentasLogin = Cuenta::where('user_id',$id)->get();
        return view('vistas.servicios_pago', compact('cuentasLogin'));
    }

    public function store(Request $request){
        if($request->operadora_movil){
            $userLogin= Auth::user();

            if($request->cuentaTypeLogin2 == 1){
                $cuentaLogin = Cuenta::where('user_id', Auth::user()->id)
                ->where('cuentaType',$request->cuentaTypeLogin2)->first();
            }elseif($request->cuentaTypeLogin2 == 2){
                $cuentaLogin = Cuenta::where('user_id', Auth::user()->id)
                ->where('cuentaType',$request->cuentaTypeLogin2)->first();
            }else{
                //notify()->error('Error','Elija la cuenta a restar');
                return view('vistas.vistas_servicios.telefonia');
            }

            if(Hash::check($request->password, $userLogin->password)){
                if($request->monto < $cuentaLogin->availableBalance){
                    $request->validate([
                        'phone' => 'required|numeric|max:9999999|min:1000000',
                        'monto' => 'required'
                    ]);
                    $reference = "TLF-".random_int(1,999999999);
                    $IVA = $request->monto * 0.02;
                    $moneyNegativo=$request->monto * -1;
                    $cuentaLogin->availableBalance = $cuentaLogin->availableBalance - $request->monto;
                    $cuentaLogin->availableBalance = $cuentaLogin->availableBalance - $IVA;
                    $date = now()->format('Y-m-d H:i:s');
                    $numTelefonico = $request->operadora_movil."-".$request->phone;

                    $movimientos=new Movimientos();

                    $movimientos->user_id = Auth::user()->id;
                    $movimientos->reference = $reference;
                    $movimientos->concept = "Recarga Telefonica al: ".$numTelefonico;
                    $movimientos->movedMoney = $moneyNegativo;
                    $movimientos->saldo = $cuentaLogin->availableBalance;
                    $movimientos->cuentaType = $cuentaLogin->cuentaType;
                    $movimientos->cuenta_transferida = null;
                    $movimientos->user_id_transferido = null;
                    $movimientos->cuenta_recibida = null;
                    $movimientos->user_id_recibido = null;
                    $movimientos->created_at = $date;

                    $movimientos->save();
                    $cuentaLogin->save();

                    return redirect(route('movimientos.index'));
                }else{
                    return view('vistas.vistas_servicios.telefonia');
                }
            }
        }elseif($request->operadora_internet){
            $userLogin= Auth::user();

            if($request->cuentaTypeLogin2 == 1){
                $cuentaLogin = Cuenta::where('user_id', Auth::user()->id)
                ->where('cuentaType',$request->cuentaTypeLogin2)->first();
            }elseif($request->cuentaTypeLogin2 == 2){
                $cuentaLogin = Cuenta::where('user_id', Auth::user()->id)
                ->where('cuentaType',$request->cuentaTypeLogin2)->first();
            }else{
                //notify()->error('Error','Elija la cuenta a restar');
                return view('vistas.vistas_servicios.telefonia');
            }

            if(Hash::check($request->password, $userLogin->password)){
                if($request->monto < $cuentaLogin->availableBalance){
                    $request->validate([
                        'monto' => 'required|numeric'
                    ]);
                    $reference = "INTER-".random_int(1,999999999);
                    $IVA = $request->monto * 0.02;
                    $moneyNegativo=$request->monto * -1;
                    $cuentaLogin->availableBalance = $cuentaLogin->availableBalance - $request->monto;
                    $cuentaLogin->availableBalance = $cuentaLogin->availableBalance - $IVA;
                    $date = now()->format('Y-m-d H:i:s');

                    $movimientos=new Movimientos();

                    $movimientos->user_id = Auth::user()->id;
                    $movimientos->reference = $reference;
                    $movimientos->concept = "Servicio de Internet: ".$request->operadora_internet;
                    $movimientos->movedMoney = $moneyNegativo;
                    $movimientos->saldo = $cuentaLogin->availableBalance;
                    $movimientos->cuentaType = $cuentaLogin->cuentaType;
                    $movimientos->cuenta_transferida = null;
                    $movimientos->user_id_transferido = null;
                    $movimientos->cuenta_recibida = null;
                    $movimientos->user_id_recibido = null;
                    $movimientos->created_at = $date;

                    $movimientos->save();
                    $cuentaLogin->save();

                    return redirect(route('movimientos.index'));
                }else{
                    return view('vistas.vistas_servicios.telefonia');
                }
            }
        }elseif($request->servicio_publico){
            $userLogin= Auth::user();

            if($request->cuentaTypeLogin2 == 1){
                $cuentaLogin = Cuenta::where('user_id', Auth::user()->id)
                ->where('cuentaType',$request->cuentaTypeLogin2)->first();
            }elseif($request->cuentaTypeLogin2 == 2){
                $cuentaLogin = Cuenta::where('user_id', Auth::user()->id)
                ->where('cuentaType',$request->cuentaTypeLogin2)->first();
            }else{
                //notify()->error('Error','Elija la cuenta a restar');
                return view('vistas.vistas_servicios.telefonia');
            }

            if(Hash::check($request->password, $userLogin->password)){
                if($request->monto < $cuentaLogin->availableBalance){
                    $request->validate([
                        'monto' => 'required|numeric'
                    ]);
                    $reference = "SERV-PUBL-".random_int(1,999999999);
                    $IVA = $request->monto * 0.02;
                    $moneyNegativo=$request->monto * -1;
                    $cuentaLogin->availableBalance = $cuentaLogin->availableBalance - $request->monto;
                    $cuentaLogin->availableBalance = $cuentaLogin->availableBalance - $IVA;
                    $date = now()->format('Y-m-d H:i:s');

                    $movimientos=new Movimientos();

                    $movimientos->user_id = Auth::user()->id;
                    $movimientos->reference = $reference;
                    $movimientos->concept = "Servicio Publico: ".$request->servicio_publico;
                    $movimientos->movedMoney = $moneyNegativo;
                    $movimientos->saldo = $cuentaLogin->availableBalance;
                    $movimientos->cuentaType = $cuentaLogin->cuentaType;
                    $movimientos->cuenta_transferida = null;
                    $movimientos->user_id_transferido = null;
                    $movimientos->cuenta_recibida = null;
                    $movimientos->user_id_recibido = null;
                    $movimientos->created_at = $date;

                    $movimientos->save();
                    $cuentaLogin->save();

                    return redirect(route('movimientos.index'));
                }else{
                    return view('vistas.vistas_servicios.telefonia');
                }
            }
        }else{
            return view('vistas.vistas_servicios.telefonia');
        }
    }
    
    public function show(){

    }

    public function seleccion_servicio(Request $request){
        $request->validate([
            'selector_vista' => 'required',
        ]);
        if($request->selector_vista == 'telefonia'){
            return view('vistas.vistas_servicios.telefonia');
        }elseif($request->selector_vista == 'internet'){
            return view('vistas.vistas_servicios.internet');
        }elseif($request->selector_vista == 'servicios_public'){
            return view('vistas.vistas_servicios.servicios_public');
        }else{
            return redirect(route('servicios.create'));
        }
    }

}
