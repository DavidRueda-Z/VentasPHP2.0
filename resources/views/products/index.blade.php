<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Productos
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('products.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Crear producto
            </a>

            <div class="mt-6 bg-white shadow-sm rounded p-4">
                @if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left py-2">ID</th>
                            <th class="text-left py-2">Nombre</th>
                            <th class="text-left py-2">Precio</th>
                            <th class="text-left py-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="py-2">{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="text-blue-600">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>
