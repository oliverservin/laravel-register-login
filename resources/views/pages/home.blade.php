<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

$logout = function () {
    Auth::guard('web')->logout();

    Session::invalidate();
    Session::regenerateToken();

    $this->redirect('/', navigate: true);
};

?>

<x-layouts.main>
    @volt('pages.home')
        <div class="w-full">
            <h1 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Home
            </h1>
            <p class="mt-2">
                Home para usuarios con sesión iniciada.
            </p>
            <div class="mt-48">
                <button wire:click="logout" class="text-sm underline">Cerrar sesión</button>
            </div>
        </div>
    @endvolt
</x-layouts.main>
