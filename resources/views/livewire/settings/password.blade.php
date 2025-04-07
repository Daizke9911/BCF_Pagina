<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    //
};

new class extends Component {
    public string $respuesta_1 = '';
    public string $respuesta_2 = '';
    public string $respuesta_3 = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'respuesta_1' => ['required', 'string', 'max:255', 
                function ($attribute, $value, $fail) {
                    if (!Auth::check() || Auth::user()->respuesta_1 !== $value) {
                        $fail('La respuesta es incorrecta');
                    }
                }],
                'respuesta_2' => ['required', 'string', 'max:255', 
                function ($attribute, $value, $fail) {
                    if (!Auth::check() || Auth::user()->respuesta_2 !== $value) {
                        $fail('La respuesta es incorrecta');
                    }
                }],
                'respuesta_3' => ['required', 'string', 'max:255',
                function ($attribute, $value, $fail) {
                    if (!Auth::check() || Auth::user()->respuesta_3 !== $value) {
                        $fail('La respuesta es incorrecta');
                    }
                }],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('respuesta_1', 'respuesta_2', 'respuesta_3', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('respuesta_1', 'respuesta_2', 'respuesta_3', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">

        <!--CAMBIAR CONTRASEÑA-->
        <form wire:submit="updatePassword" class="mt-6 space-y-6">
            <flux:input
                wire:model="respuesta_1"
                :label="__(Auth::user()->pregunta_1)"
                type="text"
                required
                autocomplete="respuesta_1"
                :placeholder="__('Respuesta de la primera pregunta de seguridad')"
            />
            <flux:input
                wire:model="respuesta_2"
                :label="__(Auth::user()->pregunta_2)"
                type="text"
                required
                autocomplete="respuesta_2"
                :placeholder="__('Respuesta de la segunda pregunta de seguridad')"
            />
            <flux:input
                wire:model="respuesta_3"
                :label="__(Auth::user()->pregunta_3)"
                type="text"
                required
                autocomplete="respuesta_3"
                :placeholder="__('Respuesta de la tercera pregunta de seguridad')"
            />
            <flux:input
                wire:model="password"
                :label="__('New password')"
                type="password"
                required
                autocomplete="new-password"
            />
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirm Password')"
                type="password"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <div class="my-8 h-6 bg-gradient-to-r from-green-400 to-blue-500"></div>

        <div class="flex flex-col items-start">
            
            <x-settings.layout_2 :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">
                <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                    <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
                    <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
                    <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
                </flux:radio.group>
            </x-settings.layout_2>
           
        </div>
    </x-settings.layout>
    
</section>
