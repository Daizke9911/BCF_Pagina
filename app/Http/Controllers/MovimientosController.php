<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovimientosRequest;
use App\Models\Cuenta;
use App\Models\Movimientos;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class MovimientosController extends Controller
{
    public function index(){
        $user = Auth::user()->cedula;
        $movimientos = Movimientos::where('user_id',Auth::user()->id)
        ->orderBy('id', 'desc')
        ->paginate(3);
        return view('vistas.movimientos', compact('movimientos'));
    }

    public function create(){
        $id=Auth::user()->id;
        $cuentasLogin = Cuenta::where('user_id',$id)->get();
        return view('vistas.transferir', compact('cuentasLogin'));
    }
    public function store(MovimientosRequest $request){
        if($request->cuentaTypeLogin == 1){
            $id=Auth::user()->id;
            $userLogin = User::where('id', $id)->first();
            $cuentaLogin = Cuenta::where('user_id', $id)
            ->where('cuentaType',$request->cuentaTypeLogin)->first();
        }elseif($request->cuentaTypeLogin == 2){
            $id=Auth::user()->id;
            $userLogin = User::where('id', $id)->first();
            $cuentaLogin = Cuenta::where('user_id', $id)
            ->where('cuentaType',$request->cuentaTypeLogin)->first();
        }else{
            //notify()->error('Error','Elija la cuenta a restar');
            return redirect(route('movimientos.create'));
        }
        $userDestino = User::where('cedula',$request->cedula)->first();
        $cuentaDestino = Cuenta::where('user_id',$userDestino->id)->where('cuentaType',$request->cuentaType);
        
        if($request->cedula != $userLogin->cedula){ //validar que no es la misma cuenta del usuario login
            if(Hash::check($request->password, $userLogin->password)){  //validar la contraseña del usuario login
                if($request->cuentaType == 1){ //condicional que realiza la operacion 
                    $cuentaDestino=$cuentaDestino->first();
                    $request->validate([
                        'cuentaType' => [
                        'required',
                        Rule::exists('cuentas', 'cuentaType')
                            ->where('user_id', $userDestino->id)
                            ->where('cuentaType', 1),
                        ],
                    ]); //validar si la cuenta destino existe
                    
                    if($request->money < $cuentaLogin->availableBalance){
                        $reference = random_int(1,999999999);
                        $numeroLimpio = preg_replace('/[^0-9]/', '', $request->money);
                        $moneyNegativo=$numeroLimpio * -1;
                        $IVA = $request->money * 0.02;
                        $cuentaLogin->availableBalance = $cuentaLogin->availableBalance - $request->money;
                        $cuentaLogin->availableBalance = $cuentaLogin->availableBalance - $IVA;
                        $cuentaDestino->availableBalance = $cuentaDestino->availableBalance + $request->money;
                        $date = now()->format('Y-m-d H:i:s');


                        $movimientos= new Movimientos();
                        $movimientos2 = new Movimientos();

                        $movimientos->user_id = $userDestino->id;
                        $movimientos->reference = $reference;
                        $movimientos->concept = $request->concepto;
                        $movimientos->movedMoney = $numeroLimpio;
                        $movimientos->saldo = $cuentaDestino->availableBalance;
                        $movimientos->cuentaType = $cuentaDestino->cuentaType;
                        $movimientos->cuenta_transferida = null;
                        $movimientos->user_id_transferido = null;
                        $movimientos->cuenta_recibida = $cuentaLogin->accountNumber;
                        $movimientos->user_id_recibido = $cuentaLogin->user_id;
                        $movimientos->created_at = $date;

                        $movimientos2->user_id = $userLogin->id;
                        $movimientos2->reference = $reference;
                        $movimientos2->concept = $request->concepto;
                        $movimientos2->movedMoney = $moneyNegativo;
                        $movimientos2->saldo = $cuentaDestino->availableBalance;
                        $movimientos2->cuentaType = $cuentaDestino->cuentaType;
                        $movimientos2->cuenta_transferida = $cuentaDestino->accountNumber;
                        $movimientos2->user_id_transferido = $cuentaDestino->user_id;
                        $movimientos2->cuenta_recibida = null;
                        $movimientos2->user_id_recibido = null;
                        $movimientos2->created_at = $date;

                        $movimientos->save();
                        $movimientos2->save();
                        $cuentaDestino->save();
                        $cuentaLogin->save();

                        //notify()->success('','Transferencia Realizada!');
                        return redirect(route('movimientos.index'));
                    }else{ 
                        //notify()->error('Error','Saldo Insuficiente');
                        return redirect(route('movimientos.create'));
                    }
                }elseif($request->cuentaType == 2){
                    $cuentaDestino=$cuentaDestino->first();
                    $request->validate([
                        'cuentaType' => [
                        'required',
                        Rule::exists('cuentas', 'cuentaType')
                            ->where('user_id', $userDestino->id)
                            ->where('cuentaType', 2),
                        ],
                    ]); //validar si la cuenta destino existe
                    if($request->money < $cuentaLogin->availableBalance){
                        $reference = random_int(1,999999999);
                        $numeroLimpio = preg_replace('/[^0-9]/', '', $request->money);
                        $moneyNegativo=$numeroLimpio * -1;
                        $IVA = $request->money * 0.02;
                        $cuentaLogin->availableBalance = $cuentaLogin->availableBalance - $request->money;
                        $cuentaLogin->availableBalance = $cuentaLogin->availableBalance - $IVA;
                        $cuentaDestino->availableBalance = $cuentaDestino->availableBalance + $request->money;
                        $date = now()->format('Y-m-d H:i:s');

                        $movimientos= new Movimientos();
                        $movimientos2 = new Movimientos();

                        $movimientos->user_id = $userDestino->id;
                        $movimientos->reference = $reference;
                        $movimientos->concept = $request->concepto;
                        $movimientos->movedMoney = $numeroLimpio;
                        $movimientos->saldo = $cuentaDestino->availableBalance;
                        $movimientos->cuentaType = $cuentaDestino->cuentaType;
                        $movimientos->cuenta_transferida = null;
                        $movimientos->user_id_transferido = null;
                        $movimientos->cuenta_recibida = $cuentaLogin->accountNumber;
                        $movimientos->user_id_recibido = $cuentaLogin->user_id;
                        $movimientos->created_at = $date;

                        $movimientos2->user_id = $userLogin->id;
                        $movimientos2->reference = $reference;
                        $movimientos2->concept = $request->concepto;
                        $movimientos2->movedMoney = $moneyNegativo;
                        $movimientos2->saldo = $cuentaDestino->availableBalance;
                        $movimientos2->cuentaType = $cuentaDestino->cuentaType;
                        $movimientos2->cuenta_transferida = $cuentaDestino->accountNumber;
                        $movimientos2->user_id_transferido = $cuentaDestino->user_id;
                        $movimientos2->cuenta_recibida = null;
                        $movimientos2->user_id_recibido = null;
                        $movimientos2->created_at = $date;

                        $movimientos->save();
                        $movimientos2->save();
                        $cuentaDestino->save();
                        $cuentaLogin->save();

                        //notify()->success('','Transferencia Realizada!');
                        return redirect(route('movimientos.index'));
                    }else{
                       // notify()->error('Error','Saldo Insuficiente');
                        return redirect(route('movimientos.create'));
                        return "saldo insuficiente";
                    }
                }else{
                   // notify()->error('verifique los datos','La Cuenta No Exise');
                    return redirect(route('movimientos.create'));
                }
            }else{
               // notify()->error('Error','Contraseña Incorrecta');
                return redirect(route('movimientos.create'));
            }
        }else{
            //notify()->error('Error','No Puedes Transferir a Tus Propias Cuentas');
            return redirect(route('movimientos.create'));
        }
    }
    public function show($movimiento){
        $userLogins = Auth::user()->cedula;
        $movimientos = Movimientos::where('user_id', Auth::user()->id)->find($movimiento);

        return view('vistas.movimiento_vista', compact('movimientos'));
    }
    public function edit(){}
    public function update(){}
    public function destroy(){}
}
