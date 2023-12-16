<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use function Laravel\Folio\name;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

name('register');

state([
    'name',
    'email',
    'password',
    'password_confirmation',
]);

rules([
   'name' => ['required', 'string', 'max:255'],
   'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
   'password' => ['required', 'string', 'confirmed', Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(RouteServiceProvider::HOME, navigate: true);
};

?>

<x-layouts.main>
    @volt('pages.register')
        <div class="w-full space-y-12">
            <h1 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Registrarse
            </h1>

            <form wire:submit="register">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <x-input-label for="name" value="Nombre" />
                        <div class="mt-2">
                            <x-text-input wire:model="name" id="name" class="block w-full" type="text" name="name" required autofocus autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="name" value="Email" />
                        <div class="mt-2">
                            <x-text-input wire:model="email" id="email" class="block w-full" type="email" name="email" required />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password" value="Contraseña" />
                        <div class="mt-2">
                            <x-text-input wire:model="password" id="password" class="block w-full" type="password" name="password" required />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password_confirmation" value="Confirmar contraseña" />
                        <div class="mt-2">
                            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div>
                        <x-primary-button class="w-full">Registrarse</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    @endvolt
</x-layouts.main>
