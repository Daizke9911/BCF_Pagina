<x-layouts.app :title="__('transferencias')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1>Realizar una transferencia</h1>
        <h6>Toda transacción tiene un tarifa de 2%</h6>
        <form method="POST" action="{{route('movimientos.store')}}" class="flex flex-col gap-6">
            @csrf

            <flux:select wire:model="cuentaTypeLogin" placeholder="Eliga su tipo de cuenta" :label="__('Elija Su Cuenta Para Realizar la Transacción')">
               @foreach ($cuentasLogin as $cuentaLogin)
                @if ($cuentaLogin->cuentaType == 1)
                    <flux:select.option value="1">Corriente - Saldo: {{$cuentaLogin->availableBalance}}</flux:select.option>
                @else
                    <flux:select.option value="2">Ahorro - Saldo: {{$cuentaLogin->availableBalance}}</flux:select.option>
                @endif
                @endforeach
                @error('cuentaTypeLogin')
                    {{$message}}
                @enderror
            </flux:select>

            <flux:input
                wire:model="cedula"
                :label="__('Cedula')"
                type="text"
                value="{{old('cedula')}}"
                required
                autofocus
                autocomplete="cedula"
                :placeholder="__('Ingrese la cedula')"
            />

            <flux:input
                wire:model="phone"
                :label="__('Telefono')"
                type="tel"
                value="{{old('phone')}}"
                required
                autofocus
                autocomplete="phone"
                :placeholder="__('Ingrese el número telefonico')"
            />

            <flux:input
                wire:model="money"
                :label="__('Dienero')"
                type="tel"
                value="{{old('money', '00.00')}}"
                required
                autofocus
                autocomplete="money"
                :placeholder="__('Ingrese el dinero')"
            />

            <flux:select wire:model="cuentaType" placeholder="Eliga un tipo de cuenta" :label="__('Tipo de Cuenta del Receptor')">
                <flux:select.option value="1">Corriente</flux:select.option>
                <flux:select.option value="2">Ahorro</flux:select.option>
            </flux:select>
            <flux:input
                wire:model="concepto"
                :label="__('Concepto')"
                type="text"
                required
                value="{{old('concepto')}}"
                autofocus
                autocomplete="concepto"
                :placeholder="__('Escriba un concepto')"
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

            <div class="flex items-center justify-end">
                <flux:button type="submit" class="w-full" variant="primary">Transferir</flux:button>
            </div>
        </form>
    </div>

</x-layouts.app>