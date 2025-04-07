<?php 
use App\Models\Cuenta;
$cuentas = Cuenta::where('user_id',$infoUser->id)->get();
?>
<x-layouts.app :title="__('privado')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

            <form method="POST" action="{{route('privado.update', $infoUser->id)}}" class="flex flex-col gap-6 ">
                @csrf
                @method('PUT')

                <flux:input
                    wire:model="name"
                    :label="__('Nombre del Usuario')"
                    type="text"
                    value="{{old('cedula', $infoUser->name)}}"
                    required
                    autofocus
                    autocomplete="name"
                    :placeholder="__('Nombre del Usuario')"
                />

                <flux:input
                    wire:model="cedula"
                    :label="__('Cedula')"
                    type="tel"
                    value="{{old('cedyla', $infoUser->cedula)}}"
                    required
                    autofocus
                    autocomplete="cedula"
                    :placeholder="__('Cedula del usuario')"
                />

                <flux:input
                    wire:model="phone"
                    :label="__('Teléfono')"
                    type="tel"
                    value="{{old('phone', $infoUser->phone)}}"
                    required
                    autofocus
                    autocomplete="phone"
                    :placeholder="__('Teléfono del Usuario')"
                />

                <flux:input
                    wire:model="nacimiento"
                    :label="__('Fecha de Nacimiento')"
                    type="date"
                    required
                    value="{{old('nacimiento', $infoUser->nacimiento)}}"
                    autofocus
                    autocomplete="nacimiento"
                    :placeholder="__('Fecha de Nacimiento del Usuario')"
                />

                <flux:input
                    wire:model="email"
                    :label="__('Correo')"
                    type="email"
                    required
                    value="{{old('email', $infoUser->email)}}"
                    autofocus
                    autocomplete="email"
                    :placeholder="__('Correo del Usuario')"
                />
                
                @foreach ($cuentas as $cuenta)
                    @if ($cuenta->cuentaType == 1)
                        <h5 class="decoration-sky-500/30">Cuenta Corriente del Usuario</h5>
                        <div class="flex gap-4">
                        <flux:input
                            wire:model="accountNumberCorriente"
                            :label="__('Número de Cuenta')"
                            type="tel"
                            required
                            value="{{old('accountNumberCorriente', $cuenta->accountNumber)}}"
                            autofocus
                            autocomplete="accountNumberCorriente"
                            :placeholder="__('Número de Cuenta del Usuario')"
                        />

                        <flux:input
                            wire:model="availableBalanceCorriente"
                            :label="__('Saldo de la Cuenta')"
                            type="tel"
                            required
                            value="{{old('availableBalanceCorriente', $cuenta->availableBalance)}}"
                            autofocus
                            autocomplete="availableBalanceCorriente"
                            :placeholder="__('Saldo del Usuario')"
                        />
                        </div>
                    @else
                        <h5 class="decoration-sky-500/30">Cuenta Ahorro del Usuario</h5>
                        <div class="flex gap-4">

                        <flux:input
                            wire:model="accountNumberAhorro"
                            :label="__('Número de Cuenta')"
                            type="tel"
                            required
                            value="{{old('accountNumberAhorro', $cuenta->accountNumber)}}"
                            autofocus
                            autocomplete="accountNumberAhorro"
                            :placeholder="__('Número de Cuenta del Usuario')"
                        />

                        <flux:input
                            wire:model="availableBalanceAhorro"
                            :label="__('Saldo de la Cuenta')"
                            type="tel"
                            required
                            value="{{old('availableBalanceAhorro', $cuenta->availableBalance)}}"
                            autofocus
                            autocomplete="availableBalanceAhorro"
                            :placeholder="__('Saldo del Usuario')"
                        />
                        
                                            
                    
                    </div>
                    @endif
                
                @endforeach
                
                <flux:input
                    wire:model="password"
                    :label="__('Ingresar su contraseña para realizar la operación')"
                    type="password"
                    required
                    autofocus
                    autocomplete="password"
                    :placeholder="__('Contraseña')"
                />

                <flux:button type="submit" variant="primary">Modificar</flux:button>
                <flux:button href="{{route('privado.index')}}" >Volver Atras</flux:button>

            </form>
        

    </div>
</x-layouts.app>