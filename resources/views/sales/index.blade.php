<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ventas del turno #{{ $openShift->id }}
        </h2>
    </x-slot>

<x-back-dashboard />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Botón para registrar venta --}}
                <a href="{{ route('sales.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Registrar venta
                </a>

                <div class="flex justify-end mt-4">
    <div class="bg-gray-100 dark:bg-gray-700 px-4 py-2 rounded shadow text-lg font-semibold">
        Total del turno:
        <span class="text-green-600">${{ number_format($totalTurno, 2) }}</span>
    </div>
</div>


                {{-- Tabla de ventas --}}
                <table class="w-full mt-6 text-left border-collapse">
                    <thead>
    <tr class="bg-gray-200 dark:bg-gray-700">
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">Descripción</th>
        <th class="px-4 py-2">Cantidad</th>
        <th class="px-4 py-2">Precio Unitario</th>
        <th class="px-4 py-2">Total Venta</th>
        <th class="px-4 py-2">Fecha</th>
        <th class="px-4 py-2">Acciones</th>

    </tr>
</thead>


                    <tbody>
    @forelse ($sales as $sale)
        <tr class="border-b dark:border-gray-600">
            <td class="px-4 py-2">{{ $sale->id }}</td>
            <td class="px-4 py-2">{{ $sale->description }}</td>
            <td class="px-4 py-2">{{ $sale->quantity }}</td>
            <td class="px-4 py-2">${{ number_format($sale->amount, 2) }}</td>
            <td class="px-4 py-2">${{ number_format($sale->total_amount, 2) }}</td>
            <td class="px-4 py-2">{{ $sale->sold_at }}</td>
            <td class="px-4 py-2">
    <a href="{{ route('sales.edit', $sale->id) }}"
       class="text-blue-600 hover:underline">Editar</a>

    <form action="{{ route('sales.destroy', $sale->id) }}"
          method="POST"
          class="inline-block ml-2"
          onsubmit="return confirm('¿Seguro que deseas eliminar esta venta?')">
        @csrf
        @method('DELETE')
        <button class="text-red-600 hover:underline">Eliminar</button>
    </form>
</td>

        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center py-4 text-gray-500">
                Aún no has registrado ventas en este turno.
            </td>
        </tr>
    @endforelse
</tbody>

                </table>

            </div>
        </div>
    </div>
</x-app-layout>
