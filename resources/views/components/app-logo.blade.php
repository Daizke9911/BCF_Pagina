<img src="{{asset('files/logo_bcf.png')}}" alt="Banco Central de Fritolandia" width="40" height="40">
<div class="ml-1 grid flex-1 text-left text-sm">
    <span class="mb-0.5 truncate leading-none font-semibold">BCF
        @role('super-admin')
         // Cuenta del Super Admin
        @endrole
        @role('admin')
        // Cuenta de Administrador
        @endrole
        @role('mod')
        // Cuenta de Moderador
        @endrole
    </span>
</div>
