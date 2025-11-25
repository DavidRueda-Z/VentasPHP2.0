<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Cuenta: {{ $account->name }}
            </h2>

            <a href="{{ route('accounts.index') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                Volver
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

            <!-- TOTAL DE LA CUENTA -->
            <div class="mb-6 text-xl">
                Total de la cuenta:
                <span class="text-green-600 font-bold">
                    ${{ number_format($total, 2) }}
                </span>
            </div>

            <!-- FORMULARIO AGREGAR PRODUCTO -->
            @if($account->status == 'open')
            <form action="{{ route('accounts.sales.store', $account->id) }}" method="POST"
                  class="bg-white dark:bg-gray-800 p-6 rounded shadow mb-6">
                @csrf

                <label class="block font-medium">Producto</label>
                <select name="product_id" class="w-full mt-2 border rounded px-3 py-2" required>
                    @foreach(\App\Models\Product::all() as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} - ${{ $product->price }}
                        </option>
                    @endforeach
                </select>

                <label class="block font-medium mt-4">Cantidad</label>
                <input type="number" name="quantity" min="1" required
                       class="w-full mt-2 border rounded px-3 py-2">

                <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Agregar
                </button>
            </form>
            @endif

            <!-- TABLA DE VENTAS -->
            <table class="w-full mt-6 text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="px-4 py-2">Producto</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($sales as $sale)
                        <tr class="border-b dark:border-gray-600">
                            <td class="px-4 py-2">{{ $sale->product->name }}</td>
                            <td class="px-4 py-2">{{ $sale->quantity }}</td>
                            <td class="px-4 py-2">${{ number_format($sale->total_amount, 2) }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('accounts.sales.destroy', $sale->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar venta?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                No hay ventas en esta cuenta.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- BOTÓN CERRAR CUENTA -->
            @if($account->status == 'open')
                <form action="{{ route('accounts.update', $account->id) }}" method="POST" class="mt-6">
                    @csrf
                    @method('PUT')
                    <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Cerrar cuenta
                    </button>
                </form>
            @endif

        </div>
    </div>
</x-app-layout>
