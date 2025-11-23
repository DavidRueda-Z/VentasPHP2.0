@csrf

<div class="mb-4">
    <label class="block font-medium mb-1">Nombre del producto</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
           class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
</div>

<div class="mb-4">
    <label class="block font-medium mb-1">Precio</label>
    <input type="number" step="0.01" name="price"
           value="{{ old('price', $product->price ?? '') }}"
           class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
</div>

<div class="flex justify-end">
    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Guardar
    </button>
</div>
