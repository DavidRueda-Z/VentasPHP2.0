<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Mensaje bienvenida -->
            <div class="mb-6 text-gray-700 dark:text-gray-300">
                Bienvenido, <strong>{{ Auth::user()->name }}</strong>
            </div>

            <!-- Grid de opciones -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Turnos (Todos los usuarios) -->
                <a href="{{ route('shifts.index') }}"
                   class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-xl transition border">
                    <h3 class="text-lg font-semibold mb-2">Turnos</h3>
                    <p class="text-gray-600 dark:text-gray-300">Abrir, cerrar y revisar turnos.</p>
                </a>

                <!-- Ventas (Todos los usuarios) -->
                <a href="{{ route('sales.index') }}"
                   class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-xl transition border">
                    <h3 class="text-lg font-semibold mb-2">Ventas</h3>
                    <p class="text-gray-600 dark:text-gray-300">Registrar y administrar ventas del turno.</p>
                </a>

                <!-- Cuentas -->
<a href="{{ route('accounts.index') }}"
   class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-xl transition border">
    <h3 class="text-lg font-semibold mb-2">Cuentas</h3>
    <p class="text-gray-600 dark:text-gray-300">Gestionar cuentas (mesas) del turno.</p>
</a>

                @if(Auth::user()->role_id == 1) {{-- Solo admin --}}
                    <!-- Gestión de productos -->
                    <a href="{{ route('products.index') }}"
                       class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-xl transition border">
                        <h3 class="text-lg font-semibold mb-2">Productos</h3>
                        <p class="text-gray-600 dark:text-gray-300">Crear, editar y administrar productos.</p>
                    </a>

                    <!-- Gestión de usuarios -->
                    <a href="{{ route('users.index') }}"
                       class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-xl transition border">
                        <h3 class="text-lg font-semibold mb-2">Usuarios</h3>
                        <p class="text-gray-600 dark:text-gray-300">Control de usuarios y roles.</p>
                    </a>
                @endif




            </div>

        </div>
    </div>
</x-app-layout>

