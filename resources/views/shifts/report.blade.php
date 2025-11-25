<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Resumen del turno #{{ $shift->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('dashboard') }}"
                class="inline-block mb-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Volver al Dashboard
            </a>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-xl font-bold mb-4">Información general</h3>

                <p><strong>Estado:</strong> {{ ucfirst($shift->status) }}</p>
                <p><strong>Abierto por:</strong> {{ $shift->user->name }}</p>
                <p><strong>Monto inicial:</strong> ${{ number_format($shift->initial_amount, 2) }}</p>

                <hr class="my-4">

                <h3 class="text-xl font-bold mb-2">Movimientos del turno</h3>

                <p><strong>Ventas directas:</strong> ${{ number_format($ventas, 2) }}</p>
                <p><strong>Cuentas cerradas:</strong> ${{ number_format($cuentas, 2) }}</p>
                <p><strong>Total recaudado:</strong> ${{ number_format($totalTurno, 2) }}</p>

                <hr class="my-4">

                <h3 class="text-xl font-bold mb-2">Cierre del turno</h3>

                <p><strong>Sugerido para cerrar:</strong>
                    <span class="text-blue-600 font-semibold">
                        ${{ number_format($sugeridoCerrar, 2) }}
                    </span>
                </p>

                <p><strong>Monto final:</strong>
                    @if ($shift->final_amount)
                        ${{ number_format($shift->final_amount, 2) }}
                    @else
                        -
                    @endif
                </p>

                <p><strong>Diferencia:</strong>
                    @php
                        $diff = ($shift->final_amount ?? 0) - $sugeridoCerrar;
                    @endphp

                    <span class="{{ $diff == 0 ? 'text-green-600' : 'text-red-600' }}">
                        ${{ number_format($diff, 2) }}
                    </span>
                </p>

                <hr class="my-4">

                <p><strong>Abierto en:</strong> {{ $shift->opened_at }}</p>
                <p><strong>Cerrado en:</strong> {{ $shift->closed_at ?? '-' }}</p>

            </div>
        </div>
    </div>
</x-app-layout>

