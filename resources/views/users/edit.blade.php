<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Editar usuario
        </h2>
    </x-slot>
<x-back-dashboard />
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6">

                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm">Nombre</label>
                        <input type="text" name="name" value="{{ $user->name }}"
                               class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm">Correo</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                               class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm">Nueva contraseña (opcional)</label>
                        <input type="password" name="password"
                               class="w-full border rounded px-3 py-2">
                        <small class="text-gray-500">
                            Déjala vacía si no quieres cambiar la contraseña.
                        </small>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm">Rol</label>
                        <select name="role_id" class="w-full border rounded px-3 py-2" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                        @selected($user->role_id == $role->id)>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('users.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            Guardar cambios
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>

