<x-layouts.app :title="__('transferencias')"> 
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            
        <form method="POST" action="{{route('seleccion_servicio')}}" class="flex flex-col gap-6">
            @csrf
            <h1>Pago de Servicos Publicos</h1>
            <h6>Toda transacción tiene un tarifa de 2%</h6>
            <flux:select wire:model="selector_vista" placeholder="Eliga su servicio" :label="__('Elija un servicio')">
                <flux:select.option value="telefonia">Pago de Teléfonia Movil</flux:select.option>
                <flux:select.option value="internet">Pago de Internet</flux:select.option>                    
                <flux:select.option value="servicios_public">Servicios Publicos</flux:select.option>
            </flux:select>
            <flux:button type="submit" class="w-full" variant="primary">Seguiente</flux:button>
        </form>
        
    </div>
</x-layouts.app>