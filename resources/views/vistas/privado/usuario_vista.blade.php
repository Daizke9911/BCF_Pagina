<?php 
use App\Models\Cuenta;
$cuentas = Cuenta::where('user_id',$infoUser->id)->get();
?>
<x-layouts.app :title="__('privado')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl items-center">

      <div class="flex space-x-8">
        <div class="overflow-hidden shadow rounded-lg border mx-8 box">
            <div class="px-8 py-5 sm:px-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Detalles del usuario
                    </h3>
                    <div class="m-5">
                      <flux:button href="{{route('privado.edit', $infoUser->id)}}" variant="primary">Modificar</flux:button>
                    </div>
                 </div>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Tomar responsabilidad en respetar la información del usuario
                </p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Nombre Completo
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$infoUser->name}}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Cedula
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$infoUser->cedula}}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Número de Teléfono
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                          {{$infoUser->phone}}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Nacimiento
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                          {{\Carbon\Carbon::parse($infoUser->nacimiento)->format('d/m/Y')}}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Correo
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                          {{$infoUser->email}}
                        </dd>
                    </div>
                    @foreach ($cuentas as $cuenta)

                      @if ($cuenta->cuentaType == 1)
                      <h5>Cuenta Corriente:</h5>
                          <div class="flex gap-4">
                            
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                
                                <dt class="text-sm font-medium text-gray-500">
                                    Número de Cuenta
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                  {{$cuenta->accountNumber}}
                                </dd>
                            </div>
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                              <dt class="text-sm font-medium text-gray-500">
                                  Saldo de la Cuenta
                              </dt>
                              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{$cuenta->availableBalance}}
                              </dd>
                            </div>
                          </div>
                      @else
                      <h5>Cuenta Ahorro:</h5>
                          <div class="flex gap-4">
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Número de Cuenta
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                  {{$cuenta->accountNumber}}
                                </dd>
                            </div>
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                              <dt class="text-sm font-medium text-gray-500">
                                  Saldo de la Cuenta
                              </dt>
                              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{$cuenta->availableBalance}}
                              </dd>
                            </div>
                          </div>
                      @endif              
                    @endforeach
                </dl>
            </div>
            <flux:button href="{{route('privado.index')}}" class="w-full" variant="primary">Volver Atras</flux:button>
        </div>

    </div>
</x-layouts.app>