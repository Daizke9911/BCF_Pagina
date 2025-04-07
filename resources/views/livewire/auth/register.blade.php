<?php

use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Cuenta;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


new #[Layout('components.layouts.auth')] class extends Component {
    use WithFileUploads;

    public string $name = '';
    public string $cedula = '';
    public string $phone = '';
    public string $nacimiento = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $pregunta_1 = '';
    public string $respuesta_1 = '';
    public string $pregunta_2 = '';
    public string $respuesta_2 = '';
    public string $pregunta_3 = '';
    public string $respuesta_3 = '';
    public string $cuentaType = '';


    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'numeric', 'min:1000000', 'max:99999999', 'unique:'. User::class],
            'phone' => ['required', 'numeric', 'min:10000000000', 'max:99999999999', 'unique:'.User::class],
            'nacimiento' => ['required', 'date'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'pregunta_1' => ['required', 'string', 'max:255'],
            'respuesta_1' => ['required', 'string', 'max:255'],
            'pregunta_2' => ['required', 'string', 'max:255'],
            'respuesta_2' => ['required', 'string', 'max:255'],
            'pregunta_3' => ['required', 'string', 'max:255'],
            'respuesta_3' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'cuentaType' => ['required']
        ]);

        

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $cuenta = new Cuenta();
        $i=1;
            do{
                $number= 9911000000 + $i;
                $verificarCuenta = Cuenta::where('accountNumber',$number)->first();
                if(empty($verificarCuenta->accountNumber)){
                    $cuenta->accountNumber = $number;
                    $cuenta->cuentaType = $validated['cuentaType'];
                    $number = 111;
                }else{
                    $i++;
                }
            }while($number != 111);
        $user->cuenta()->save($cuenta); //crear cuenta

        event(new Registered($user));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Crea una cuenta natural')" :description="__('Registrate como persona natural')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')"
        />

        <flux:input
            wire:model="cedula"
            :label="__('Cedúla de Identidad')"
            type="tel"
            required
            autofocus
            autocomplete="cedula"
            :placeholder="__('Su cedúla')"
        />

        <flux:input
            wire:model="phone"
            :label="__('Teléfono Movil')"
            type="tel"
            required
            autofocus
            autocomplete="phone"
            :placeholder="__('Número Teléfonico')"
        />

        <flux:input
            wire:model="nacimiento"
            :label="__('Fecha de Nacimiento')"
            type="date"
            required
            autofocus
            autocomplete="nacimiento"
            :placeholder="__('Su fecha')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <flux:select wire:model="cuentaType" placeholder="Eliga un tipo de cuenta" :label="__('Elija la cuenta que quiere aperturar')">
                <flux:select.option value="1">Corriente</flux:select.option>
                <flux:select.option value="2">Ahorro</flux:select.option>
            </flux:select>

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirm password')"
        />

        <flux:input
            wire:model="pregunta_1"
            :label="__('1) Primera pregunta de seguridad')"
            type="text"
            required
            autofocus
            autocomplete="pregunta_1"
            :placeholder="__('Ejem: Nombre de mi madre')"
        />
         
        <flux:input
            wire:model="respuesta_1"
            :label="__('Rrespuesta a la primera pregunta de seguridad')"
            type="text"
            required
            autofocus
            autocomplete="respuesta_1"
            :placeholder="__('Ejem: Chavela')"
        />

        <flux:input
            wire:model="pregunta_2"
            :label="__('2) Segunda pregunta de seguridad')"
            type="text"
            required
            autofocus
            autocomplete="pregunta_2"
            :placeholder="__('Ejem: Nombre de mi padre')"
        />
         
        <flux:input
            wire:model="respuesta_2"
            :label="__('Respuesta a la segunda pregunta de seguridad')"
            type="text"
            required
            autofocus
            autocomplete="respuesta_2"
            :placeholder="__('Ejem: Richard')"
        />

        <flux:input
            wire:model="pregunta_3"
            :label="__('3) Tercera pregunta de seguridad')"
            type="text"
            required
            autofocus
            autocomplete="pregunta_3"
            :placeholder="__('Ejem: Nombre de mi hermano')"
        />
         
        <flux:input
            wire:model="respuesta_3"
            :label="__('Respuesta a la tercera pregunta de seguridad')"
            type="text"
            required
            autofocus
            autocomplete="respuesta_3"
            :placeholder="__('Ejem: Gabriel')"
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
