<x-layouts.app :title="__('movimientos')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="table-responsive small">
            <table class="w-full text-center border-separate border-spacing-2 border border-gray-400 dark:border-gray-500">
                <caption class="caption-bottom">
                    <h2>Movimientos</h2>
                  </caption>
                <thead class="bg-blue-500">
                <tr>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Referencia</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Fecha</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Monto de Operación</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Concepto</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Saldo Total</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Cuenta</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">////////////////////////</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($movimientos as $movimiento)
                  <tr>
                    <td class="py-8 border border-gray-300 dark:border-gray-600">{{$movimiento->reference}}</td>
                    <td class="py-8 border border-gray-300 dark:border-gray-600">{{\Carbon\Carbon::parse($movimiento->created_at)->format('d/m/Y')}}</td>
                    <td class="py-8 border border-gray-300 dark:border-gray-600">{{$movimiento->movedMoney}}</td>
                    <td class="py-8 border border-gray-300 dark:border-gray-600">{{$movimiento->concept}}</td>
                    <td class="py-8 border border-gray-300 dark:border-gray-600">{{$movimiento->saldo}}</td>
                    @if ($movimiento->cuentaType == 1)
                        <td class="py-8 border border-gray-300 dark:border-gray-600">Corriente</td>
                    @else
                      <td class="py-8 border border-gray-300 dark:border-gray-600">Ahorro</td>
                    @endif
                    <td class="py-8 border border-gray-300 dark:border-gray-600"><flux:button href="/movimientos/{{$movimiento->id}}">Mas Info</flux:button></td>
                  </tr>    
                @endforeach
               
              </tbody>
               
            </table>
            {{$movimientos->links()}}
          </div>
    </div>
</x-layouts.app>