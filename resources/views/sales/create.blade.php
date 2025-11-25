<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Registrar venta
        </h2>
    </x-slot>

    <x-back-dashboard />

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('sales.store') }}">
                    @csrf

                    {{-- Producto --}}
                    <label class="block font-medium">Producto:</label>
                    <select name="product_id"
                        class="border rounded px-3 py-2 w-full mt-1" required>
                        <option value="">Seleccione un producto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }} — ${{ number_format($product->price, 2) }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Cantidad --}}
                    <label class="block font-medium mt-4">Cantidad:</label>
                    <input type="number" min="1" name="quantity"
                           class="border rounded px-3 py-2 w-full mt-1"
                           required>

                    {{-- Botón --}}
                    <button type="submit"
                        class="mt-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Registrar venta
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>


