<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\Cuenta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Barryvdh\DomPDF\Facade\Pdf;

class PrivadoController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index(){
        $users=User::where('id', '!=', Auth::user()->id)->paginate(3);
        return view('vistas.privado.usuarios', compact('users'));
    }

    public function show($user){
        $infoUser=User::find($user);
        return view('vistas.privado.usuario_vista', compact('infoUser'));
    }

    public function edit($user){
        $infoUser=User::find($user);
        return view('vistas.privado.usuario_modificar', compact('infoUser'));        
    }

    public function update(Request $request, $infoUser){
        $user = User::find($infoUser);

        $request->validate([
            'name' => 'required|max:100',
            'cedula' => 'required|numeric|min:100000|max:99999999|unique:users,cedula,'.$user->id,
            'phone' => 'required|numeric|min:10000000000|max:99999999999|unique:users,phone,'.$user->id,
            'nacimiento' => 'required|date',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        
        if(Hash::check($request->password, Auth::user()->password)){
            
            $user->name = $request->name;
            $user->cedula = $request->cedula;
            $user->nacimiento = $request->nacimiento;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->save();

            
            $cuentas = Cuenta::where('user_id', $infoUser)->get();
            foreach($cuentas as $cuenta){
                if($cuenta->cuentaType == 1){
                    $request->validate([
                        'accountNumberCorriente' => 'required|unique:cuentas,accountNumber,'.$cuenta->id,
                        'availableBalanceCorriente' => 'required|numeric'
                    ]);

                    $cuenta->accountNumber = $request->accountNumberCorriente;
                    $cuenta->availableBalance = $request->availableBalanceCorriente;
                    $cuenta->save();
                }else{
                    $request->validate([
                        'accountNumberAhorro' => 'required|unique:cuentas,accountNumber,'.$cuenta->id,
                        'availableBalanceAhorro' => 'required|numeric'
                    ]);

                    $cuenta->accountNumber = $request->accountNumberAhorro;
                    $cuenta->availableBalance = $request->availableBalanceAhorro;
                    $cuenta->save();
                }
            }
            
            return redirect(route('privado.index'));
        }else{
            return redirect(route('privado.edit', $infoUser));
        }
        
    }

    public function destroy($infoUser){
        $user = User::find($infoUser);
        Schema::connection('mysql_movimientos')->drop($user->cedula);
        $user->delete();

        return redirect(route('privado.index'));
    }

    public function pdf(){
        $users = User::where('id', '!=', Auth::user()->id)->get();
        $pdf = Pdf::loadView('vistas.pdf', compact('users'));
        return $pdf->stream();
    }
}
