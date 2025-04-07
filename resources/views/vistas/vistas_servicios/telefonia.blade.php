<?php
use App\Models\Cuenta;
$cuentasLogin = Cuenta::where('user_id', Auth::user()->id)->get();
?>

<x-layouts.app :title="__('')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        
        <form method="POST" action="{{route('servicios.store')}}" class="flex flex-col gap-6">
            @csrf
            <h1>Pago de Telefonia Movil</h1>
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
            
            <div class="flex">
                <flux:select wire:model="operadora_movil" placeholder="Seleccione operadora" :label="__('Operadora')">
                    <flux:select.option value="0412">Digitel - 0412</flux:select.option>
                    <flux:select.option value="0414">Movistar - 0414</flux:select.option>
                    <flux:select.option value="0424">Movistar - 0424</flux:select.option>
                    <flux:select.option value="0416">Movilnet - 0416</flux:select.option>
                    <flux:select.option value="0426">Movilnet - 0426</flux:select.option>
                </flux:select>
                @error('operadora_movil')
                    {{$message}}
                @enderror
                <flux:input
                    wire:model="phone"
                    :label="__('Número')"
                    type="tel"
                    value="{{old('phone')}}"
                    required
                    autofocus
                    autocomplete="phone"
                    :placeholder="__('Ingrese el número telefonico')"
                />
            </div>
            <flux:select wire:model="monto" placeholder="Seleccione un monto" :label="__('Monto a pagar')">
                    <flux:select.option value="50">50</flux:select.option>
                    <flux:select.option value="100">100</flux:select.option>
                    <flux:select.option value="150">150</flux:select.option>
                    <flux:select.option value="200">200</flux:select.option>
                    <flux:select.option value="250">250</flux:select.option>
                    <flux:select.option value="200">300</flux:select.option>
                    <flux:select.option value="250">350</flux:select.option>
                    <flux:select.option value="200">500</flux:select.option>
                    <flux:select.option value="250">700</flux:select.option>
            </flux:select>
            @error('monto')
                    {{$message}}
                @enderror
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