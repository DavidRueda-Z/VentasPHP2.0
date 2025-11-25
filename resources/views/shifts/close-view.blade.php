<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Cerrar turno #{{ $shift->id }}</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white p-6 shadow rounded">

        <a href="{{ route('shifts.index') }}"
           class="inline-block mb-4 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
        Volver
        </a>

        <h3 class="text-lg font-bold mb-4">Resumen del turno</h3>

        <p><strong>Usuario:</strong> {{ $shift->user->name }}</p>
        <p><strong>Monto inicial:</strong> ${{ number_format($shift->initial_amount, 2) }}</p>
        <p><strong>Total ventas:</strong> ${{ number_format($totalTurno, 2) }}</p>
        <p><strong>Deberías cerrar con:</strong> ${{ number_format($sugeridoCerrar, 2) }}</p>

        <form action="{{ route('shifts.close', $shift->id) }}" method="POST" class="mt-4">
            @csrf
            <label class="font-medium">Monto final real:</label>
            <input type="number" name="final_amount" class="border rounded px-2 py-1" required>

            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 mt-2">
                Confirmar cierre
            </button>
        </form>

    </div>
</x-app-layout>
