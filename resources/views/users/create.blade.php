<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Crear usuario
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6">

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm">Nombre</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm">Correo</label>
                        <input type="email" name="email" class="w-full border rounded px-3 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm">Contraseña</label>
                        <input type="password" name="password" class="w-full border rounded px-3 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm">Rol</label>
                        <select name="role_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">Seleccione un rol</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('users.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            Crear usuario
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>

