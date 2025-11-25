<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Crear cuenta
            </h2>

            <a href="{{ route('accounts.index') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto">

            <form action="{{ route('accounts.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                @csrf

                <label class="block font-medium">Nombre de la cuenta</label>
                <input type="text" name="name" required
                       class="w-full mt-2 border rounded px-3 py-2">

                <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Crear cuenta
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
