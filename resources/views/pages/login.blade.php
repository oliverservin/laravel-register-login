<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

use function Laravel\Folio\name;
use function Livewire\Volt\form;

name('login');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirect(
        session('url.intended', RouteServiceProvider::HOME),
        navigate: true
    );

};

?>

<x-layouts.main>
    @volt('pages.login')
        <div class="w-full space-y-12">
            <h1 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Iniciar sesión
            </h1>

            <form wire:submit="login">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-input-label for="name" value="Email" />
                        <div class="mt-2">
                            <x-text-input wire:model="form.email" id="email" class="block w-full" type="email" name="email" required />
                        </div>
                        <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password" value="Contraseña" />
                        <div class="mt-2">
                            <x-text-input wire:model="form.password" id="password" class="block w-full" type="password" name="password" required />
                        </div>
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                    </div>
                    <div>
                        <div class="flex items-center">
                            <input wire:model="form.remember" id="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-600" name="remember">
                            <label for="remember" class="ml-3 block text-sm leading-6 text-gray-900">Remember me</label>
                        </div>
                    </div>
                    <div>
                        <x-primary-button class="w-full">Iniciar sesión</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    @endvolt
</x-layouts.main>
