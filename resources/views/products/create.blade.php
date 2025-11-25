<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Producto
        </h2>
    </x-slot>

    <x-back-dashboard />

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded p-6">

                <form action="{{ route('products.store') }}" method="POST">
                    @include('products.form')
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
