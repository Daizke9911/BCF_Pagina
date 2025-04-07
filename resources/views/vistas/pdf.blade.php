@php
    use App\Models\Cuenta;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de los Usuarios // PDF</title>

    <style>
        .h1{
            text-align: center;
        }
        table {
          border-collapse: collapse;
          width: 100%;
        }
        
        th, td {
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even){background-color: #f2f2f2}
        
        th {
          background-color: #4153e0;
          color: white;
        }
        </style>
</head>
<body>
    
    <section>
      <img src="{{asset('files/logo_bcf.png')}}" width="100" height="100">
        <div class="h1">
            <h1>Lista de Usuarios</h1>
        </div>
        <div>
            <p>Lista solicitada por {{Auth::user()->name}} V-{{Auth::user()->cedula}}</p>
            <p>Solicitado el {{$date=date('d-m-Y')}} a las {{$date=date('H:i:s')}}</p>
        </div>
            <div>
              <table>
                <thead>
                  <tr>
                    <th>
                      Nombre Completo
                    </th>
                    <th>
                        Cedúla
                    </th>
                    <th>
                      Fecha de Nacimiento
                    </th>
                    <th>
                      Teléfono
                    </th>
                    <th>
                      Correo
                    </th>
                    <th>
                      Creación de la Cuenta
                    </th>
                    <th>
                        Cuentas del Usuario
                    </th>

                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>
                      {{$user->name}}
                    </td>
                    <td>
                        {{$user->cedula}}
                    </td>
                    <td>
                      {{\Carbon\Carbon::parse($user->nacimiento)->format('d/m/Y')}}
                    </td>
                    <td>
                      {{$user->phone}}
                    </td>
                    <td>
                      {{$user->email}}
                    </td>
                    <td>
                        {{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}
                    </td>
<?php 
$cuentas = Cuenta::where('user_id',$user->id)->get();
?>                  <td>
                    @foreach ($cuentas as $cuenta)
                        {{$cuenta->accountNumber}}
                            @if ($cuenta->cuentaType == 1)
                            Corriente
                            @else
                            Ahorro
                            @endif
                        
                    @endforeach
                    </td>
                  </tr>
                  @endforeach
                </tbody>
        
              </table>
            </div>
    </section>
</body>
</html>

