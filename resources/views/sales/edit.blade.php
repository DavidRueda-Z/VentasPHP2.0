<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar venta #{{ $sale->id }}
        </h2>
    </x-slot>

    <x-back-dashboard />

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <form action="{{ route('sales.update', $sale->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label class="block text-sm font-medium">Producto:</label>
                    <select name="product_id" class="border rounded px-3 py-2 w-full mt-2" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $sale->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} - ${{ number_format($product->price, 2) }}
                            </option>
                        @endforeach
                    </select>

                    <label class="block text-sm font-medium mt-4">Cantidad:</label>
                    <input type="number" name="quantity"
                           value="{{ $sale->quantity }}"
                           class="border rounded px-3 py-2 w-full mt-2" required>

                    <button type="submit"
                            class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Guardar cambios
                    </button>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
