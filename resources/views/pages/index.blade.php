<x-layouts.main>
    <div class="w-full">
        <h1 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">
            Bienvenido
        </h1>
        <div class="mt-2">
            <a href="{{ route('register') }}" class="underline">Regístrate</a> o
            <a href="{{ route('login') }}" class="underline">Inicia sesión</a>.
        </div>
    </div>
</x-layouts.main>
