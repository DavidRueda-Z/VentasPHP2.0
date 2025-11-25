@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
        {{ session('error') }}
    </div>
@endif


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Turnos
        </h2>
    </x-slot>

    <x-back-dashboard />


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                 {{-- Botón para iniciar turno --}}
                @if ($shifts->where('status', 'open')->count() == 0)
                    <a href="{{ route('shifts.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Iniciar turno
                    </a>
                @else
                    <p class="text-yellow-400 font-semibold mb-4">
                        Tienes un turno abierto.
                    </p>
                @endif

                {{-- Tabla de turnos --}}
                <table class="w-full mt-6 text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2">Monto inicial</th>
                            <th class="px-4 py-2">Monto final</th>
                            <th class="px-4 py-2">Abierto en</th>
                            <th class="px-4 py-2">Cerrado en</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($shifts as $shift)
                            <tr class="border-b dark:border-gray-600">
                                <td class="px-4 py-2">{{ $shift->id }}</td>

                                {{-- Estado --}}
                                <td class="px-4 py-2">
                                    @if ($shift->status == 'open')
                                        <span class="text-green-500 font-bold">Abierto</span>
                                    @else
                                        <span class="text-red-500 font-bold">Cerrado</span>
                                    @endif
                                </td>

                                <td class="px-4 py-2">{{ number_format($shift->initial_amount, 0) }}</td>
                                <td class="px-4 py-2">{{ $shift->final_amount ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $shift->opened_at }}</td>
                                <td class="px-4 py-2">{{ $shift->closed_at ?? '-' }}</td>

                                {{-- Acciones --}}
                                <td class="px-4 py-2 text-center">

                                    @if ($shift->status === 'open')
                                        {{-- Enviar a la vista de cierre --}}
                                        <a href="{{ route('shifts.close.view', $shift->id) }}"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                            Cerrar turno
                                        </a>

                                    @else
                                        {{-- Ver reporte --}}
                                        <a href="{{ route('shifts.report', $shift->id) }}"
                                            class="text-blue-500 hover:underline">
                                            Ver reporte
                                        </a>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">
                                    No tienes turnos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
