<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Cuentas del turno #{{ $openShift->id }}
            </h2>

            <a href="{{ route('dashboard') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                Volver al Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('accounts.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
               + Crear cuenta
            </a>

            <table class="w-full mt-6 text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($accounts as $account)
                        <tr class="border-b dark:border-gray-600">
                            <td class="px-4 py-2">{{ $account->id }}</td>
                            <td class="px-4 py-2">{{ $account->name }}</td>
                            <td class="px-4 py-2">
                                @if($account->status == 'open')
                                    <span class="text-green-600 font-bold">Abierta</span>
                                @else
                                    <span class="text-red-600 font-bold">Cerrada</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('accounts.show', $account->id) }}"
                                   class="text-blue-600 hover:underline">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                No hay cuentas creadas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
