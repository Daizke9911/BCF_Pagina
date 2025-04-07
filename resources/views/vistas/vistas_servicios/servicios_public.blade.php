<?php
use App\Models\Cuenta;
$cuentasLogin = Cuenta::where('user_id', Auth::user()->id)->get();
?>
<x-layouts.app :title="__('')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        
        <form method="POST" action="{{route('servicios.store')}}" class="flex flex-col gap-6">
            @csrf
            <h1>Pago de Servicios Publicos</h1>
            <h6>Toda transacción tiene un tarifa de 2%</h6>

            <flux:select wire:model="cuentaTypeLogin2" placeholder="Eliga su tipo de cuenta" :label="__('Elija Su Cuenta Para Realizar la Operación')">
               @foreach ($cuentasLogin as $cuentaLogin)
                @if ($cuentaLogin->cuentaType == 1)
                    <flux:select.option value="1">Corriente - Saldo: {{$cuentaLogin->availableBalance}}</flux:select.option>
                @else
                    <flux:select.option value="2">Ahorro - Saldo: {{$cuentaLogin->availableBalance}}</flux:select.option>
                @endif
                @endforeach
                
            </flux:select>
                @error('cuentaTypeLogin')
                    {{$message}}
                @enderror
            
                <flux:select wire:model="servicio_publico" placeholder="Seleccione operadora" :label="__('Operadora')">
                    <flux:select.option value="Agua">Agua Yaracuy</flux:select.option>
                    <flux:select.option value="Corpoelec">Corpoelec</flux:select.option>
                    <flux:select.option value="Aseo">Aseo</flux:select.option>
                    <flux:select.option value="Gas">Gas Yaracuy</flux:select.option>
                    <flux:select.option value="Felicidad">Felicidad</flux:select.option>
                </flux:select>
                @error('operadora_movil')
                    {{$message}}
                @enderror
                <flux:input
                    wire:model="monto"
                    :label="__('Monto a pagar')"
                    type="tel"
                    value="{{old('monto')}}"
                    required
                    autofocus
                    autocomplete="monto"
                    :placeholder="__('Ingrese el monto a pagar')"
                />

            <flux:input
                wire:model="password"
                :label="__('Contraseña')"
                type="password"
                required
                autofocus
                autocomplete="password"
                :placeholder="__('Escriba su contraseña para realizar la operacion')"
            />

            <flux:button type="submit" class="w-full" variant="primary">Transferir</flux:button>
            <flux:button href="{{route('servicios.create')}}" class="w-full">Volver atras</flux:button>
        </form>

    </div>
</x-layouts.app>