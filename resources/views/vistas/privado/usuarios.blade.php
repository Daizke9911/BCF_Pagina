<x-layouts.app :title="__('privado')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <section class="py-1 bg-blueGray-50">
              <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded ">
                  <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                      <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-blueGray-700">Lista de Usuarios</h3>
                      </div>
                      <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                        <flux:button href="{{route('lista.pdf')}}" variant="primary">Lista en PDF</flux:button>
                      </div>
                    </div>
                  </div>
              
                  <div class="block w-full overflow-x-auto">
                    <table class="items-center bg-transparent w-full border-collapse ">
                      <thead>
                        <tr>
                          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Nombre Completo
                          </th>
                          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Fecha de Nacimiento
                          </th>
                          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Teléfono
                          </th>
                          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Correo
                          </th>
                          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Creación de la Cuenta
                          </th>
                          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          //////////////////
                          </th>
                          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          //////////////////
                          </th>
                          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          //////////////////
                          </th>
                        </tr>
                      </thead>
              
                      <tbody>
                        @foreach($users as $user)

                        
                        <tr>
                          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                            {{$user->name}}
                          </th>
                          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                            {{\Carbon\Carbon::parse($user->nacimiento)->format('d/m/Y')}}
                          </td>
                          <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{$user->phone}}
                          </td>
                          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{$user->email}}
                          </td>
                          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}
                          </td>
                          @can('ver usuario')
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                              <flux:button href="{{route('privado.show', $user->id)}}" variant="filled">Mas Info</flux:button>
                            </td>
                          @endcan
                          @can('modificar usuario')
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                              <flux:button href="{{route('privado.edit', $user->id)}}" variant="primary">Modificar</flux:button>
                            </td>
                          @endcan
                          @can('eliminar usuario')
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
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
                    {{$users->links()}}
                  </div>
                </div>
              </div>
      </section>

    </div>
</x-layouts.app>