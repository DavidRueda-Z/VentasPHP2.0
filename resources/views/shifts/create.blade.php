<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Iniciar Turno</h2>
    </x-slot>

    <x-back-dashboard />

    <div class="py-6">
        <div class="max-w-md mx-auto bg-white p-6 rounded shadow">

            <form method="POST" action="{{ route('shifts.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium mb-1">Monto inicial</label>
                    <input type="number" step="0.01" name="initial_amount"
                           class="w-full border rounded px-3 py-2"
                           required>
                </div>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">
                    Iniciar turno
                </button>

                <a href="{{ route('shifts.index') }}"
                    class="ml-2 px-4 py-2 bg-gray-500 text-white rounded">
                    Cancelar
                </a>
            </form>

        </div>
    </div>
</x-app-layout>
