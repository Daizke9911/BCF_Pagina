<x-layouts.app :title="__('movimientos')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl items-center">
    <div class="flex space-x-8">
        <div class="overflow-hidden shadow rounded-lg border mx-8 box">
            <div class="px-8 py-5 sm:px-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Detalles de la Operación
                    </h3>
                 </div>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    ////////////////////////////////////////////////////////////////////////////////////////////////
                </p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Referencia
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$movimientos->reference}}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                        Concepto
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$movimientos->concept}}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                        Monto de la Operacion
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$movimientos->movedMoney}}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                        Saldo Total
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$movimientos->saldo}}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        
                        @if ($movimientos->cuentaType == 1)
                            <dt class="text-sm font-medium text-gray-500">
                                Tu Cuenta Afectada
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                Corriente
                            </dd>
                        @else
                            <dt class="text-sm font-medium text-gray-500">
                                Tu Cuenta Afectada
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                Ahorro
                            </dd>
                        @endif
                    </div>
                    @if ($movimientos->cuenta_transferida)
                        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Cuenta Involucrada:
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{$tacho = maskNumber($movimientos->cuenta_transferida, 4, 3);}}
                            </dd>
                        </div>
                    @endif
                    
                    @if ($movimientos->cuenta_recibida)
                        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Cuenta Involucrada:
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{$tacho = maskNumber($movimientos->cuenta_recibida, 4, 3);}}
                            </dd>
                        </div>
                    @endif
                    
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                        Fecha de la Operacion
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{\Carbon\Carbon::parse($movimientos->created_at)->format('d/m/Y')}}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                        Hora de la Operacion
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{\Carbon\Carbon::parse($movimientos->created_at)->format('H:i:s')}}
                        </dd>
                    </div>
                </dl>
            </div>
            <flux:button href="{{route('movimientos.index')}}" class="w-full" variant="primary">Volver Atras</flux:button>
        </div>
    </div>
</x-layouts.app>