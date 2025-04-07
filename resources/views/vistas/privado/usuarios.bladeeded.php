<x-layouts.app :title="__('privado')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">


        <div class="table-responsive small">
            <table class="w-full text-center border-separate border-spacing-2 border border-gray-400 dark:border-gray-500">
                <caption class="caption-bottom">
                    <h2>Lista de Usuarios</h2>
                  </caption>
                <thead class="bg-blue-500">
                <tr>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Nombre Completo</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Fecha de Nacimiento</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Teléfono</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Correo</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600">Creación de la Cuenta</th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600"></th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600"></th>
                  <th scope="col" class="border border-gray-300 dark:border-gray-600"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <th class="py-8 border border-gray-300 dark:border-gray-600">{{$user->name}}</th>
                    <th class="py-8 border border-gray-300 dark:border-gray-600">{{\Carbon\Carbon::parse($user->nacimiento)->format('d/m/Y')}}</th>
                    <th class="py-8 border border-gray-300 dark:border-gray-600">{{$user->phone}}</th>
                    <th class="py-8 border border-gray-300 dark:border-gray-600">{{$user->email}}</th>
                    <th class="py-8 border border-gray-300 dark:border-gray-600">{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</th>
                    @can('ver usuario')
                        <td class="py-8 border border-gray-300 dark:border-gray-600"><flux:button href="{{route('privado.show', $user->id)}}" variant="filled">Mas Info</flux:button></td>
                    @endcan
                    @can('modificar usuario')
                        <td class="py-8 border border-gray-300 dark:border-gray-600"><flux:button href="{{route('privado.edit', $user->id)}}" variant="primary">Modificar</flux:button></td>
                    @endcan
                    @can('eliminar usuario')
                    
                        <td class="py-8 border border-gray-300 dark:border-gray-600">
                          <form action="{{route('privado.destroy', $user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                          <flux:button type="submit" variant="danger">Eliminar</flux:button>
                         </form>
                        </td>
                   
                    @endcan
                  </tr>    
                @endforeach
              </tbody>
            </table>
          </div>

    </div>
</x-layouts.app>